<?php
session_start();
require_once'../inc.func.php';
$c_m=new crm();
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
$user_id=$_SESSION['sessionId'];
if(!empty($_POST['date_frm']) && !empty($_POST['date_to']))
{
	$date_frm=$_POST['date_frm'];
	$date_to=$_POST['date_to'];
$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND lead.status IN ('new', 'process') AND  STR_TO_DATE(create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y') AND STR_TO_DATE('$date_to', '%d-%m-%Y ')  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead", "id", "status IN ('new', 'process') AND  spo=".$user_id."");
}
else if(!empty($_POST['contact_name']))
{
	$contact_name=$_POST['contact_name'];
	$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND contact_name LIKE '%$contact_name%' AND lead.status IN ('new', 'process')  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead", "id", "status IN ('new', 'process') AND  spo=".$user_id."");
}
else if(!empty($_POST['leadId']))
{
	$leadId=$_POST['leadId'];
	$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND lead.id='$leadId' AND lead.status IN ('new', 'process')  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead", "id", "status IN ('new', 'process') AND  spo=".$user_id."");
}
else if(!empty($_POST['service_type']))
{
	$service_type=$_POST['service_type'];
	$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND lead.services='$service_type' AND lead.status IN ('new', 'process')  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead","id","status IN ('new', 'process') AND  spo=".$user_id."");
}
else if($_POST['mobile_no'])
{
	$mobile_no=$_POST['mobile_no'];
	$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND lead.mobile='$mobile_no' AND lead.status IN ('new', 'process')  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead","id", "status IN ('new', 'process') AND  spo=".$user_id."");
}
else if($_POST['status'])
{
	$status=$_POST['status'];
	$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND lead.status='$status'  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead", "id", "status='$status' AND  spo=".$user_id."");
}
else
{
	$result=$c_m->selectMultiData("user.id AS user_id, user.name AS user_name, lead.*", "user INNER JOIN lead ON user.id=lead.spo", 
"lead.spo=".$user_id." AND lead.status IN ('new', 'process')  ORDER BY lead.id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("lead", "id", "status IN ('new', 'process') AND spo=".$user_id."");

}
$count=1;
$leadId="";
while($row=$result->fetch_assoc())
{
	$leadId=$row['id'];
	echo '<tr>
				<td>'.$count++.'</td>
				<td>'.$cm->serial($row['id']).'</td>
				<td>'.$row['contact_name'].'</td>
                <td>'.$row['mobile'].'</td>
                <td>'.$row['user_name'].'</td>
                <td>
					'.(($row['status']=='new')? '<span style="color:#337ab7">'.$row['status'].'</span>' : "").'
					'.(($row['status']=='process')? '<span style="color:cadetblue">'.$row['status'].'</span>' : "").'
					'.(($row['status']=='successfull')? '<span style="color:darkgreen">'.$row['status'].'</span>' : "").'
					'.(($row['status']=='unsuccessfull')? '<span style="color:#c9302c">'.$row['status'].'</span>' : "").'
				</td>
                <td>'.$row['travel_datefrm'].'&nbsp;To&nbsp;'.$row['travel_dateto'].'</td>
                <td>'.$row['services'].'</td>
                <td>'.$lead->ledger_summary($leadId).'</td>
				<td><a class="btn btn-app" href="lead_details?leadId='.$cm->encodeData($row['id']).'" target="_blank">
					<i class="fa fa-fw fa-eye"></i></a>
				</td>
		  </tr>
		 ';
}
echo $c_m->nothing_found($leadId, "10");
echo '<tr><td colspan="10">'.$c_m->pagination($total_rec, $cur_page, $per_page, "get_myLeads").'</td></tr>';
?>