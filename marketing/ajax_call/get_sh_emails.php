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
$per_page=20;

$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$result=$cm->selectData("bulk_email_text", "branch=".$_SESSION['branch_id']." ORDER BY id DESC LIMIT $start,$per_page");
$total_rec=$cm->count_val("bulk_email_text","id","branch=".$_SESSION['branch_id']."");
$data=""; $count=1;
while($row=$result->fetch_assoc())
{
	$data.='<tr>
		<td>'.$count++.'</td>
		<td>'.$row['subject'].'</td>
		<td></td>
		<td>'.$row['status'].'</td>
		<td>'.$cm->u_value("user","name", "id=".$row['userId']."").'</td>
		<td>'.$cm->u_value("branches","branch_name", "branch_id=".$row['branch']."").'</td>
		<td><a href="javascript::void(0)" onclick="bulk_email_view('.$row['id'].')"><i class="fa fa-eye"></i></a></td>
	</tr>';
}
if($total_rec>20){
$data.='<tr><td colspan="6">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td>></tr>';}
echo $data;
?>