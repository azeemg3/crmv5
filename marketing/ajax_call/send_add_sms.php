<?php
require_once'../../inc.func.php';
session_start();
if(isset($_GET['sms_type']) && $_GET['sms_type']=='uni')
{
	$subject=$_POST['subject'];
	$mobile=$_POST['mobile'];
	$message=$_POST['message'];
	$marketing->uni_mar_msg($subject,$mobile,$message);
}
?>