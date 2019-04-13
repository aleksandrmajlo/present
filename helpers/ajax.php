<?php
const _JEXEC = 1;
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

define('JPATH_BASE', realpath(dirname(__FILE__) . '/../../../../'));
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_LIBRARIES . '/import.legacy.php';
require_once JPATH_LIBRARIES . '/cms.php';
require_once JPATH_CONFIGURATION . '/configuration.php';
require_once JPATH_BASE . '/includes/framework.php';

$plugin = JPluginHelper::getPlugin('joomshopingcustom', 'present');
if ($plugin) {
    $pluginParams = new JRegistry($plugin->params);
    $plugin_folders = $pluginParams->get('plugin_folders');
} else {
    $plugin_folders = "present";
}

$image_path = JPATH_BASE . '/images/' . $plugin_folders;
if (!file_exists($image_path)) {
    mkdir($image_path, 0777, true);
}
jimport('joomla.filesystem.folder');
$url = str_replace(JURI::root(true), "", JURI::root());
$urlPhoto = $url . 'images/' . $plugin_folders . '/';

$tablename = '#__present';
if (isset($_POST['action_present']) && $_POST['action_present'] == "save") {
    $file = false;
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        jimport('joomla.filesystem.file');
        $filename = JFile::makeSafe($file['name']);
        $ext = JFile::getExt($filename);
        $src = $file['tmp_name'];
        $namePhoto = time() . '.' . $ext;
        $dest = $image_path . '/' . $namePhoto;
        if (JFile::upload($src, $dest)) {
            $file = true;
            $urlPhoto .= $namePhoto;
        }
    }
    $product_id = $_POST['product_id'];
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query = $db->getQuery(true)
        ->select('id')
        ->from($db->quoteName($tablename))
        ->where($db->quoteName('product_id') . ' = ' . $product_id);
    $db->setQuery($query);
    $result = $db->loadResult();
    if ($result) {
        // обновляем
        $data = new stdClass();
        $data->id = intval($result);
        $data->product_id = $product_id;
        $data->title = $_POST['title'];
        $data->description = $_POST['description'];
        $data->publish_down = $_POST['publish_down'];
        if ($file) {
            $data->file = $urlPhoto;
        }
        $result = $db->updateObject($tablename, $data, 'id');
    } else {
        // вставляем
        $data = new stdClass();
        $data->product_id = $product_id;
        $data->title = $_POST['title'];
        $data->description = $_POST['description'];
        $data->publish_down = $_POST['publish_down'];
        if ($file) {
            $data->file = $urlPhoto;
        }
        $result = $db->insertObject($tablename, $data);
    }
}
exit();