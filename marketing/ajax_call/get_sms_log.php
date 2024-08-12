<?php
require_once'../../inc.func.php';
$data=""; $count=1; $id=""; $sWhere=""; $total_rec=0;
$whereArray=array();
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
$per_page=50;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
if(isset($_POST))
{
	if(!empty($_POST['frm_dt']) && !empty($_POST['to_dt'])) 
	{
		$df=$_POST['frm_dt'];
		$dt=$_POST['to_dt']; $whereArray[]="STR_TO_DATE(date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	else{$whereArray[]="STR_TO_DATE(date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y ')";}
	$sWhere=implode("AND", $whereArray);
}
$result=$cm->selectData("sms_logs", "{$sWhere} ORDER BY id DESC LIMIT $start, $per_page");
while($row=$result->fetch_assoc())
{
	$id=$row['id'];
	$total_rec=+$count;
	$data.='<tr>
			<td>'.$count++.'</td>
			<td>'.$cm->u_value("user","name", "id=".$row['userId']."").'</td>
			<td>'.(($row['code']==300)?'Successfull':"Error").'</td>
			<td>'.urldecode(substr($row['message'], 0,50)).'....<a class="btn btn-link" onClick="msg_det_mdl('.$row['id'].')">See More</a></td>
			<td>'.$row['date'].'</td>
			<td>'.$cm->u_value("branches","branch_name", "branch_id=".$row['branch']."").'</td>
		</tr>';
}
$data.=$cm->nothing_found($id, 10);
if($total_rec>50)
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></td>';
echo $data;
?>