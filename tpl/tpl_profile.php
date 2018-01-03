<div class="section group">
    <div class="col span_2_of_c">
        <div class="contact-form">
            <h3><?=profile?></h3>
            <form method="POST" action="">
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
                    <span><label><?=username?>: <?=$row_user['username']?></label></span>
                </div>
                <div>
                    <span><label><?=password?></label></span>
                    <span><input name="password" type="password" class="textbox"></span>
                </div>
                <div>
                    <span><label><?=cf_password?></label></span>
                    <span><input name="cf_password" type="password" class="textbox"></span>
                </div>
                <div>
                    <span><label><i><?=xin_vui_long_de_trong_mat_khau_va_xac_nhan_mat_khau?></i></label></span>
                </div>
                <div>
                    <span><label><?=f_name?></label></span>
                    <span><input name="f_name" type="text" value="<?=$row_user['f_name']?>" class="textbox"></span>
                </div>
                <div>
                    <span><label><?=s_name?></label></span>
                    <span><input name="s_name" type="text" value="<?=$row_user['s_name']?>" class="textbox"></span>
                </div>
                <div>
                    <span><label><?=email?></label></span>
                    <span><input name="email" type="email" value="<?=$row_user['email']?>" class="textbox"></span>
                </div>
                <div>
                    <span><input type="submit" name='btn_profile' value="<?=cap_nhat?>"></span>
                </div>    
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>
