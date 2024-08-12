<?php
require_once'../../inc.func.php';
if(isset($_GET) && !empty($_GET['cnic']))
{
	$cnic=$_GET['cnic'];
	$cnin_no=$cm->u_value("ab_personal_info","cnic_number","cnic_number=".$cnic."");
	$address_id=$cm->u_value("ab_personal_info","address_id","cnic_number=".$cnic."");
	echo $cnin_no,",",$address_id;
}
?>