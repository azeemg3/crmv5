<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['comment']))
{
	$fetch=array();
	$leadId=$_GET['leadId'];
	$data['con_date']=$cm->current_dt();
	$data['lead_id']=$leadId;
	$data['status']='pending';
	$data['comment']=$cm->db()->real_escape_string(str_replace("\n","<br />", $_POST['comment'])); 
	$data['reminder_date']=$_POST['reminder_date'];
	$data['status']='pending';
	$data['userId']=$_SESSION['sessionId'];
	$remEmail=$cm->u_value('user','email', 'id='.$_SESSION['sessionId'].' LIMIT 1');
	$remMobile=$cm->u_value('user','phone', 'id='.$_SESSION['sessionId'].' LIMIT 1');
	//active reminder
	$remData['message']='Lead No: '.$leadId.'<br>Message:'.$_POST['comment'].'';
	$remData['reminder_date']=$_POST['reminder_date'];
	$remData['reminder_time']=$_POST['reminder_time'];
	$remData['reminder_min']=$_POST['reminder_min'];
	$remData['create_date']=$cm->current_dt();
	$remData['userId']=$_SESSION['sessionId'];
	$remData['status']='pending';
	$remData['rec_email']=$remEmail;
	$remData['mobile']=$remMobile;
	$cm->insert_array("lead_conservation", $data);
	if(isset($_POST['reminder_date']) && !empty($_POST['reminder_date']))
	{
		$cm->insert_array("reminder",$remData);
	}
	$query=$cm->selectMultiData("lead_conservation.comment, lead_conservation.con_date, lead_conservation.reminder_date, lead_conservation.lead_id, lead_conservation.status, user.name, IF(user.id=".$_SESSION['sessionId'].", '#f39c12', '#3c8dbc') AS color","lead_conservation left join user on lead_conservation.userId=user.id", "lead_id=".$leadId." ORDER BY lead_conservation.id DESC LIMIT 1");
	while($row=$query->fetch_assoc())
	{
		$fetch[]=$row;
	}
	echo json_encode($fetch);	
}
else
{
	$leadId=$_GET['leadId'];
	$query=$cm->selectMultiData("lead_conservation.comment, lead_conservation.con_date, lead_conservation.reminder_date, lead_conservation.lead_id, lead_conservation.status, user.name, IF(user.id=".$_SESSION['sessionId'].", '#f39c12', '#3c8dbc') AS color","lead_conservation left join user on lead_conservation.userId=user.id", "lead_id=".$leadId."");
	while($row=$query->fetch_assoc())
	{
		$fetch[]=$row;
	}
	echo json_encode($fetch);
}
?>