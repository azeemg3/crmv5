<?php
require_once'../../inc.func.php';
if(isset($_GET['id']) && !empty($_GET['type']))
{
	$id=$_GET['id'];
	$type=$_GET['type'];
	$leadId=$_GET['leadId'];
	$array=array();
	$lr=$cm->selectData("lead","id=".$leadId."");
	$array['lead']=$lr->fetch_assoc();
	if($type=="ticket")
	{
		$result=$cm->selectData("add_sale", "id=".$id."");
		$row=$result->fetch_assoc();
		$array['ticket']=$row;
		$array['saleStaff']=$cm->u_value("user", "name", "id=".$row['salesStaff']."");
		$array['vendor']=$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['vendor_id']."");
		echo json_encode($array);
		exit();
	}
	elseif($type=="other")
	{
		$result=$cm->selectData("other_sale", "id=".$id."");
		$row=$result->fetch_assoc();
		$array['other']=$row;
		$array['saleStaff']=$cm->u_value("user", "name", "id=".$row['salesStaff']."");
		$array['vendor']=$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['vendor_id']."");
		echo json_encode($array);
		exit();
	}
}
?>