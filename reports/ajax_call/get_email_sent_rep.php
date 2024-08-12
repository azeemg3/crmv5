<?php
require_once'../../inc.func.php';
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
$per_page=30;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$sWhere=""; $whereArray=array();
$array=array();$arrayofArray=array(); $secArray=array(); $data=""; $count=1; $id="";
if(isset($_POST) && !empty($_POST['branch']))
{
	if(!empty($_POST['branch'])) $whereArray[]="email_sent_rep.branch=".$_POST['branch']."";
	if(!empty($_POST['df']) && !empty($_POST['dt']))
	{
	$df=date('Y-m-d', strtotime( $_POST['df'] ));
	$dt=date('Y-m-d', strtotime( $_POST['dt'] ));
		$whereArray[]="STR_TO_DATE(email_date, '%Y-%m-%d') BETWEEN  STR_TO_DATE('$df', '%Y-%m-%d') AND STR_TO_DATE('$dt', '%Y-%m-%d')";
	}
	else $whereArray[]="email_sent_rep.branch=".$_SESSION['branch_id']."";
}
$sWhere=implode(" AND ",$whereArray);
$result=$cm->selectData("email_sent_rep", "{$sWhere} ORDER BY email_sent_rep_id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("email_sent_rep","email_sent_rep_id", "{$sWhere}");
while($row=$result->fetch_assoc())
{
	$id=$row['email_sent_rep_id'];
	 $data.='
		<tr>
		 <td>'.$count++.'</td>
		 <td>'.$row['email'].'</td>
		 <td>'.(($row['status']==1)?"Sent":"Failed").'</td>
		 <td>'.$row['email_date'].'</td>
		</tr>
		';
}
$data.=$cm->nothing_found($id, 4); 
$data.='<tr><td colspan="4">'.$cm->pagination($total_rec,$cur_page, $per_page).'</td></tr>';
echo $data;
?>
