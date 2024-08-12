<?php
require_once'../inc.func.php';
session_start();
if(!empty($_POST['message']) && !empty($_POST['reminder_date']))
{
	$data=$_POST;
	$data['create_date']=$cm->current_dt();
	$data['status']='pending';
	$data['userId']=$_SESSION['sessionId'];
	$data['leadId']=$_GET['leadId'];
	$cm->insert_array("reminder", $data);
	exit;
}
elseif(isset($_GET['rem_id']) && !empty($_GET['rem_id']))
{
	echo '<span style="padding: 5px;color:#cc2127;font-size: 20px;font-family: monospace;">
	'.$cm->u_value("reminder", "reminder_date", "id=".$_GET['rem_id']."").' '.$cm->u_value("reminder", "reminder_time", "id=".$_GET['rem_id']."").'
	</span><br>
			<p>'.$cm->u_value("reminder", "message", "id=".$_GET['rem_id']."").'</p>
			';
		$cm->update("reminder", "status='read'", "id=".$_GET['rem_id']."");
}
else
{
	$result=$cm->selectData("reminder", "status='pending' AND userId=".$_SESSION['sessionId']."");
	while($row=$result->fetch_assoc())
	{
		$fetch[]=$row;
	}
	echo json_encode($fetch);
}
?>