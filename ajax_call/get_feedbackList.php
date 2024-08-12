<?php
require_once'../inc.func.php';
$sWhere=""; $whereArr=array(); $id="";
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
	if(!empty($_POST['df'])) $whereArr[]="STR_TO_DATE(client_feedback.feedback_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$_POST['df']."', '%d-%m-%Y') AND STR_TO_DATE('".$_POST['dt']."', '%d-%m-%Y ')";
	if(!empty($_POST['spo'])) $whereArr[]="lead.spo=".$_POST['spo']."";
	else $whereArr[]="1";
	$sWhere=implode(" AND ", $whereArr);
}
$result=$cm->selectMultiData("client_feedback.id,client_feedback.feedback, client_feedback.feedback_date,client_feedback.lead_to,lead.contact_name,lead.status ,client_feedback.leadId, lead.spo, lead.create_date,  user.name", "client_feedback 
INNER JOIN lead ON client_feedback.leadId=lead.id
INNER JOIN user ON client_feedback.lead_to=user.id
", "{$sWhere} ORDER BY id DESC LIMIT $start, $per_page");
while($row=$result->fetch_assoc())
{
	$id=$row['id'];
	$data.='<tr>
			<td>'.$row['leadId'].'</td>
			<td>'.strtoupper($row['contact_name']).'</td>
			<td>'.strtoupper($row['name']).'</td>
			<td>'.ucfirst($row['status']).'</td>
			<td>'.$row['create_date'].'</td>
			<td>'.$row['feedback'].'</td>
			<td>'.$row['feedback_date'].'</td>
			<td>'.$cm->work_sicne($row['create_date']).'</td>
	</tr>';
}
$data.=$cm->nothing_found($id, 10);
echo $data;
?>