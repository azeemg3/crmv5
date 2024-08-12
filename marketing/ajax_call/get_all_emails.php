<?php
require_once'../../inc.func.php';
session_start();
if($cm->user_access("all-emails", $_SESSION['sessionId']))
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
$per_page=20;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$whereArray=array();
$sWhere="";
if(!empty($_POST))
{
	if(!empty($_POST['branch'])) $whereArray[]="address_book.branch_id=".$_POST['branch']."";
	if(!empty($_POST['name'])) $whereArray[]="ab_personal_info.name LIKE '%".$_POST['name']."%'";
	if(!empty($_POST['phone'])) $whereArray[]="ab_personal_info.mobile= '".$_POST['phone']."'";
	if(!empty($_POST['email'])) $whereArray[]="ab_personal_info.email= '".$_POST['email']."'";
	if(!empty($_POST['group_id'])) $whereArray[]="address_book.group_id= '".$_POST['group_id']."'";
	$whereArray[]="ab_personal_info.email!=''";
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere="address_book.userId=".$_SESSION['sessionId']."";
}
$result=$cm->selectMultiData("address_book.*, ab_personal_info.*, ab_bus_info.comp_name AS compName", 
"address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id
 INNER JOIN ab_bus_info ON address_book.address_id=ab_bus_info.address_id
","{$sWhere} ORDER BY address_book.address_id DESC LIMIT $start, $per_page ");
$total_rec=$cm->count_val("address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id
 INNER JOIN ab_bus_info ON address_book.address_id=ab_bus_info.address_id","address_book.address_id", "{$sWhere}");
$data=""; $count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$data.='<tr id="'.$row['address_id'].'">
			<td><input type="checkbox" value="'.$row['email'].'" class="chkbox"></td>
			<td><a href="address_book_det?address_id='.$row['address_id'].'">'.$cm->serial($count++).'</a></td>
			<td>'.$row['compName'].'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['email'].'</td>
			<td>'.$row['pros_tech'].'</td>
			<td>'.ucwords($row['gender']).'</td>
			<td>'.ucwords($cm->u_value("e_mark_groups", "group_name", "group_id=".$row['group_id']."")).'</td>
			<td>'.ucwords($row['area']).'</td>
		</tr>';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo $data;
}
?>