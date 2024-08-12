
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once'inc.func.php';
require 'marketing/ajax_call/php-mailer/src/Exception.php';
require 'marketing/ajax_call/php-mailer/src/PHPMailer.php';
require 'marketing/ajax_call/php-mailer/src/SMTP.php';
//$marketing->bulk_email();
/*require 'marketing/ajax_call/vendor/autoload.php';
$apiKey='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';*/
//$marketing->lead_bulk_email();
date_default_timezone_set("Asia/Karachi");

		    $query=$cm->selectData("reminder", "status='pending' AND reminder_date='".date('d-m-Y')."' AND reminder_time='".date('G')."'");
			$sign_log=$cm->u_value("branches", "sign_logo", "status='active' AND branch_id=".$branch."");
			$branch_name=strtoupper($cm->u_value("branches", "branch_name", "status='active' AND branch_id=1"));
			$address=$cm->u_value("branches", "address", "status='active' AND branch_id=1");
			$branch_email=$cm->u_value("branches", "branch_email", "status='active' AND branch_id=1");
			$phone_line=$cm->u_value("branches", "phone_line", "status='active' AND branch_id=1");
			$mobile=$cm->u_value("branches", "mobile", "status='active' AND branch_id=1");
			$web=$cm->u_value("branches", "web", "status='active' AND branch_id=1");
			while($row=$query->fetch_assoc())
			{
				$id=$row['id'];
				$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:800px; margin:auto; height:auto; font-family:Calibri; background:#f0f7ed; padding:10px; '>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
							<td  style='border: 1px solid white;padding: 4px;background: #fff;'  colspan='10'>
							<p style='padding:5px'>".$row['message']."</p><br><br><br>
							<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
							'.$branch_name.'  '.$address.' <a href="http://'.$web.'/" target="_blank">'.$web.'</a>')."		
							</p>
					</td>
				</tr>
				<tr>
					<td align='center'  style='border: 1px solid white;padding: 4px;background: #01bad8;' colspan='10'>
					 <img src='https://crmv4.groupoperation.com/email-temp-img/email-footer-img.png' width='100' 
					 style='float:left;'>
						<h4>Call for Our Best Deals!</h4>
						<h3>".$phone_line." , Mob: ".$mobile."</h3>
					</td>
				</tr>
						<tr style='color:#ffff;'>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;' align='center' colspan='10'>
					<a href='https://www.facebook.com/tourvision/'><img src='https://crmv4.groupoperation.com/email-temp-img/facebook.png' width='30'></a>
					<a href='https://twitter.com/tourvisiontrave?ref_src=twsrc%5Etfw'>
					<img src='https://crmv4.groupoperation.com/email-temp-img/twitter.png' width='30'></a>
					<a href='https://www.linkedin.com/company/tour-vision-travel/'><img src='https://crmv4.groupoperation.com/email-temp-img/linkedin.png' width='30'></a>
					<a href='https://api.whatsapp.com/send?phone=923111381888&amp;text=Website Visitor Here'><img src='https://crmv4.groupoperation.com/email-temp-img/whatsapp.png' width='30'></a>
					</td>
				</tr>
						
						
			</table>

</div>"."<br>";
					$from="reminder@toursvision.com";
					$Esubject ="A Soft Reminder";
					//prepare email........................
					$mail = new PHPMailer(true);
					$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'mail.groupoperation.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'reminder@toursvision.com';                 // SMTP username
					$mail->Password = 'reminder@987';                           // SMTP password
					$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 465;
					$Eto =$row['rec_email'];
					//Recipients
					$mail->setFrom($from, $branch_name);
					$mail->addAddress($Eto, '');     // Add a recipient
					//$mail->addAddress('ellen@example.com');               // Name is optional
					$mail->addReplyTo('reminder@toursvision.com', '');
					//$mail->addCC('cc@example.com');
					//$mail->addBCC('bcc@example.com');
				
					//Attachments
					//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
					//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				
					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $Esubject;
					$mail->Body    = $Emessage;
					//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					if($mail->send()){ 	
					   // $reminderID=$cm->u_value("reminder", "id", "status='pending' and id=".$row['id']."");
					    if(!empty($row['mobile'])){
					       $type = "xml"; 
                			$id ='tourvision'; 
                			$pass ='mazhar381'; 
                			$mask ='TOUR VISION';
                			$lang = "English"; 
                		 	//text Message Code
                			$to =$row['mobile'];
                			$message =$row['message'];
                 			$message = urlencode($message);   
                 			// Prepare data for POST request 
                			 $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;   
                			 // Send the POST request with cURL 
                			 $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url'); 
                			 curl_setopt($ch, CURLOPT_POST, true); 
                			 curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
                			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                			 $result = curl_exec($ch); //This is the result from SMS4CONNECT cu
                			 $xml=simplexml_load_string($result) or die("Error: Cannot create object");
					    }
					    $cm->update("reminder", "status='read'", "id=".$row['id']."");
					}
					else {
					    $el['status']='0'; 
					    
					}
					
			}
?>