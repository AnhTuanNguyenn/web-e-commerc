<div class="content-top">
    <div class="box_wrapper">
        <h1><?=new_product?></h1>
    </div>
    <div class="text">
        <?
        $arr_curr = array("usd"=>'$',"euro"=>"&euro;");
        $query_thread = $db->select("thread","*",array("where"=>"del=0","order_by"=>"id DESC","limit"=>3));
        while ($query_thread && $row_thread = mysql_fetch_assoc($query_thread)) 
        {
            $dir_images = "data/images/thread/250x140_".$row_thread['images'];
            if(!is_file($dir_images))
            {

                $dir_images = dir."images/bg250x140.jpg";
            } else 
            {
                 $dir_images = dir."data/images/thread/250x140_".$row_thread['images'];
            }
            ?>
            <div class="grid_1_of_3 images_1_of_3">
                <div class="grid_1">
                    <a href="san-pham-<?=$row_thread['id']?>.html"><img src="<?=$dir_images?>" title="continue reading" alt=""></a>
                    <div class="grid_desc">
                        <p class="title"><?=$row_thread['title']?></p>
                        <p class="title1"><?=$row_thread['short_content']?></p>
                        <div class="price" style="height: 19px;">
                            <span class="reducedfrom"><?=$arr_curr[$row_thread['currency']].number_format($row_thread['price'])?></span>
                            <?
                            if(!empty($row_thread['old_price']))
                            {
                                ?>
                                <span class="actual"><?=$arr_curr[$row_thread['currency']].number_format($row_thread['old_price'])?></span>
                                <?
                            }
                            ?>
                        </div>
                        <div class="cart-button">
                            <div class="cart">
                                <a  class="order_now" id="order_now" thread_id="<?=$row_thread['id']?>" href="#"><img src="images/cart.png" alt=""/></a>
                            </div>
                            <button onclick="window.location.href='san-pham-<?=$row_thread['id']?>.html';" class="button"><span><?=details?></span></button>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?
        }
        ?>
        <div class="clear"></div>
    </div>
</div>