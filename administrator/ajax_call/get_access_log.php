<?php
require_once'../../inc.func.php';
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
$whereArray=array();
$sWhere="";
$id="";
if(!empty($_POST))
{
	$dt_frm=$_POST['date_frm'];
	$dt_to=$_POST['date_to'];
	if(!empty($dt_frm) && !empty($dt_to)) $whereArray[]="STR_TO_DATE(log_time, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ')";
	$whereArray[]="1";
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere ="1";
}
$result=$cm->selectData("access_logo", "{$sWhere} ORDER BY acc_log_id DESC LIMIT $start, $per_page");
$total_rec=$cm->count_val("access_logo","acc_log_id", "1");
$data="";
while($row=$result->fetch_assoc())
{
	$id=$row['acc_log_id'];
	$data.='
			<tr>
				<td>'.$row['log_time'].'</td>
				<td>'.$row['from_page'].'</td>
				<td>'.$row['to_page'].'</td>
				<td>'.$row['ip_address'].'</td>
				<td>'.$row['country'].'</td>
				<td>'.$cm->u_value("user", "name","id=".$row['userId']."").'</td>
				<td>'.$cm->u_value("branches", "branch_name","branch_id=".$row['branch']."").'</td>
				<td>'.$row['user_browser'].'</td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td>></tr>';
echo $data;
?>