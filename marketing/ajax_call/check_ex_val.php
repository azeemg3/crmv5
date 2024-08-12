<?php
require_once'../../inc.func.php';
if(isset($_GET['mobile']) && !empty($_GET['mobile']))
{
	$val=$_GET['mobile'];
	$value=$cm->u_value("ab_personal_info","mobile","mobile=".$val."");
	$address_id=$cm->u_value("ab_personal_info","address_id","mobile=".$val."");
	echo $value,",",$address_id;
}
elseif(isset($_GET['email']) && !empty($_GET['email']))
{
	$val=$_GET['email'];
	$value=$cm->u_value("ab_personal_info","email","email='".$val."'");
	$address_id=$cm->u_value("ab_personal_info","address_id","email='".$val."'");
	echo $value,",",$address_id;
}
?>