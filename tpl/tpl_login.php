<div class="section group">
    <div class="col span_2_of_c">
        <div class="contact-form">
            <h3><?=login?></h3>
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
                    <span><label><?=username?></label></span>
                    <span><input name="username" type="text" class="textbox"></span>
                </div>
                <div>
                    <span><label><?=password?></label></span>
                    <span><input name="password" type="password" class="textbox"></span>
                </div>
                <div>
                    <span><input type="submit" name="btn_login" value="<?=login?>"></span>
                    <span><label><?=not_register?></label> <a href='register.html'><?=signin?></a></span>
                </div>    
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>
