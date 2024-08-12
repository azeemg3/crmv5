<?php
require_once'../inc.func.php';
session_start();
if(isset($_GET['leadId']) && !empty($_GET['leadId']) && !empty($_POST['feedback']))
{
	$leadId=$_GET['leadId'];
	$data=array();
	$data['feedback']=$_POST['feedback'];
	$data['leadId']=$leadId;
	$data['feedback_date']=$cm->current_dt();
	$data['lead_to']=$cm->u_value("lead", "spo", "id=".$leadId."");
	$data['userId']=$_SESSION['sessionId'];
	$data['branch']=$_SESSION['branch_id'];
	$result=$cm->insert_array("client_feedback", $data);
	$query=$cm->selectMultiData("feedback, feedback_date","client_feedback", "leadId=".$leadId." ORDER BY id DESC LIMIT 1");
	$row[]=$query->fetch_assoc();
	echo json_encode($row);

}
else
{
	$leadId=$_GET['leadId'];
	$query=$cm->selectMultiData("feedback, feedback_date","client_feedback", "leadId=".$leadId." ORDER BY id DESC");
	while($row=$query->fetch_assoc())
	{
		$fetch[]=$row;
	}
	echo json_encode($fetch);
}
?>