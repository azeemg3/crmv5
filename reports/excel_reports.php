<?php
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=yourFileName.xls");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
require_once'../inc.functions.php';
require_once'../session.php';
$c_m=new crm();
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

if(!empty($_POST))
{
	$whereArr=array();
	$frm_dt=$_POST['frm_dt'];
	$to_dt=$_POST['to_dt'];
	$leadId=$_POST['leadId'];
	$comp_name=$_POST['comp_name'];
	$mobile=$_POST['mobile'];
	$status=$_POST['status'];
	$spo=$_POST['spo'];
	$branch=$_POST['branch'];
	if($frm_dt && $to_dt != "") $whereArr[] = "STR_TO_DATE(lead.create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$frm_dt', '%d-%m-%Y') AND STR_TO_DATE('$to_dt', '%d-%m-%Y ') AND lead.branch_id=".$branch."";
	if($leadId !="") $whereArr[] = "lead.id=".$leadId." AND  lead.branch_id=".$branch."";
	if($comp_name !="") $whereArr[] = "lead.contact_name LIKE '%$comp_name%' AND lead.branch_id=".$branch."";
	if($mobile !="") $whereArr[] = "lead.mobile='$mobile' AND lead.branch_id=".$branch."";
	if($spo !="") $whereArr[] = "lead.users_Id=".$spo." AND lead.branch_id=".$branch."";
	if($status !="") $whereArr[] = "lead.status='$status' AND lead.branch_id=".$branch."";
	if($branch!="") $whereArr[] = "lead.branch_id=".$branch."";
	else $whereArr[]="lead.branch_id=".$user_branch."";
	$sWhere = implode(" AND ", $whereArr);
}
else
{
	$sWhere="1";
}
$query=$c_m->selectMultiData("user.name, lead.*", "lead INNER JOIN user ON lead.users_Id=user.id", "$sWhere");
$total_records=$c_m->selectMultiData("count(id) AS id ", "lead", "$sWhere");

while($row=mysql_fetch_array($total_records)){
		 $total_rec=$row["id"];
}
$count=1;
$id="";	
while($row=mysql_fetch_array($query))
{
	$id=$row['id'];
	echo'
	<table border="1" style="border-collapse:collapse" width="100%">
		<tr>
			<td>'.$count++.'</td>
			<td>'.$row['id'].'</td>
			<td>'.$row['contact_name'].'</td>
			<td>'.$row['mobile'].'</td>
			<td>'.$row['created_by'].'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['status'].'</td>
			<td>'.$row['create_date'].'</td>
		</tr>
	</table>';
}

?>