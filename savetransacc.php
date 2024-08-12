<?php
session_start();
require_once'inc.func.php';
$cm=new crm();
$data=$_POST;
$query="";
if(isset($_POST['trans_acc_name']) && !empty($_POST['trans_acc_name']))
{
	if(isset($_POST['trans_acc_id']) && empty($_POST['trans_acc_id']))
	{
		$trans_acc=$cm->u_value("trans_acc","trans_acc_name", "trans_acc_name='".$_POST['trans_acc_name']."' AND 
		branch_id=".$_SESSION['branch_id']."");
		if(empty($trans_acc))
		{
			$data['userId']=$_SESSION['sessionId'];
			$data['branch_id']=$_SESSION['branch_id'];
			$data['status']='active';
			$query=$cm->insert_array("trans_acc", $data, "create_date","NOW()");
			if($query==1){echo $msg=$query;}
			else{echo $msg=2; }
		}
		else
		{
			echo $msg=1062;
		}
		
	}
	else
	{
		$trans_acc_id=$_POST['trans_acc_id'];
		$query=$cm->update_array("trans_acc",$data, "trans_acc_id=".$trans_acc_id."");
		if($query==1){echo $msg=$query;}
		else{echo $msg=2; }
	}
}
?>