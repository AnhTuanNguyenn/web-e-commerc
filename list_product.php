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
                    include("tpl/tpl_header.php");
                    ?>
                    
                    <?
                    $arr_menu[$_GET['type']] = "active";
                    include("tpl/tpl_menu.php");
                    ?>
                    <div class="banner-top">
                        <div class="header-bottom">
                            <div class="header_bottom_right_images">
                                <?
                                include("tpl/tpl_list_product.php");
                                ?>
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
