<?php
require_once'../inc.func.php';
session_start();
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
$whereArray=array(); $sWhere=""; $id="";
if(isset($_POST))
{
	if(!empty($_POST['df']) && !empty($_POST['dt'])) $whereArray[]="STR_TO_DATE(lead.create_date, '%d-%m-%Y') 
	BETWEEN  STR_TO_DATE('".$_POST['df']."', '%d-%m-%Y') AND STR_TO_DATE('".$_POST['dt']."', '%d-%m-%Y ')";
	if(!empty($_POST['contact_name'])) $whereArray[]="lead.contact_name like '%".$_POST['contact_name']."%'";
	if(!empty($_POST['mobile_no'])) $whereArray[]="lead.mobile='".$_POST['mobile_no']."'";
	if(!empty($_POST['leadId'])) $whereArray[]="lead.id=".$_POST['leadId']."";
	if(!empty($_POST['status'])) $whereArray[]="lead.status='".$_POST['status']."'";
	if(!empty($_POST['service_type'])) $whereArray[]="lead.services='".$_POST['service_type']."'";
	if(!empty($_POST['spo'])) $whereArray[]="lead.spo='".$_POST['spo']."'";
	$whereArray[]="user.team_leader_id=".$_SESSION['sessionId']."";
	$sWhere=implode(" AND ", $whereArray);
	
}
$result=$cm->selectMultiData("user.*, lead.id AS leadId, lead.contact_name AS contactName, lead.mobile AS leadMobile, lead.spo, 
lead.status AS leadStatus,lead.travel_datefrm, lead.travel_dateto, lead.services","user INNER JOIN lead ON user.id=lead.userId", "{$sWhere}
  LIMIT $start, $per_page");
$total_rec=$cm->count_val("lead INNER JOIN user ON lead.userId=user.id","lead.id", "{$sWhere}");
$data=""; $count=1;
while($row=$result->fetch_assoc())
{
	$id=$row['leadId'];
	$data.='
			<tr>
			 <td>'.$count++.'</td>
			 <td>'.$row['leadId'].'</td>
			 <td>'.$row['contactName'].'</td>
			 <td>'.$row['leadMobile'].'</td>
			 <td>'.$cm->u_value("user", "name", "id=".$row['spo']."").'</td>
			 <td>'.$row['leadStatus'].'</td>
			 <td>'.$row['travel_datefrm'].'/'.$row['travel_dateto'].'</td>
			 <td>'.ucfirst($row['services']).'</td>
			 <td><a class="btn btn-app" href="team_lead_details?leadId='.$cm->encodeData($row['leadId']).'"><i class="fa fa-eye"></i></a></td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10" align="right">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo $data;
?>