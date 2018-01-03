
<?
    if($_GET['cart_id'])
    {
        $cart_id = (int)$_GET['cart_id'];
        $query = $db->select("cart","*",array("where"=>"id='".$cart_id."'  AND del=0"));
        if(!$arr_cart = mysql_fetch_assoc($query))
        {
            $err[] = khong_tim_thay_don_hang;
        } 
    }
    $arr_status = array("0"=>chua_xu_ly,"1"=>dang_xu_ly,"2"=>da_xu_ly,"3"=>don_hang_bi_huy);    
    if(isset($_POST['btnUpdateData']) && count($arr_cart) > 0 )
    {

        $arr_allow = array(0,1,2,3);
        if(!in_array($_POST['status'], $arr_allow))
        {
            $err[] = trang_thai_don_hang_khong_hop_le;
        } else 
        {

            $logs = $db->unSafeStr($arr_cart['logs']);
            $logs .= "[".$_SESSION['s_fullname']."] update status order from ".$arr_status[$arr_cart['status']]." to ".$arr_status[$_POST['status']]."<br/>";   
            $arr_update = array();
            $arr_cart['status'] = $arr_update['value']['status'] = (int)$_POST['status'];
            $arr_update['value']['logs'] = $db->safeStr($logs);
            $arr_update['where'] = " id='".$cart_id."' AND status!='".(int)$_POST['status']."' AND status NOT IN (2,3) LIMIT 1";
            $rs_update = $db->update("cart",$arr_update);
            if(!empty($rs_update))
            {
                $arr_cart['logs'] = $logs;
                $err[] = cap_nhat_thanh_cong;
                
            } else 
            {
                $err[] = cap_nhat_that_bai;
            }
            
        }
        
    }
?>
<?

    if(count($err) > 0)
    {
    ?>
    <div class="row-fluid">
        <div class="span12 alert alert-success">
        <ul>
        <?
        foreach($err as $i=>$msg)
        {
        ?>
        <li><?=$msg?></li>
        <?
        }
        ?>
        </ul>
        </div>
    </div>  
    <?
    }
