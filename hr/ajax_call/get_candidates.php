<?php
require_once'../../inc.functions.php';
require_once'../../session.php';
$cm=new crm();
$count=1;
$id="";
if(!empty($_POST))
{
	$whereArr=array();
	$frm_dt=$_POST['frm_dt'];
	$to_dt=$_POST['to_dt'];
	$mobile=$_POST['mobile'];
	$name=$_POST['name'];
	if($frm_dt && $to_dt != "") $whereArr[] = "apply_date BETWEEN '$frm_dt' AND '$to_dt'";
	if($mobile != "") $whereArr[] = "mobile='$mobile'";
	if($name != "") $whereArr[] = "candidate_name LIKE '%$name%'";
	else $whereArr[]="branch=".$user_branch."";
	$sWhere = implode(" AND ", $whereArr);
}
else
{
	$sWhere="branch=".$user_branch."";
}
$query=$cm->selectData("candidates", "{$sWhere} ORDER BY id DESC");
while($row=mysql_fetch_array($query))
{
	$id=$row['id'];
	echo '
		<tr>
			<td>'.$count++.'</td>
			<td>'.$row['candidate_name'].'</td>
			<td>'.$row['mobile'].'</td>
			<td>'.$row['education'].'</td>
			<td>'.$row['location'].'</td>
			<td>'.$row['refrence'].'</td>
			<td>'.$row['status'].'</td>
			<td>
				<a class="btn btn-default btn-sm" href=\'javascript:dlt_hr("save_candidate?dlt_rec='.$row['id'].'", "get_candidates", "../hr/ajax_call/get_candidates");\')">
						<span class="glyphicon glyphicon-remove"></span>
				</a>
			    <a class="btn btn-info btn-sm" onclick="candidate_detail('.$row['id'].')"><span class="glyphicon glyphicon-open"></span>Details</a>
			</td>
		</tr>
		';
}
$cm->nothing_found($id, 10);
?>