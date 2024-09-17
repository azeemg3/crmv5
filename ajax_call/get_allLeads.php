<?php
session_start();
require_once'../inc.func.php';
if($cm->user_access("viewAllLeads", $_SESSION['sessionId']))
{
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
	$user_id=$_POST['user_id'];
	if(!empty($_POST))
	{
		$whereArr=array();
		$date_frm=$_POST['date_frm'];
		$date_to=$_POST['date_to'];
		$contact_name=$_POST['contact_name'];
		$leadId=$_POST['leadId'];
		$service_type=$_POST['service_type'];
		$mobile_no=$_POST['mobile_no'];
		$status=$_POST['status'];
		$spo=$_POST['spo'];
		$leadStatus=$_POST['leadStatus'];
		if($date_frm && $date_to !="")
		$whereArr[]="STR_TO_DATE(create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y') AND STR_TO_DATE('$date_to', '%d-%m-%Y ')";
		if($contact_name!="")$whereArr[]="contact_name LIKE '%$contact_name%'";
		if($leadId!='')$whereArr[]="id=".$leadId."";
		if($service_type!='')$whereArr[]="services LIKE '%$service_type%'";
		if($mobile_no!='')$whereArr[]="mobile='$mobile_no'";
		if($spo!='')$whereArr[]="spo=".$spo."";
		if($status!='')$whereArr[]="status='$status'";
		elseif($leadStatus!="") {$whereArr[]="status='$leadStatus'";}
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
		echo '<tr id="'.$row['id'].'" class="'.(($row['lp']=='urgent')?'bg-red-gradient':'').' '.(($row['lp']=='high')?'bg-orange':'').' 
        '.(($row['lp']=='medium')?'bg-green-gradient':'').' '.(($row['lp']=='low')?'bg-teal-gradient':'').'">
					<td>'.$count++.'</td>
					<td>'.$cm->serial($row['id']).'</td>
					<td>'.strtoupper($row['contact_name']).'</td>
					<td>'.$row['mobile'].'</td>
					<td>'.$cm->u_value("user", "name", "id=".$row['spo']."").'</td>
					<td align="center">'.$cm->ls_clr($row['status']).'</td>
					<td>'.((!empty($row['travel_datefrm']))?''.$row['travel_datefrm'].'':"N/A").'</td>
					<td>'.$row['travel_dateto'].'</td>
					<td>'.$row['services'].'</td>
					<td>'.$lead->ledger_summary($leadId).'</td>
					<td>
					'.(($cm->user_access("editLead",$_SESSION['sessionId']))?'
						<a class="btn btn-app btn-xs" href="create_new_lead?lead='.$cm->encodeData('edit').'&leadId='.$cm->encodeData($row['id']).'">
						<i class="fa fa-edit"></i>
						</a>
					':'').'
					'.(($cm->user_access("deleteLead",$_SESSION['sessionId']))?'
					'.(($row['status']=='new')? '
					<a  onclick="del_rec(\'\', \'del_lead\', \''.$row['id'].'\')" class="btn btn-app" style="cursor:pointer">
						<i class="fa fa-remove"></i>
					</a>' :"").'
					':'').'
					<a class="btn btn-app" href="lead_details?leadId='.$cm->encodeData($row['id']).'" target="_blank">
						<i class="fa fa-eye"></i>
					</a>
					'.(($cm->user_access("lead_his",$_SESSION['sessionId']))?'
					<a class="btn btn-app" href="lead_his_det?leadId='.$cm->encodeData($row['id']).'" target="_blank">
						<i class="fa fa-history"></i>
					</a>
					':'').'
					</td>
			  </tr>
			 ';
	}
	if(empty($leadId))
	{
		echo $cm->nothing_found($leadId, '10');
	}
	//if($total_rec>10)
	echo '<tr><td colspan="11">'.$cm->pagination($total_rec, $cur_page, $per_page, "get_allLeads").'</td></tr>';
}
?>