?>
            <form action='' method='POST'  enctype="multipart/form-data">
            <div class="section group">
                <div class="col span_2_of_c">
                    <div class="contact-form">
                        <h3><?=thong_tin_don_hang?></h3>                  
                        <div>
                            <span><?=customer?>:<?=$db->unsafeStr($arr_cart['fullname']);?></span>
                        </div> 
                        <div>
                            <span><?=email?>:<?=$db->unsafeStr($arr_cart['email']);?></span>
                        </div>
                        <div>
                            <span><?=tel?>:<?=$db->unsafeStr($arr_cart['tel']);?></span>
                        </div> 
                        <div>
                            <span><?=address?>:<?=$db->unsafeStr($arr_cart['address']);?></span>
                        </div> 
                        <div>
                            <span><?=date_order?>:<?=date("d-m-Y H:i:s",strtotime($arr_cart['date_create']));?></span>
                        </div> 
                        <div>
                           <span><?=note?>:<?=$db->unsafeStr($arr_cart['content']);?></span>
                        </div> 
                        <div>
                            <span><?=status_order?>:
                            <?
                                if($arr_cart['status']==2 || $arr_cart['status']==3)
                                {
                                    ?>
                                    <?=$arr_status[$arr_cart['status']]?>
                                    <?
                                } else 
                                {
                                    ?>
                                <select name="status" class="w_30">
                                    <?
                                        
                                        foreach ($arr_status as $status => $name_status) 
                                            {
                                                $select = "";
                                                if($status==$arr_cart['status'])
                                                {
                                                    $select = " selected='selected' ";
                                                }
                                                ?>
                                                    <option <?=$select?> value="<?=$status?>"><?=$name_status?></option>
                                                <?
                                            }   
                                    ?>
                                </select>
                                    <?
                                }
                            ?></span>
                        </div> 
                        <div>
                            <span><?=history_order?>:</span>
                            <div><?=$db->unsafeStr($arr_cart['logs']);?></div>
                        </div> 
                    </div>
                </div>
            </div>            
                        <div class="row-form">
                            <div class="span12">
                                <table border="1" class="list_cart">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?=product?></th>
                                            <th><?=price?></th>
                                            <th><?=total?></th>
                                            <th><?=total_price?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $total_price = 0;
                                        $arr_curr = array("usd"=>'$',"euro"=>"&euro;");
                                        $query_thread = $db->select(
                                            "info_cart as i,thread as t",
                                            "t.title,t.sub_title,t.category_shop_id,t.id,t.id,t.images,i.total,i.price,t.currency",
                                            array("where"=>
                                                "i.cart_id='".$cart_id."' AND i.thread_id = t.id AND t.user_id='".$_SESSION['s_user_id']."' "));

                                        $total_thread = 0;
                                        while ($query_thread && $row_thread = mysql_fetch_assoc($query_thread)) 
                                        {
                                            $thread_id = $row_thread['id'];
                                            $category_shop_id = $row_thread['category_shop_id'];
                                            $price = contact;
                                            if($row_thread['price'] > 0)
                                            {
                                                $price = $arr_curr[$row_thread['currency']].number_format($row_thread['price']);    

                                                $arr_payment[$row_thread['currency']] +=$row_thread['price'];
                                            }
                                        ?>
                                        <tr id="thread_id-<?=$thread_id?>" thread_id="<?=$thread_id?>">
                                            <td width="15%">
                                            <?
                                            if(empty($row_thread['images']))
                                            {
                                            ?>
                                                <img alt="<?=$row_thread['title']?>" src="<?=dir?>images/bg400x300.jpg" />
                                            <?
                                            } else 
                                            {
                                            ?>
                                                <img alt="<?=$row_thread['title']?>" src="<?=dir_user_http?>images/thread/250_<?=$row_thread['images']?>" />
                                            <?
                                            }
                                            ?>  
                                            </td>
                                            <td width="30%" style="vertical-align: top">
                                                <a href="<?=$arr_info_category[$category_shop_id]['sub_title']."/".$row_thread['sub_title'];?>">
                                                    <?=$row_thread['title']?>
                                                </a>    
                                            </td>
                                            <td class="price" width="15%"  style="vertical-align: middle;"><?=$price?></td>
                                            <td width="25%" class="cc"  style="vertical-align: middle;">
                                                <span class="total"><?=$row_thread['total']?></span>
                                            </td>
                                            <td class="total_price" width="15%"   style="vertical-align: middle;">
                                                <?
                                                if($row_thread['price'] > 0)
                                                {
                                                    $total_price +=$row_thread['price']*$row_thread['total'];
                                                    ?><?=$arr_curr[$row_thread['currency']].number_format($row_thread['price']*$row_thread['total'])?><?
                                                } else 
                                                {
                                                    ?>
                                                    <?=please_contact?>
                                                    <?
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="full_price">
                                                <?
                                                $count = 0;
                                                foreach($arr_payment as $currency=>$total_price)
                                                {
                                                    ?><p><?=$arr_curr[$currency].number_format(  $total_price )?></p><?
                                                }
                                                ?>
                                                (<?=mysql_num_rows($query_thread)?> <?=product?>)
                                            </td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>

                            </div>
                            <div class="clear"></div>
                        </div> 
                        
                        <div class="row-form">
                            <div class="span12 cc">
                            <a href='quan-ly-don-hang.html'><input type='button' name='btnBack' class='btn' value='<?=back?>'></a>
                            <?
                                if($arr_cart['status']!=2 && $arr_cart['status']!=3)
                                {
                                    ?>
                                        <input type='submit' class='btn' name='btnUpdateData' value='<?=cap_nhat_don_hang?>'/>
                                    <?
                                }
                            ?>
                            
                            </div>
                            <div class="clear"></div>
                        </div>          
            </form>
