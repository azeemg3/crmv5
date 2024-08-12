<?php
require_once'../inc.functions.php';
require_once'../session.php';
$cm=new crm();
if(!empty($_POST['candidate_name']) && !empty($_POST['mobile']))
{
	$mobile=$cm->u_value("candidates", "mobile", "mobile=".$_POST['mobile']."");
	if(!empty($mobile))
	{
		echo "This candidate had alerady applied ";
	}
	else{
		$mobile=$_POST['mobile'];
		$code=92;
		$mobile=ltrim( $mobile,"092");
		$mobile=$code.$mobile;
        $mobile = preg_replace('/\s+/', '', $mobile);
	$columns=array("`candidate_name`, mobile,  `education`, `experience`, `location`, `skills`, `refrence`, `apply_date`, `apply_time`, `userId`, `branch`, status, job_id");
	$values=array($_POST['candidate_name'], $mobile, $_POST['education'], $_POST['experience'], $_POST['location'], $_POST['skill'], $_POST['refrence'], 
	$cm->today(), date("h:i:s"), $userSessionId, $user_branch, 'pending', $_POST['job_id']);
	$q=$cm->insertData("candidates", $columns, $values);
	if($q==true)
	{
		echo "Candidate Added Successfully";
	}
	else
	{
		echo "Invalid ";
	}
	}
}
else if(isset($_GET['dlt_rec']) && !empty($_GET['dlt_rec']))
{
	$dlt_rec=$_GET['dlt_rec'];
	$cm->delete("candidates","id=".$dlt_rec."");
}
if(isset($_GET['shortlist_id']) && !empty($_GET['shortlist_id']))
{
	$shortlist_id=$_GET['shortlist_id'];
	$query=$cm->update("candidates", "short_list_date='".$cm->today()."', status='Short Listed'", "id=".$shortlist_id."");
	echo "Short Listed Successfully";
	
}
else if(isset($_GET['reject_id']) && !empty($_GET['reject_id']))
{
	$reject_id=$_GET['reject_id'];
	$reason=$_POST['add_reason'];
	$query=$cm->update("candidates", "reject_reason='$reason' , status='Rejected'", "id=".$reject_id."");
	echo "Candidate Rejected Successfully";
	
}
else if(isset($_GET['hire_id']) && !empty($_GET['hire_id']))
{
	$hire_id=$_GET['hire_id'];
	$query=$cm->update("candidates", "hire_date='".$cm->today()."' , status='Hired'", "id=".$hire_id."");
	echo "Candidate Hired Successfully";
}
?>