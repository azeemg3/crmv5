<?php
session_start();
require_once'inc.func.php';
$cm=new crm();
$data=$_POST;
if(isset($_POST['vendor_name']) && !empty($_POST['vendor_name']))
{
	$data['create_date']=$cm->current_dt();
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$query=$cm->insert_array("vendors", $data);
	if($query==true){echo $msg=2;}
	else{echo $msg=1; }
}
elseif(isset($_GET['del_rec']) && !empty($_GET['del_rec']))
{
	$cm->delete("vendors", "vendor_id=".$_GET['del_rec']."");
}
?>