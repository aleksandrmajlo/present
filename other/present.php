<div id="product-present" class="tab-pane">
    <div class="col100">
        <h2>Подарок</h2>
        <div style="margin-bottom: 20px;">
            <a href="#" class="btn btn-large btn-primary present_save" >
                Сохранить подарок
            </a>
        </div>
        <?php
        $tablename = '#__present';
        $product_id = $this->product->product_id;
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName($tablename))
            ->where($db->quoteName('product_id') . ' = ' . $product_id);
        $db->setQuery($query);
        $result = $db->loadObject();
        $title="";
        $description="";
        $publish_down="";
        if($result){
            $title=$result->title;
            $description=$result->description;
            $publish_down=$result->publish_down;
        }
        ?>
        <div class="presentConteer">
            <table class="admintable">
                <tbody>
                <tr>
                    <td class="key" style="width:280px;">
                        Название
                    </td>
                    <td>
                        <input type="text" class="inputbox wide" name="title_present" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td class="key" style="width:280px;">
                        Описание
                    </td>
                    <td>
                        <textarea  class="wide" name="description_present"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="key" style="width:280px;">
                        Публикация до даты<br><b>(если дата не указана или просрочена -подарок не будет опубликован)</b>
                    </td>
                    <td>
                        <input type="date" class="inputbox wide" name="publish_down_present" value="<?php echo $publish_down;?>">
                    </td>
                </tr>
                <tr>
                    <td class="key" style="width:280px;">
                        Изображение подарка
                    </td>
                    <td>
                        <input type="file" id="file_present" class="inputbox wide" name="file_present" value="">
                    </td>
                </tr>
                <?php
                if($result&&!empty($result->file)){
                    ?>
                    <tr>
                        <td colspan="2">
                            <img src="<?php echo $result->file; ?>" class="thumbnail" style="">
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="container" id="suc" style="display: none;margin-top: 20px;">
            <div class="row">
                <div class="span4">
                    <div class="alert alert-success">
                        Данные сохранены.
                    </div>
                </div>
            </div>
        </div>
        <div  style="margin-top: 20px;">
            <a href="#" class="btn btn-primary btn-large present_save" >
                Сохранить подарок
            </a>
        </div>
    </div>
</div>
<script>
    (function ($) {
        $product_id =<?php echo $this->product->product_id; ?>;
        $('a.present_save').click(function(event) {
            event.preventDefault();
            var title=$('[name="title_present"]').val();
            var description=$('[name="description_present"]').val();
            var publish_down=$('[name="publish_down_present"]').val();
    
            var data=new FormData();
            data.append( 'action_present', 'save');
            data.append( 'product_id', $product_id);
            data.append( 'title', title);
            data.append( 'description', description);
            data.append( 'publish_down', publish_down);
            data.append( 'file', $( '#file_present' )[0].files[0] );
            $.ajax({
                url:"/plugins/joomshopingcustom/present/helpers/ajax.php",
                type: 'POST',
                data: data,
                contentType: false,
                cache: false,
                processData:false,
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {

                alert('Данные сохранены!')
            });
            
        });
    })(jQuery)
</script>