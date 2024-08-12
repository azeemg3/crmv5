<?php
require_once'../inc.functions.php';
require_once'../session.php';
$c_m=new crm();
if(isset($_POST) && !empty($_POST['name']))
{
	$data=$_POST;
	$id=$_POST['id'];
	if($id=="" || $id==0){
	$current_date=$c_m->current_dt();
	$c_m->insert_array("ofc_staff",$data, "added_date, ofc_staff_status, userId, branch_id", " '$current_date' , 'active', '$userSessionId', '$user_branch'");
	header("location:staff_list?sta=succ");
	}
	else {
		$col_val=array("name"=>$_POST['name'], "mobile"=>$_POST['mobile'], "`email`"=>$_POST['email'], "`department`"=>$_POST['department'], 
		"`description`"=>$_POST['description'], "`userId`"=>$userSessionId, "branch_id"=>$user_branch);
		$query=$c_m->update("ofc_staff", $col_val);
		header("location:staff_list?sta=succ");
	}
	
}
if(isset($_GET['dlt_rec']))
	{
		$dlt_rec=$_GET['dlt_rec'];
		$c_m->delete("ofc_staff", "id=".$dlt_rec."");
		
	}
if(!empty($_POST['change_hour']) && !empty($_POST['change_min']))
{
	$h=$_POST['change_hour'];
	$t=$_POST['change_min'];
	$time=$h.":".$t;
	$c_m->update("ofc_staff", "ofc_in_time='$time'", "branch_id=".$user_branch."");
	header("location:attendance");
}
?>