<div class="section group">
    <div class="col span_2_of_c">
        <div class="contact-form">
            <?
            if($arr_data['id'] > 0)
            {
                ?>
                <h3><?=cap_nhat_san_pham?></h3>
                <?
            } else 
            {
                ?>
                <h3><?=them_san_pham?></h3>
                <?
            }
            ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div>
                    <?
                    $err = $_SESSION['s_err'];
                    unset($_SESSION['s_err']);
                    if(count($err) > 0)
                    {
                        foreach($err as $msg)
                        {
                            ?>
                            <p><?=$msg?></p>
                            <?
                        }
                    }
                    ?>
                </div>
                <div>
                    <span><label><?=ten_san_pham?></label></span>
                    <span><input name="title" type="text" class="textbox" value="<?=$arr_data['title']?>"></span>
                </div>
                <div>
                    <span><label><?=gia_san_pham?></label></span>
                    <span>
                        <input name="price" type="text" class="textbox w_20" value="<?=$arr_data['price']?>">
                        <select name="currency">
                        <?
                        foreach($arr_currency as $currency)
                        {
                            ?>
                            <option <?=($arr_data['currency']==$currency)?"selected='selected'":"";?> value="<?=$currency?>"><?=$currency?></option>
                            <?
                        }
                        ?>  
                        </select>
                        
                    </span>
                </div>
                <div>
                    <span><label><?=hinh_san_pham?></label></span>
                    <span><input name="images" type="file" class="textbox"></span>
                </div>
                <?
                if( !empty($arr_data['images']) )
                {
                    ?>
                    <div><img src='<?=dir?>data/images/thread/250x140_<?=$arr_data['images']?>' /></div>
                    <?
                }
                ?>
                <div>
                    <span><label><?=gioi_thieu_ngan?></label></span>
                </div>
                <div>
                    <textarea maxlength="200"  name="short_content" class="textbox"><?=$arr_data['short_content']?></textarea>
                </div>

                <div>
                    <span><label><?=gioi_thieu_san_pham?></label></span>
                </div>
                <div>
                    <textarea  name="content" class="textbox tinymce"><?=$arr_data['content']?></textarea>
                </div>
                <div>
                    <span><input type="submit" name='btn_create_thread' value="<?=dang_san_pham?>"></span>
                    <span><input type="button" name='btn_back' onClick="window.location.href='quan-ly-san-pham.html'" class="btn_1" value="<?=quay_lai?>"></span>
                </div>    
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>
