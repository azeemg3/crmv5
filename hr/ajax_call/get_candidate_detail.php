<?php
require_once'../../inc.functions.php';
require_once'../../session.php';
$cm=new crm();
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$query=$cm->selectData("candidates", "id=".$id." AND branch=".$user_branch."");
	$row=mysql_fetch_array($query);
	echo $row['candidate_name'],",".$row['mobile'],",".$row['education'],",".$row['experience'],",".$row['location'],",".$row['apply_date'].' '.$row['apply_time'],
	",".str_replace(",", "-",$row['skills']),",".$row['short_list_date'],",".$row['hire_date'], ",".$row['refrence'],",".$row['reject_reason'],",".$row['status'],","
	.$cm->u_value("jobs","job_title","id=".$row['job_id']." AND status='active' AND branch=".$user_branch."");
}
?>