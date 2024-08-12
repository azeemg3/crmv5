<?php
require_once'../../inc.func.php';
session_start();
date_default_timezone_set("Asia/Karachi");
$data=""; $count=1; $whereArr=array(); $sWhere="";
if(isset($_GET['page']))
	{
		$page=$_GET['page'];
	}
	else
	{
		$page=1;
	}
	if(isset($_POST['per_page']) && !empty($_POST['per_page']))
	{
		$per_page=$_POST['per_page'];
	}
	else{ 
	$per_page=10;
	}
	$cur_page = $page;
	$page -=1;
	$start = $page * $per_page;
if(isset($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt'])) { $whereArr[]="STR_TO_DATE(lead_transfer.transfer_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$_POST['df']."', '%d-%m-%Y') AND STR_TO_DATE('".$_POST['dt']."', '%d-%m-%Y ')";}
	else { $whereArr[]="STR_TO_DATE(lead_transfer.transfer_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND 
	STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')"; }
	if(!empty($_POST['leadId'])) $whereArr[]="lead_transfer.leadId=".$_POST['leadId']."";
	if(!empty($_POST['mobile_no'])) $whereArr[]="lead.mobile=".$_POST['mobile_no']."";
	if(!empty($_POST['status'])) $whereArr[]="lead.status='".$_POST['status']."'";
	if($cm->user_access("branch_admin", $_SESSION['sessionId']))
	{
		$whereArr[]="lead.branch_id=".$_SESSION['branch_id']."";
	}
	else
	{
		$whereArr[]="lead_transfer.transfer_from=".$_SESSION['sessionId']."";
	}
	$sWhere=implode(" AND ", $whereArr);
}
$result=$cm->selectMultiData("lead.branch_id, lead.contact_name,lead.mobile,lead.status, lead.services, lead_transfer.transfer_from, lead_transfer.transfer_from, lead_transfer.transfer_to, lead_transfer.leadId, lead_transfer.transfer_date, lead_transfer.id", "lead INNER JOIN lead_transfer ON lead.id=lead_transfer.leadId", "{$sWhere} LIMIT $start, $per_page");
$total_rec=$cm->count_val("lead INNER JOIN lead_transfer ON lead.id=lead_transfer.leadId", "lead.id", "{$sWhere}");
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['id'];
	$data.= '
		<tr>
		 <td>'.$count++.'</td>
		 <td>'.$row['leadId'].'</td>
		 <td>'.$row['contact_name'].'</td>
		 <td>'.$row['mobile'].'</td>
		 <td>'.$cm->u_value("user", "name", "id=".$row['transfer_from']."").'</td>
		 <td>'.$cm->u_value("user", "name", "id=".$row['transfer_to']."").'</td>
		 <td>'.$row['status'].'</td>
		 <td>'.$row['transfer_date'].'</td>
		 <td>'.$cm->emptyWord($row['services']).'</td>
		 <td><a target="_blank" href="../lead_details?leadId='.$cm->encodeData($row['leadId']).'" class="btn btn-app btn-default"> <i class="fa fa-eye"></i></a></td>
		</tr>
		';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec,$cur_page, $per_page).'</td></tr>';
echo $data;
?>