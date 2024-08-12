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
else{ 
$per_page=5000;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$whereArray=array();
$sWhere="";
if(!empty($_POST))
{
	if(!empty($_POST['spo'])) $whereArray[]="userId=".$_POST['spo']."";
	if(!empty($_POST['name'])) $whereArray[]="contact_name LIKE '%".$_POST['name']."%'";
	if(!empty($_POST['mobile'])) $whereArray[]="mobile= '".$_POST['mobile']."'";
	if(!empty($_POST['email'])) $whereArray[]="email= '".$_POST['email']."'";
	if(!empty($_POST['branch'])) $whereArray[]="branch_id= '".$_POST['branch']."'";
	if(!empty($_POST['lead_status'])) $whereArray[]="status= '".$_POST['lead_status']."'";
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere="branch_id=".$_SESSION['branch_id']."";
}
$result=$cm->selectData("lead", "{$sWhere}  LIMIT $start, $per_page");
$total_rec=$cm->count_val("lead","id", "{$sWhere}");
$data=""; $count=1; $id="";
while($row=$result->fetch_assoc())
{
	$id=$row['id'];
	$data.='
	
		<tr>
			<td>
			 '.$count++.'
			 <input type="checkbox" value="'.$row['email'].'" class="chkbox" mob="'.$row['mobile'].'">
			</td>
			<td>'.$cm->emptyWord($row['contact_name']).'</td>
			<td>'.$cm->emptyWord($row['mobile']).'</td>
			<td>'.$cm->emptyWord($row['email']).'</td>
			<td>'.$cm->u_value("user", "name","id=".$row['userId']."").'</td>
			<td>
			 <a class="btn btn-app" data-toggle="tooltip" data-placement="top" title="Sent Email"
			 onclick="uni_emails(\''.$row['email'].'\')"><i class="fa fa-envelope-o" aria-hidden="true"></i> </a>
			 <a class="btn btn-app" data-toggle="tooltip" data-placement="top" title="Send Message"
			 onclick="uni_sms('.$row['mobile'].')"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
			</td>
		</tr>
		';
}
$data.=$cm->nothing_found($id, 10);
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec, $cur_page, $per_page).'</td></tr>';
echo $data;
?>