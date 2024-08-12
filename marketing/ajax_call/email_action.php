<?php
ini_set('max_execution_time', 3000);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once'../../inc.func.php';
/*require 'vendor/autoload.php';*/
require 'php-mailer/src/Exception.php';
require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
session_start();  
$msg="";

if(isset($_GET['action']) && $_GET['action']=='sel_email')
{
	//$marketing->slected_emails($_POST['subject'], $_POST['emails'],$_POST['details'], $_POST['email_from']);
	$sign_log=$cm->u_value("branches", "sign_logo", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$branch_name=strtoupper($cm->u_value("branches", "branch_name", "status='active' AND 
	branch_id=".$_SESSION['branch_id'].""));
	$address=$cm->u_value("branches", "address", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$branch_email=$cm->u_value("branches", "branch_email", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$phone_line=$cm->u_value("branches", "phone_line", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$mobile=$cm->u_value("branches", "mobile", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$web=$cm->u_value("branches", "web", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$id=$cm->u_value("adress_book", "id", "email='admin@toursvision.com'");
	$email_header=$cm->u_value("branches", "email_header", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$Ename =strtoupper($cm->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id'].""));
	$Emessage .= "
			<html>
			 <body>
				<div style='max-width:800px; margin:auto; height:auto; font-family:Calibri; background-color:#f0f7ed; padding:10px;'>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
						<td><img src='https://crmv4.groupoperation.com/branch_logo/".$email_header."' width='100%' /></td>
						</tr>
						<tr>
						<td>
						".$_POST['details']."
						</td>
						</tr>
						<!--<tr>
						<td>
						<hr/>
						<a href='http://toursvision.com/crmv2/e-marketing/email_sub.php/?id=".base64_encode($id)."' target='_blank'>Unsubscribe</a>
						<br>
						<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
				'.$branch_name.' | '.$address.' | Office: '.$phone_line.' | Mob: '.$mobile.' | 
				<a href="http://'.$web.'/" target="_blank">Visit Web Site</a>
				')."		
				</p>
				<img src='http://www.toursvision.com/crmv2/branch_logo/".$sign_log."'>
				<hr>
				</td>
				</tr>-->
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
						<p>".nl2br(''.$address.' <a href="http://'.$web.'/" target="_blank">'.$web.'</a>')."</p>
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

	</div>
  </html>
</body>";
	$eachEmail=explode(",",$_POST['emails']);
	foreach($eachEmail as $email)
	{
		$Eto=$email;
		$from=$_POST['email_from'];
		$Esubject =$_POST['subject'];
		//prepare email........................
		$mail = new PHPMailer(true);
		$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.toursvision.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'marketing@toursvision.com';                 // SMTP username
		$mail->Password = 'marketing786';                           // SMTP password
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
		if($mail->send()){ $el['status']='1';	}
					else { $el['status']='0'; }
		$el['branch']=$_SESSION['branch_id'];
		$el['email']=$Eto;
		$cm->insert_array("email_sent_rep", $el, "email_date","NOW()");
		
		sleep(10);
		
	}
}
elseif(isset($_GET['action']) && $_GET['action']=='bulk_emails')
{
	$already_in_process=$cm->u_value("bulk_email_text", "status", "status='in_process'");
	if($already_in_process!=="in_process")
	{
		$cm->update("address_book JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "address_book.email_sent_rep='1'", "branch_id=".$_SESSION['branch_id']." AND ab_personal_info.email!=''");
		$col=array("subject, email_text, status, userId, branch, email_from, type");
		$val=array($_POST['subject'], $_POST['email_text'], 'in_process', $_SESSION['sessionId'], $_SESSION['branch_id'], 
		$_POST['from_email'], 'address_book');
		$cm->insertData("bulk_email_text", $col, $val);
	}
	else
	{
		echo $msg=1;
	}
}
elseif(isset($_GET['action']) && $_GET['action']=='lead_bulk_emails')
{
	$already_in_process=$cm->u_value("bulk_email_text", "status", "status='in_process'");
	if($already_in_process!=="in_process")
	{
		$cm->update("lead", "email_sent_status='1'", "branch_id=".$_SESSION['branch_id']." AND email!=''");
		$col=array("subject, email_text, status, userId, branch, email_from, type");
		$val=array($_POST['subject'], $_POST['email_text'], 'in_process', $_SESSION['sessionId'], $_SESSION['branch_id'], 
		$_POST['from_email'], 'lead');
		$cm->insertData("bulk_email_text", $col, $val);
	}
	else
	{
		echo $msg=1;
	}
}
?>