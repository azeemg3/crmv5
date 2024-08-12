<?php
require_once'../inc.func.php';
session_start();
$rows=array();
if(isset($_GET['acc_type']) && !empty($_GET['acc_type']))
{
	$acc_type=$_GET['acc_type'];
	$result=$cm->selectData("trans_acc","trans_acc_type='".$acc_type."' AND branch_id=".$_SESSION['branch_id']."");
	while($row=$result->fetch_assoc())
	{
		$rows[]=$row;
	}
	echo json_encode($rows);
}
?>