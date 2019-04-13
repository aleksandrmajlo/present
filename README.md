При выводе в админке продукта
  administrator\components\com_jshopping\views\product_edit\tmpl\default.php
     
     
      $present_plugin= JPluginHelper::getPlugin('joomshopingcustom', 'present');
      if(!empty($present_plugin)){
          ?>
          <li>
              <a href="#product-present" data-toggle="tab">Подарок</a>
          </li>
          <?php
      }
      .......
      if(!empty($present_plugin)){
          include(dirname(__FILE__)."/present.php");
      }
        
  present.php с папки other  - положить рядом с  default.php.
  В этом файле внешний вид вкладки- подарок для продукта.  
    
    

   
    
    
    