<?php
require_once'../../inc.func.php';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	echo $message=urldecode($cm->u_value("sms_logs","message", "id=".$id.""));
}
?>