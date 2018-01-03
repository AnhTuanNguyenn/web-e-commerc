<?
    if($_GET['action'] == "del" && $_GET['cart_id'] > 0)
    {
        $arr_update['value']['status'] = 3;
        $arr_update['where'] = "id='".(int)$_GET['cart_id']."' AND status!=2 LIMIT 1";
        $rs_del = $db->update("cart",$arr_update);
        $db->redirect("quan-ly-don-hang.html");
        exit;
    }
?>
<div class="section group">
    <div class="col span_2_of_c">
        <div class="contact-form">
            <h3><?=quan_ly_don_hang?></h3>

            <table  class="list_thread" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th width="5%" class='cc'>#</th>
                        <th width="20%" class='cc'><?=orders?></th>
                        <th width="50%" class='cc'><?=customer?>/<?=email?>/<?=tel?></th>
                        <th width="15%" class='cc'><?=date_order?></th>
                        <th width="10%" class='cc'><?=cancel_order?></th>                                    
                    </tr>
                </thead>
                <tbody>
                    <?
                        $page = (int)$_GET['page'];
                        if($page < 2)
                        {
                            $page = 1;
                        }
                        $where = ' c.id=i.cart_id AND i.thread_id=t.id AND t.user_id="'.$_SESSION['s_user_id'].'" AND ';
                        $limit = 10;
                        $count = ($page-1)*$limit;

                        $query_cart = $db->select("cart as c,info_cart as i,thread as t","c.*",array("where"=>$where." c.del=0 ","group_by"=>"i.cart_id","order_by"=>"c.status ASC,c.date_create DESC","limit"=>$count.",".$limit));
                        $arr_status = array("0"=>chua_xu_ly,"1"=>dang_xu_ly,"2"=>da_xu_ly,"3"=>don_hang_bi_huy);     
                        while($query_cart && $row_cart = mysql_fetch_assoc($query_cart))
                        {   
                            $title = orders.":#".sprintf("%'.04d", $row_cart['id']);
                        ?>
                        <tr>
                            <td class='cc'><?=++$count?></td>
                            <td><a href='thong-tin-don-hang-<?=$row_cart['id'] ?>.html'><?=$title?> (<?=$arr_status[$row_cart['status']]?>)</a></td>
                            <td><?=$row_cart['fullname']?> / <?=$row_cart['email']?> / <?=$row_cart['tel']?></td>
                            <td class='cc'><?=date("d-m-Y H:i:s",strtotime($row_cart['date_create']))?></td>
                            <td class='cc'><a href='cancel-don-hang-<?=$row_cart['id']?>.html' class='remove'>X</a></td>                                    
                        </tr>
                        <?
                        }
                    ?>            
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="cr">
                            <?
                            for($i=$page-1;$i<$page+5;$i++)
                            {
                                if($i < 1 || ( $i>$page && mysql_num_rows($query_thread) < $limit ) )
                                {
                                    continue;
                                }

                                ?>
                                <a <?=($i==$page)?"class='active'":"";?> href='p<?=$i?>/quan-ly-don-hang.html'><?=$i?></a>
                                <?
                            }
                            ?>
                        </td>
                    </tr> 
                </tfoot>
            </table>
        </div>
    </div>
    <div class="clear"></div>
</div>
