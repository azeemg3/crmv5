<?php
require_once('../../inc.func.php');
$data="";$count=1; $id=""; $total_rec=0;
$whereArray=array();
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
	$spo=$_POST['spo'];
	if(isset($_PSOT['branch'])){
	$branch=$_POST['branch'];}
	if(!empty($_POST['date_frm']) && !empty($_POST['date_to']))
	{
		$df=date('Y-m-d', strtotime( $_POST['date_frm'] ));
		$dt=date('Y-m-d', strtotime( $_POST['date_to'] ));
	}
	if(!empty($spo)) $whereArray[]="address_book.userId=".$spo."";
	if(!empty($branch)) $whereArray[]="address_book.branch_id=".$branch."";
	if(!empty($df) && !empty($dt)) $whereArray[]="STR_TO_DATE(address_book.cur_date, '%Y-%m-%d %H:%i:%s') BETWEEN  STR_TO_DATE('$df', '%Y-%m-%d') AND STR_TO_DATE('$dt', '%Y-%m-%d')";
	$sWhere=implode(" AND ", $whereArray);
}
$result=$cm->selectMultiData("address_book.cur_date AS add_date,address_book.pros_tech, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id ", "{$sWhere} ORDER BY address_book.address_id DESC LIMIT $start, $per_page");
$total_rec=$cm->count_val("address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id","address_book.address_id", "{$sWhere}");
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$data.='<tr>
				<td>'.$count++.'</td>
				<td>'.$row['add_date'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$cm->emptyWord($row['mobile']).'</td>
				<td>'.$cm->emptyWord($row['email']).'</td>
				<td>'.$cm->emptyWord($row['pros_tech']).'</td>
				<td>'.$cm->emptyWord(ucwords($row['gender'])).'</td>
				<td>'.$cm->emptyWord($cm->u_value("ab_bus_info", "bus_type", "address_id=".$row['address_id']."")).'</td>
				<td>'.$cm->emptyWord($row['area']).'</td>
				<td>
					<a class="btn btn-app" href="../address_book_det?address_id='.$row['address_id'].'"><i class="fa fa-eye"></i></a>
				</td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec,$cur_page, $per_page).'</td></tr>';
echo $data;
?>