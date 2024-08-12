<?php
require_once'../../inc.func.php';
session_start();
$data="";
if(isset($_POST['opeing_balance']) && !empty($_POST['opeing_balance']) && !empty($_POST['type']))
{
	$opeing_balance=$_POST['opeing_balance'];
	$type=$_POST['type'];
	$leadId=$_POST['id'];
	$cm->update("lead", "opening_balance='$opeing_balance', dr_cr='$type'", "id=".$leadId."");
	echo $leadId,"~","".$cm->u_value("lead","dr_cr","id=".$leadId."").". ".$cm->show_bal_format($cm->u_value("lead","opening_balance","id=".$leadId.""));
	exit();
}
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
if(isset($_POST['srch_leadId']) && !empty($_POST['srch_leadId']))
{
	$whereArr=array();
	$leadId=$_POST['srch_leadId'];
	if($leadId!="") $whereArr[] = "status='process' AND id=".$leadId."";
	else {$sWhere='status="process"';}
	$sWhere = implode(" AND ", $whereArr);
}
else {$sWhere='status="process"';}
$count=1;
$query=$cm->selectData("lead", "$sWhere LIMIT $start, $per_page");
$total_records=$cm->selectMultiData("count(id) AS id ", "lead", "$sWhere");
while($row=$total_records->fetch_assoc()){
		 $total_rec=$row["id"];
}
while($row=$query->fetch_assoc())
{
	$data.= '
		<tr id="'.$row['id'].'">
			<td>'.$count++.'</td>
			<td>
				<a onclick="acc_lead_det('.$row['id'].')">
					'.(($row['id']<9) ? '0'.$row['id'].'' : "").'
					'.(($row['id']>9) ? ''.$row['id'].'' : "").'
				</a>
			</td>
			<td>'.$row['contact_name'].'</td>
			<td>'.$row['mobile'].'</td>
			<td>'.$cm->u_value("user", "name", "id=".$row['userId']."").'</td>
			<td class="amount">'.$row['dr_cr'].'. '.$cm->show_bal_format($row['opening_balance']).'</td>
			<td>'.$row['status'].'</td>
			<td>
				'.(($row['opening_balance']<=0 || $cm->user_access("branch_admin",$_SESSION['sessionId']))?'
					<a onclick="open_OB('.$row['id'].')"><span class="glyphicon glyphicon-new-window"></span> Add OB</a>
				':"N/A").'
				
			</td>
		</tr>
		';
}
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo $data;
?>
?>