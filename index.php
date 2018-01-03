<?
include("administrator/library/config.php");
?>
<!DOCTYPE HTML>
<html>
<?
include("tpl/tpl_head.php");
?>
<body>
    <div class="header-bg">
        <div class="wrap">
            <div class="h-bg">
                <div class="total">
                    <?
                    $arr_user_menu['product'] = "active";
                    include("tpl/tpl_header.php");
                    ?>
                    
                    <?
                    $arr_menu['index'] = "active";
                    include("tpl/tpl_menu.php");
                    ?>
                    <div class="banner-top">
                        <div class="header-bottom">
                            <div class="header_bottom_right_images">
                                <?
                                include("tpl/tpl_slideshow.php");
                                ?>
                                
                                <div class="content-wrapper">
                                    <?
                                    include("tpl/tpl_new_product.php");
                                    ?>
                                    
                                    <?
                                    include("tpl/tpl_feature_product.php");
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="header-para">
                                <?
                                include("tpl/tpl_categories.php");
                                ?>
                                
                            </div>
                            <div class="clear"></div>
                            <?
                            include("tpl/tpl_footer.php");
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
