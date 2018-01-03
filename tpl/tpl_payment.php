<?
        $total_price = 0;
        $query_thread = $db->select("thread","*",array("where"=>"id IN (".implode(",",$arr_cart).") AND del=0"));
        $arr_payment = array();
        $arr_payment['total_price'] = array();
        $arr_payment['contact'] = 0;
        $arr_payment['has_price'] = 0;
        $arr_thread = array();
        $arr_curr = array("usd"=>'$',"euro"=>"&euro;");
        while ($query_thread && $row_thread = mysql_fetch_assoc($query_thread)) 
        {
            $thread_id = $row_thread['id'];
            $category_shop_id = $row_thread['category_shop_id'];
            $arr_thread[$thread_id] = $row_thread;
            if($row_thread['price'] > 0)
            {
                $arr_payment['has_price'] +=1; 
                $arr_payment['total_price'][$row_thread['currency']] +=$row_thread['price']*$_SESSION['s_cart'][$thread_id]['total'];
            } else 
            {
                $arr_payment['contact'] +=1; 
            }


        }
        ?>
<?

                        if(isset($_POST['btn_order']) && $arr_payment['total_price'] > 0 )
                        {
                                $arr_allow = array("fullname","email","address","tel","content");
                                $_SESSION['s_info_cart'] = $_POST;
                                foreach($arr_allow as $allow)
                                {
                                    if(!empty($_POST[$allow]))
                                    {
                                        $arr_insert[$allow] = $db->safe(trim($_POST[$allow]));
                                    }
                                }
                                $arr_insert['date_create'] = date("Y-m-d H:i:s");
                            
                                if($_POST['sercure_code']!=$_SESSION['s_sercure_code'])
                                {
                                    $err[] = ma_bao_mat_khong_chinh_xac;
                                } else
                                {
                                    if(empty($arr_insert['email']) || !$db->checkEmail($arr_insert['email']))
                                    {
                                        $err[] = email_khong_duoc_de_trong;
                                    }
                                     if(empty($arr_insert['fullname']) )
                                    {
                                        $err[] = fullname_khong_duoc_de_trong;
                                    }
                                     if(empty($arr_insert['tel']) )
                                    {
                                        $err[] = tel_khong_duoc_de_trong;
                                    }
                                }
                                
                                $check_payment = 0;
                                if(!is_array($err))
                                {
                                    $rs_insert = $db->insert("cart",$arr_insert);
                                    if($rs_insert)
                                    {
                                        $cart_id = mysql_insert_id();
                                        $str_mail = sprintf("%.09",$cart_id);    
                                        $count = 0;

                                        foreach($arr_thread as $thread_id =>$row_thread)
                                        {
                                            
                                            $arr_insert = array();
                                            $arr_insert['cart_id'] = $cart_id;
                                            $arr_insert['thread_id'] = $thread_id;
                                            $arr_insert['total'] = $_SESSION['s_cart'][$thread_id]['total'];
                                            $arr_insert['price'] = $row_thread['price'];
                                            $db->insert("info_cart",$arr_insert);
                                            $str_mail  .= "<tr><td style='padding: 5px 10px;'>".++$count."</td><td style='padding: 5px 10px;'>".$row_thread['title']."</td><td style='padding: 5px 10px;'>".$arr_curr[$row_thread['currency']].number_format($row_thread['price'])."</td><td style='padding: 5px 10px;'>". $_SESSION['s_cart'][$thread_id]['total']."</td><td style='padding: 5px 10px;'>".$arr_curr[$row_thread['currency']].number_format($row_thread['price']* $_SESSION['s_cart'][$thread_id]['total'])."</td></tr>";    
                                        }
                                        //load ra 
                                        $content_mail = @file_get_contents(dir."data/template/xac_nhan_don_hang.html");
                                        $content_mail = str_replace("[cart_id]", "#".sprintf("%'.04d", $cart_id),$content_mail);
                                        $content_mail = str_replace("[list]", $str_mail, $content_mail);
                                   
                                        $arr_total = array();
                                        foreach($arr_payment['total_price'] as $currency=>$total_price)
                                        {
                                            $arr_total[] = $arr_curr[$currency].number_format(  $total_price );
                                        }
                                        $content_mail = str_replace("[total_price]", implode("&", $arr_total), $content_mail);
                                        $content_mail = str_replace("[fullname]", $_POST['fullname'], $content_mail);
                                        $content_mail = str_replace("[email]", $_POST['email'], $content_mail);
                                        $content_mail = str_replace("[tel]", $_POST['tel'], $content_mail);
                                        $content_mail = str_replace("[address]", $_POST['address'], $content_mail);
                                        $content_mail = str_replace("[content]", $_POST['content'], $content_mail);
                                       // echo $content_mail;
                                        $err[] = "<b style='color:#F00;font-size:18px;'>".dat_hang_thanh_cong."</b>";
                                        unset($_SESSION['s_cart']);
                                        unset($_SESSION['s_info_cart']);
                                        $arr_thread = $arr_payment = array();

                                        $check_payment = 1;
                                        $from = "ads.ivn.vn@gmail.com";
                                        $to = $_POST['email'];
                                        $subject = "Xác nhận đơn hàng #".sprintf("%'.04d", $cart_id);
                                        $name = "ivn.vn";
                                        $type = 1;//1 google,0 host;
                                        $content = $content_mail;
                                        $db->SendMail($from,$to,$subject,$content,$name,$type);
                                    }
                                }
                        }


                    ?>

                        <div class="contact-form">
                            <form action="" class="formBox" method="post" name="FormNameContact" id="FormNameContact">
                            <?
                            if($check_payment==1)
                            {
                                ?>
                                <div><p><?=he_thong_se_chuyen_toi_paypal?></p></div>
                                <script type="text/javascript">
                                    
                                    setTimeout(function(){
                                        window.location.href='https://www.paypal.com/vn/home';
                                    },5000);
                                </script>
                                <?
                            } else if(count($err) > 0) 
                            {
                                ?>
                                <div>
                                    <?
                                    foreach($err as $msg)
                                    {
                                        ?>
                                        <p><?=$msg?></p>
                                        <?
                                    }
                                    ?>
                                </div>
                                <?
                            }
                            ?>
                              <div class="left">
                                <div>
                                   <span><label><?=ho_va_ten?></label></span>
                                    <span>  
                                      <input class="textbox" name="fullname" maxlength="128" type="text" required="required" placeholder="<?=ho_va_ten?>" value="<?=$_SESSION['s_info_cart']['fullname']?>" onFocus="if (this.value == '<?=ho_va_ten?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=ho_va_ten?>';}"/>
                                  </span>
                                </div>
                                <div>
                                  <span><label><?=so_dien_thoai?></label></span>
                                    <span>   
                                  <input class="textbox"  name="tel" maxlength="16"  type="text"  required="required" placeholder="<?=so_dien_thoai?>" value="<?=$_SESSION['s_info_cart']['tel']?>" onFocus="if (this.value == '<?=so_dien_thoai?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=so_dien_thoai?>';}"/>
                              </span>
                                </div>
                                <div>
                                    <span><label><?=email?></label></span>
                                    <span> 
                                  <input class="textbox"  name="email" maxlength="128"  type="email"  required="required" placeholder="<?=email?>" value="<?=$_SESSION['s_info_cart']['email']?>" onFocus="if (this.value == 'Email'){this.value='';}" onBlur="if (this.value == '') {this.value='Email';}"/>
                              </span>
                                </div>
                                <div>
                                    <span><label><?=dia_chi?></label></span>
                                    <span> 
                                  <input class="textbox"  name="address" maxlength="255"  type="text" placeholder="<?=dia_chi?>" value="<?=$_SESSION['s_info_cart']['address']?>" onFocus="if (this.value == '<?=dia_chi?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=dia_chi?>';}"/>
                              </span>
                                </div>
                                <div><span class="captcha"><img src='captcha.php?time=<?=time()?>'  id='captcha' />
                                <input class="textbox w_30" id='sercure_code'  name="sercure_code" type="text" placeholder="<?=ma_bao_ve?>" value="<?=ma_bao_ve?>" onFocus="if (this.value == '<?=ma_bao_ve?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=ma_bao_ve?>';}"/>
                                </span>
                                  
                                </div>
                         
                              </div>
                              <div class="right">

                                <div>
                                    <span><label><?=ghi_chu?></label></span>
                                    <span> 
                                    <textarea name="content" class="note"  maxlength="1000"  cols="" rows="" placeholder="<?=ghi_chu?>" value="<?=$_SESSION['s_info_cart']['content']?>" onFocus="if (this.value == '<?=ghi_chu?>'){this.value='';}" onBlur="if (this.value == '') {this.value='<?=ghi_chu?>';}"></textarea>
                                </span>
                                </div>
                                <ul>
                                    <?
                                       
                                        $count = 0;
                                        $arr_list_curr = array();
                                        foreach($arr_thread as $thread_id=>$row_thread )
                                        {
                                            ?>
                                            <li><b><?=++$count?></b>. <?=$row_thread['title']?> <?=$arr_curr[$row_thread['currency']].$row_thread['price']?> X <?=$_SESSION['s_cart'][$thread_id]['total']?> = <?=$arr_curr[$row_thread['currency']].number_format($row_thread['price']*$_SESSION['s_cart'][$thread_id]['total'])?></li>
                                            <?
                                        }
                                    ?>
                                    <li><b><?=tong_gia_tri_don_hang?>
                                    <?
                                    $count = 0;
                                    foreach($arr_payment['total_price'] as $currency=>$total_price)
                                    {
                                        ?><p><?=++$count.".". $arr_curr[$currency].number_format(  $total_price )?></p><?
                                    }

                                        
                                    ?>
                                    </b></li>
                                </ul>
                                <?
                                if(is_array($err) && count($err) > 0 )
                                {
                                ?>
                                    <span class='msg'><?=implode(", ",$err)?></span>
                                <?
                                }
                                ?>
                                <div class="clr"></div>
                                <img style="padding: 5px;" src='images/ppcom.svg' />
                                </div>
                              <div class="clr"></div>
                              <div class="process_cart">
                                    <a href="index.html" title="<?=tiep_tuc_mua_sam?>"><?=tiep_tuc_mua_sam?></a>
                                    <a href="xem-don-hang.html" title="<?=quay_lai_don_hang?>"><?=quay_lai_don_hang?></a>
                                    <input type="submit" onClick="if(!confirm('<?=ban_chac_chan_muon_dat_hang?>')){return false;}" name="btn_order" value="<?=dat_hang?>">
                              </div>
                            </form>
                          </div>
                        </div>