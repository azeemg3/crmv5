<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['conservation']))
{
	$data=$_POST;
	$fetch=array();
	$leadId=$_GET['leadId'];
	$data['conservation_frm']=$_SESSION['sessionId'];
	$data['status']='unread';
	$data['spo_read']='no';
	$data['date_time']=$cm->current_dt();
	$data['leadId']=$leadId;
	$data['userId']=$_GET['spo'];
	$cm->insert_array("spo_leadconservation", $data);
	$query=$cm->selectData("spo_leadconservation", "leadId=".$leadId." ORDER BY id DESC LIMIT 1");
	$j=0;
	while($row=$query->fetch_assoc())
	{
		$fetch[]=$row;
		$fetch[$j]['message_from']=$cm->u_value("user", "name", "id=".$row['conservation_frm']."");
		$j++;
	}
	echo json_encode($fetch);	
}
else
{
	$leadId=$_GET['leadId'];
	$cm->update("spo_leadconservation", "status='read'", "leadId=".$leadId." AND userId=".$_SESSION['sessionId']."");
	$query=$cm->selectData("spo_leadconservation", "leadId=".$leadId."");
	$i=0;
	while($row=$query->fetch_assoc())
	{
		$fetch[]=$row;
		$fetch[$i]['message_from']=$cm->u_value("user", "name", "id=".$row['conservation_frm']."");
		$fetch[$i]['client_name']=$cm->u_value("lead", "contact_name", "id=".$row['leadId']."");
		$fetch[$i]['convLeadId']=$cm->encodeData($row['leadId']);
		$i++;
	}
	echo json_encode($fetch);
}
?>