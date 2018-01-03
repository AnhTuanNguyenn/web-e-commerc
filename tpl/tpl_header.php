<div class="header">
    <div class="box_header_user_menu">
        <ul class="user_menu">
            <li class="act first">
                <a href="#">
                    <div class="button-t"><span><?=shipping_returns?></span></div>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <div class="button-t"><span><?=advanced_search?></span></div>
                </a>
            </li>
            <?
            if($_SESSION['s_user_id'] > 0)
            {
                ?>
                <li class="<?=$arr_user_menu['order']?>">
                    <a href="quan-ly-don-hang.html">
                        <div class="button-t"><span><?=quan_ly_don_hang?></span></div>
                    </a>
                </li>
                <li class="<?=$arr_user_menu['product']?>">
                    <a href="quan-ly-san-pham.html">
                        <div class="button-t"><span><?=quan_ly_san_pham?></span></div>
                    </a>
                </li>
                <li class="<?=$arr_user_menu['profile']?>">
                    <a href="profile.html">
                        <div class="button-t"><span><?=hello?> <?=$_SESSION['s_fullname']?></span></div>
                    </a>
                </li>
                <li class="last">
                    <a href="logout.html">
                        <div class="button-t"><span><?=logout?></span></div>
                    </a>
                </li>
                <?
            } else 
            {
                ?>
                <li class="">
                    <a href="register.html">
                        <div class="button-t"><span><?=register?></span></div>
                    </a>
                </li>
                <li class="last">
                    <a href="login.html">
                        <div class="button-t"><span><?=login?></span></div>
                    </a>
                </li>
                <?
            }
            ?>
            
        </ul>
    </div>
    <div class="header-right">
        <ul class="follow_icon">
            <li><a href="#"><img src="images/icon1.png" alt=""/></a></li>
            <li><a href="#"><img src="images/icon2.png" alt=""/></a></li>
            <li><a href="#"><img src="images/icon3.png" alt=""/></a></li>
        </ul>
    </div>
    <div class="clear"></div>
    <div class="header-bot">
        <div class="logo">
            <a href="index.html"><img src="images/logo.png" alt=""/></a>
        </div>
        <div class="search">
            <input type="text" class="textbox" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
            <button class="gray-button"><span><?=search?></span></button>
        </div>
        <div class="clear"></div>
    </div>
</div>