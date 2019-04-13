<?php
/**
 * @copyright    Copyright (c) 2018 UploadProductFile image. All rights reserved.
 * @license        http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * vmcustom - UploadProductFile Plugin
 *
 * @package        Joomla.Plugin
 * @subpakage    UploadProductFile image.UploadProductFile
 */
class plgjoomshopingcustompresent extends JPlugin
{

    /**
     * Constructor.
     *
     * @param    $subject
     * @param    array $config
     */
    function __construct(&$subject, $config = array())
    {
        // call parent constructor
        parent::__construct($subject, $config);

        $this->_tablename = '#__present';
    }



}