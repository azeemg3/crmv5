<?php
require_once'../inc.func.php';
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
$per_page=10;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$result=$cm->selectData("trans_acc", "status='active' AND branch_id=".$_SESSION['branch_id']." ORDER BY trans_acc_id DESC LIMIT $start, $per_page");
$total_rec=$cm->count_val("trans_acc","trans_acc_id","status='active' AND branch_id=".$_SESSION['branch_id']."");
$data=""; $count=1; $id="";
while($row=$result->fetch_assoc())
{
	$id=$row['trans_acc_id'];
	$data.='
			<tr id="'.$row['trans_acc_id'].'">
				<td>'.$count++.'</td>
				<td>'.$row['create_date'].'</td>
				<td>'.$row['amount'].'/ '.$row['dr_cr'].'</td>
				<td>'.$row['trans_acc_type'].'</td>
				<td>'.$row['trans_acc_name'].'</td>
				<td>'.$row['status'].'</td>
				<td>
				<a class="btn btn-default btn-sm" onclick="update_trans_acc(\''.$row['trans_acc_id'].'\')">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
				<a href="#" class="btn btn-default btn-sm" onclick="del_rec(\'\', \'transacc\', \''.$row['trans_acc_id'].'\')">
					<span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo  $data;
?>