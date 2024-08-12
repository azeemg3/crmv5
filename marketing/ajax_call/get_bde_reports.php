<?php
require_once'../../inc.func.php';
session_start();
$data="";$count=1; $id=""; $total_rec=0;
$whereArr=array();
$sWhere="";
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
if(isset($_POST))
{
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	if(!empty($branch)) $whereArr[]="address_book.branch_id=".$branch."";
	if(!empty($spo)) $whereArr[]="address_book.userId=".$spo."";
	$sWhere = implode(" AND ", $whereArr);
}
$result=$cm->selectMultiData("address_book.*, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "{$sWhere} GROUP BY address_book.userId");
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$total_rec=+$count;
	$data.='<tr>
				<td>'.$count++.'</td>
				<td>'.$cm->u_value("user", "name", "id=".$row['userId']."").'</td>
				<td>'.$cm->u_value("branches", "branch_name", "branch_id=".$row['branch_id']."").'</td>
				<td>'.$cm->count_val("ab_personal_info","personal_id", "userId=".$row['userId']."").'</td>
				<td>
					<a class="btn btn-app" href="bde_spo_reports?brnch='.$cm->encodeData($row['branch_id']).'&uid='.$cm->encodeData($row['userId']).'"><i class="fa fa-eye"></i></a>
				</td>
			</tr>
			
		';
}
$data.=$cm->nothing_found($id,10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo $data;
?>