<?php
require_once'../../inc.functions.php';
require_once'../../session.php';
$cm=new crm();
$list="";
$count=1;
$id="";
if(!empty($_POST))
{
	$whereArr=array();
	$frm_dt=$_POST['frm_dt'];
	$to_dt=$_POST['to_dt'];
	if($frm_dt && $to_dt != "") $whereArr[] = "date BETWEEN '$frm_dt' AND '$to_dt'";
	else $whereArr[]=" status='active' AND branch=".$user_branch."";
	$sWhere = implode(" AND ", $whereArr);
}
else
{
	$sWhere="status='active' AND branch=".$user_branch."";
}
$query=$cm->selectData("jobs", "{$sWhere}");
while($row=mysql_fetch_array($query))
{
	$id=$row['id'];
	$list.='
			<tr>
				<td>'.$count++.'</td>
				<td>'.$row['job_title'].'</td>
				<td>'.$row['date'] .' '.$row['time'].'</td>
				<td>'.$row['career_level'].'</td>
				<td>'.$row['status'].'</td>
				<td>
					<a class="btn btn-default btn-sm" 
					href=\'javascript:dlt_hr("save_job?dlt_rec='.$row['id'].'", "get_posted_jobs", "../hr/ajax_call/get_posted_jobs");\'>
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				</td>
			</tr>
		';
}
$cm->nothing_found($id, 10);
echo $list;
?>