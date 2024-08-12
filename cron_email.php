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
$branch=$cm->u_value("bulk_email_text", "branch", "status='in_process' AND type='address_book'");
if(!empty($branch))
{
$query=$cm->selectMultiData("address_book.*, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "address_book.email_sent_rep=1  AND branch_id=".$branch." AND ab_personal_info.email!='' GROUP bY ab_personal_info.email LIMIT 100");
$sign_log=$cm->u_value("branches", "sign_logo", "status='active' AND branch_id=".$branch."");
$branch_name=strtoupper($cm->u_value("branches", "branch_name", "status='active' AND branch_id=".$branch.""));
$address=$cm->u_value("branches", "address", "status='active' AND branch_id=".$branch."");
$branch_email=$cm->u_value("branches", "branch_email", "status='active' AND branch_id=".$branch."");
$phone_line=$cm->u_value("branches", "phone_line", "status='active' AND branch_id=".$branch."");
$mobile=$cm->u_value("branches", "mobile", "status='active' AND branch_id=".$branch."");
$web=$cm->u_value("branches", "web", "status='active' AND branch_id=".$branch."");
	while($row=$query->fetch_assoc())
	{
		$id=$row['address_id'];
		$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:800px; margin:auto; height:auto; font-family:Calibri; background:#f0f7ed; padding:10px; '>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
						<td><img src='https://crmv4.groupoperation.com/branch_logo/".$cm->u_value("branches", "email_header", "status='active' AND branch_id=".$branch."")."' style='width:100%;' /></td>
						</tr>
						<tr>
						<td>
						<span style='color:green;'>
						".$cm->u_value("bulk_email_text", "email_text", "branch=".$branch." AND status='in_process'")."
						<br>
						
						</span>
						</td>
						</tr>
						<tr>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;'  colspan='10'>
					<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
				'.$branch_name.'
				')."		
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
					<p>".$address." <a href='http://".$web."/' target='_blank'>".$web."</a></p>
					<a href='email_sub?id=".base64_encode($id)."' target='_blank'>Unsubscribe</a><br>
					</td>
				</tr>	
						
			</table>

</div>"."<br>";
		$from=$cm->u_value("bulk_email_text", "email_from", "branch=".$branch." AND status='in_process'");
		$Email=$cm->u_value("ab_personal_info", "email", "address_id=".$row['address_id']."");
		//$Eto =$email;
		$Esubject =$cm->u_value("bulk_email_text", "subject", "status='in_process' AND branch=".$branch."");
		//prepare email........................
		//$Eto=$Email;
		/*$email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("".$from."", "".$branch_name."");
		$email->setSubject("".$Esubject."");
		$email->addTo($Eto, "");
		$email->addContent(
			"text/html", "".$Emessage.""
		);
		$sendgrid = new \SendGrid(($apiKey));
		try {
				$response = $sendgrid->send($email);
				$el['status']='1';
				$el['branch']=$_SESSION['branch_id'];
				$el['email']=$Eto;
				$cm->insert_array("email_sent_rep", $el, "email_date","NOW()");
			
			/*print $response->statusCode() . "\n";
			print_r($response->headers());
			print $response->body() . "\n";*/
		//} catch (Exception $e) {
			//echo 'Caught exception: '. $e->getMessage() ."\n";
		//}*/
		$mail = new PHPMailer(true);
		$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.toursvision.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'marketing@toursvision.com';                 // SMTP username
		$mail->Password = 'marketing786';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;
		$Eto =$row['email'];
		//Recipients
		$mail->setFrom($from, $branch_name);
		$mail->addAddress($Eto, '');     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('sales@toursvision.com', '');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
	
		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	
		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $Esubject;
		$mail->Body    = $Emessage;
		if($mail->send()){ $el['status']='1';	}
					else { $el['status']='0'; }
		$email_text_id=$cm->u_value("bulk_email_text", "id", "status='in_process'");
			$el['email_text_id']=$email_text_id;
			$el['branch']=$branch;
			$el['email']=$row['email'];
			$cm->insert_array("email_sent_rep", $el, "email_date","NOW()");
			$cm->update("address_book", "email_sent_rep='0'", "address_id=".$id." AND branch_id=".$branch."");
		$email_in_pro=$cm->count_val("address_book", "address_id", "email_sent_rep='1' AND branch_id=".$branch."");
		if($email_in_pro==0 || $email_in_pro="")
		{
			$cm->update("bulk_email_text", "status='completed'", "status='in_process'");
			
		}
		sleep(5);
	}
}
//$marketing->lead_bulk_email();
$lead_branch=$cm->u_value("bulk_email_text", "branch", "status='in_process' AND type='lead'");
if(!empty($lead_branch))
{
		$query=$cm->selectMultiData("id,email", "lead", "email_sent_status=1  AND branch_id=".$branch." AND 
			email!='' GROUP bY email LIMIT 50");
			$sign_log=$cm->u_value("branches", "sign_logo", "status='active' AND branch_id=".$branch."");
			$branch_name=strtoupper($cm->u_value("branches", "branch_name", "status='active' AND branch_id=".$branch.""));
			$address=$cm->u_value("branches", "address", "status='active' AND branch_id=".$branch."");
			$branch_email=$cm->u_value("branches", "branch_email", "status='active' AND branch_id=".$branch."");
			$phone_line=$cm->u_value("branches", "phone_line", "status='active' AND branch_id=".$branch."");
			$mobile=$cm->u_value("branches", "mobile", "status='active' AND branch_id=".$branch."");
			$web=$cm->u_value("branches", "web", "status='active' AND branch_id=".$branch."");
			while($row=$query->fetch_assoc())
			{
				$id=$row['id'];
				$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:800px; margin:auto; height:auto; font-family:Calibri; background:#f0f7ed; padding:10px; '>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
						<td>
						<img src='https://crmv4.groupoperation.com/branch_logo/".$cm->u_value("branches", "email_header", "status='active' AND branch_id=".$branch."")."' /></td>
						</tr>
						<tr>
						<td>
						<span style='color:green;'>
						".$cm->u_value("bulk_email_text", "email_text", "branch=".$branch." AND status='in_process'")."
						<br>
						<!--<a href='email_sub?id=".base64_encode($id)."' target='_blank'>Unsubscribe</a>--><br>
						".$data."
						</span>
						</td>
						</tr>
						<tr>
							<td  style='border: 1px solid white;padding: 4px;background: #fff;'  colspan='10'>
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
					$from=$cm->u_value("bulk_email_text", "email_from", "branch=".$branch." AND status='in_process'");
					$Eto =$row['email'];
					$Esubject =$cm->u_value("bulk_email_text", "subject", "status='in_process' AND branch=".$branch."");
					//prepare email........................
					$mail = new PHPMailer(true);
					$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'mail.groupoperation.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'sales@toursvision.com';                 // SMTP username
					$mail->Password = 'sales987';                           // SMTP password
					$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 465;
					$Eto =$email;
					//Recipients
					$mail->setFrom($from, $branch_name);
					$mail->addAddress($Eto, '');     // Add a recipient
					//$mail->addAddress('ellen@example.com');               // Name is optional
					$mail->addReplyTo('sales@toursvision.com', '');
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
					if($mail->send()){ $el['status']='1';	}
					else { $el['status']='0'; }
					$email_text_id=$cm->u_value("bulk_email_text", "id", "status='in_process'");
					$el['email_text_id']=$email_text_id;
					$el['branch']=$branch;
					$el['email']=$row['email'];
					$cm->update("lead", "email_sent_status='0'", "email='".$row['email']."' AND branch_id=".$branch."");
					$cm->insert_array("email_sent_rep", $el, "email_date","NOW()");
			}
			$email_in_pro=$cm->count_val("lead", "id", "email_sent_status='1' AND branch_id=".$branch."");
				if($email_in_pro==0 || $email_in_pro="")
				{
					$cm->update("bulk_email_text", "status='completed'", "status='in_process'");
					
				}
			
}
?>