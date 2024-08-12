<?php
session_start();
require_once'../../inc.func.php';
//if($cm->user_access("branch_admin", $_SESSION['sessionId']))
//{
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
	$whereArr=array();
	if(!empty($_POST))
	{
		$contact_name=$_POST['contact_name'];
		$leadId=$_POST['leadId'];
		$mobile_no=$_POST['mobile_no'];
		$spo=$_POST['spo'];
		if($contact_name!="")$whereArr[]="contact_name LIKE '%$contact_name%'";
		if($leadId!='')$whereArr[]="id=".$leadId."";
		if($mobile_no!='')$whereArr[]="mobile='".$mobile_no."'";
		if($spo!='')$whereArr[]="userId=".$spo."";
		$whereArr[]="branch_id=".$_SESSION['branch_id']."";
		$sWhere = implode(" AND ", $whereArr);
	}
	$result=$cm->selectData("lead", " {$sWhere} AND status!='Trashed' ORDER BY id DESC LIMIT $start, $per_page");
	$total_rec=$cm->count_val("lead","id", "{$sWhere} AND status!='Trashed'");
	$spoName="";
	$count=1;
	$leadId="";
	while($row=$result->fetch_assoc())
	{
		$leadId=$row['id'];
		echo '<tr id="'.$row['id'].'">
					<td>'.$count++.'</td>
					<td>'.$cm->serial($row['id']).'</td>
					<td>'.$row['contact_name'].'</td>
					<td>'.$row['mobile'].'</td>
					<td>'.$cm->u_value("user", "name", "id=".$row['spo']."").'</td>
					<td align="center">'.$cm->ls_clr($row['status']).'</td>
					<td>'.$row['services'].'</td>
					<td>'.$lead->ledger_summary($leadId).'</td>
					<td>
					<a class="btn btn-app" href="../lead_details?leadId='.$cm->encodeData($row['id']).'">
						<i class="fa fa-eye"></i>
					</a>
					</td>
			  </tr>
			 ';
	}
	if(empty($leadId))
	{
		echo $cm->nothing_found($leadId, '10');
	}
	//if($total_rec>10)
	echo '<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page, "get_allLeads").'</td></tr>';
//}
?>
