<?php
require_once'inc.func.php';
date_default_timezone_set("Asia/karachi");
$result=crm::selectMultiData("id, schedule_date, schedule_hour, schedule_minute, schedule_format, limit_frm, total_sms, message, group_id", "sms_schedule", "status='pending' AND branch_id=1");
$mobiles="";
if($result){
while($row=$result->fetch_assoc())
{
	if($row['schedule_date']==date('d-m-Y') && date('h')==$row['schedule_hour'] && $row['schedule_minute']==date('i') && $row['schedule_format']==date('A'))
	{
		$smsResult=$cm->selectMultiData("address_book.group_id, ab_personal_info.mobile", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "address_book.group_id=".$row['group_id']." LIMIT ".$row['limit_frm'].", ".$row['total_sms']."");
		while($Srow=$smsResult->fetch_assoc())
		{
			$mobiles.=$Srow['mobile'].",";
		}
		$type = "xml"; 
		$id ='tourvision'; 
		$pass ='multan381'; 
		$mask ='TOUR VISION';
		$lang = "English"; 
		//text Message Code
		$to =$mobiles;
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
		 $cm->update("sms_schedule", "status='completed'", "id=".$row['id']."");
		 //$columns=array("code, mobile, message, date, userId, branch");
		 /*$values=array($xml->code, $to, $message, $this->current_dt(), $_SESSION['sessionId'], $_SESSION['branch_id'] );
			 $this->insertData("sms_status", $columns, $values);*/
	}
}
}
?>