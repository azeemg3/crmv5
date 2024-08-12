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
if(isset($_POST['per_page']) && !empty($_POST['per_page']))
{
	$per_page=$_POST['per_page'];
}
else
{ 
	$per_page=2000;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$whereArray=array();
$sWhere="";
if(!empty($_POST))
{
	if(!empty($_POST['branch'])) $whereArray[]="address_book.branch_id=".$_POST['branch'].""; 
	if(!empty($_POST['spo'])) $whereArray[]="address_book.userId=".$_POST['spo']."";
	if(!empty($_POST['name'])) $whereArray[]="ab_personal_info.name LIKE '%".$_POST['name']."%'";
	if(!empty($_POST['phone'])) $whereArray[]="ab_personal_info.mobile= '".$_POST['phone']."'";
	if(!empty($_POST['email'])) $whereArray[]="ab_personal_info.email= '".$_POST['email']."'";
	if(!empty($_POST['area'])) $whereArray[]="ab_personal_info.area LIKE '".$_POST['area']."%'";
	if(!empty($_POST['group_id'])) $whereArray[]="address_book.group_id ='".$_POST['group_id']."%'";
	$whereArray[]="ab_personal_info.mobile!=0";
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere="address_book.userId=".$_SESSION['sessionId']." AND ab_personal_info.mobile!=0";
}
$result=$cm->selectMultiData("address_book.address_id, ab_personal_info.name, ab_personal_info.mobile,ab_personal_info.gender, ab_personal_info.area ", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id","{$sWhere} ORDER BY address_book.address_id DESC LIMIT $start, $per_page");
$total_rec=$cm->count_val("address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id","address_book.address_id", "{$sWhere} ");
$data=""; $count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$data.='<tr id="'.$row['address_id'].'">
			<td><input type="checkbox" mob="'.$row['mobile'].'" class="chkbox"></td>
			<td>'.$cm->serial($count++).'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['mobile'].'</td>
			<td>'.ucwords($row['gender']).'</td>
			<td>'.ucwords($row['area']).'</td>
			<td>
				<a class="btn btn-default btn-sm" href="add_contact?address_id='.$row['address_id'].'">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a class="btn btn-default btn-sm" val="'.$row['mobile'].'" onClick="uni_sms('.$row['mobile'].')">
						<span class="glyphicon glyphicon-envelope"></span>
					</a>
					<a class="btn btn-default btn-sm" onClick = del_rec(\'\',\'address_book\','.$row['address_id'].')>
						<span class="glyphicon glyphicon-remove"></span>
					</a>
			</td>
		</tr>';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo $data;
?>