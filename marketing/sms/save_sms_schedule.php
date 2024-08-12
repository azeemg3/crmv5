<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['gId']) && $_POST['total_sms']>0)
{
	$var=$_POST['time'];
	$m=strstr($var, " ",true);
	$m=explode(":", $m);
	$hour=$m[0];
	$minute=$m[1];
	$format=strstr($var, " ");
	$data['group_id']=$_POST['gId'];
	$data['schedule_date']=$_POST['schedule_date'];
	$data['schedule_hour']=trim($hour);
	$data['schedule_minute']=trim($minute);
	$data['schedule_format']=trim($format);
	$data['limit_frm']=$_POST['limit_frm'];
	$data['total_sms']=$_POST['total_sms'];
	$data['message']=$_POST['message'];
	$data['create_time']=$cm->current_dt();
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['status']='pending';
	$query=$cm->insert_array("sms_schedule", $data);
}
if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:sms_schedule");
?>