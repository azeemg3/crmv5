<?php 
require_once'inc.func.php';\
session_start();
$Emessage="";
$result=$cm->selectData("office_doc_alerts","branch_id=".$_SESSION['branch_id']."");
if($result)
{
while ($row=$result->fetch_assoc()) 
{
	if ($row['status']=='pending' && $row['alert_date']==$cm->today()) 
	{
		$Emessage.='<h3 align="center">Reminder About Document</h3><br>Due Date: '.$row['due_date'].'<br> Expire Will: '.$row['exp_date'].'';
		$Eto =$row['rec_email'].'azeemkhalidg3@gmail.com,mazhar@toursvision.com';
		$cm->update("office_doc_alerts","status='process'", "id=".$row['id']."");
	}
	else if($row['status']=='process' && $row['due_date']==$cm->today()) 
	{
		$Emessage.='<h3 align="center">Reminder About Document</h3><br>Due Date: '.$row['due_date'].'<br> Expire Will: '.$row['exp_date'].'';
		$Eto =$row['rec_email'].'azeemkhalidg3@gmail.com,mazhar@toursvision.com';
	}
	else if($row['exp_date']==$cm->today()) 
	{
		$Emessage.='<h3 align="center">Reminder About Document</h3><br>Due Date: '.$row['due_date'].'<br> Expire Will: '.$row['exp_date'].'';
		$Eto =$row['rec_email'].'azeemkhalidg3@gmail.com,mazhar@toursvision.com';
	}
}
}
if(!empty($Emessage))
{
	$from='azeem@toursvision.com';
		$Esubject ='Important Reminder';
		$Eheaders ="From: \"Tour Vision Travel\"<$from>\r\n";
		$Eheaders .= "Reply-To:".$to."\r\n";
		$Eheaders .= "MIME-Version: 1.0\r\n";
		$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$Eheaders .= "X-Priority: 3\r\n";
		$Eheaders .= "X-Mailer: PHP". phpversion() ."\r\n"; 
		mail($Eto, $Esubject, $Emessage, $Eheaders);
}

?>