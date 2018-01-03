<?php				
						include("class.phpmailer.php");
						include("class.smtp.php");
						$mail = new PHPMailer();
						$mail->IsSMTP(); // set mailer to use SMTP
						$mail->Host = "mail.abc.com"; // specify main and backup server
						$mail->Port = 25; // set the port to use
						$mail->SMTPAuth = true; // turn on SMTP authentication
						$mail->SMTPSecure = 'ssl';
						$mail->Username = "mail trung gian được tạo từ gmail"; // your SMTP username or your gmail username
						$mail->Password = "mật khẩu"; // your SMTP password or your gmail password
						$from = "địa chỉ mail gửi "; // Reply to this email
						$to = "địa chỉ mail nhận"; 
						$name="Tên người nhận"; // Recipient's name
						$mail->CharSet     = "utf-8";
						$mail->From = $from;
						$mail->FromName = "Tên người gửi"; // Name to indicate where the email came from when the recepient received
						$mail->AddAddress($to,$name);
						$mail->AddReplyTo($from,"Tên người gửi");
						$mail->WordWrap = 50; // set word wrap
						$mail->IsHTML(true); // send as HTML
						$mail->Subject = "Tiêu đề";
						$mail->Body = "Nội dung";
						
						$mail->SMTPDebug = 1;
						//$mail->SMTPDebug = 2;
						if(!$mail->Send())
						{
							$err= $mail->ErrorInfo ;
						}
						else
						{
							$err= "Gửi mail thành công";
						}	
						echo $err;
						
?>