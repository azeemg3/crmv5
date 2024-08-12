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
$per_page=10;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$sWhere=""; $whereArray=array();
if(isset($_POST) && !empty($_POST['branch']))
{
	if(!empty($_POST['branch'])) $whereArray[]="lead.branch_id=".$_POST['branch']."";
	if(!empty($_POST['df']) && !empty($_POST['dt'])) $whereArray[]="STR_TO_DATE(lead.create_date, '%d-%m-%Y') 
	BETWEEN  STR_TO_DATE('".$_POST['df']."', '%d-%m-%Y') AND STR_TO_DATE('".$_POST['dt']."', '%d-%m-%Y ')";
	if(!empty($_POST['leadId'])) $whereArray[]="lead.id=".$_POST['leadId']."";
	if(!empty($_POST['contact_name'])) $whereArray[]="lead.contact_name like '%".$_POST['contact_name']."%'";
	if(!empty($_POST['mobile'])) $whereArray[]="lead.mobile='".$_POST['mobile']."'";
	if(!empty($_POST['status'])) $whereArray[]="lead.status='".$_POST['status']."'";
	if(!empty($_POST['spo'])) $whereArray[]="lead.spo='".$_POST['spo']."'";
	else $whereArray[]="lead.branch_id=".$_SESSION['branch_id']."";
}
$sWhere=implode(" AND ",$whereArray);
$array=array();$arrayofArray=array(); $secArray=array();
$result=$cm->selectMultiData("lead.*, user.name As userName, (select name from user where id=lead.created_by) AS createdBy,(select name from user where id=lead.spo) AS takenOverBy", "user INNER JOIN lead ON user.id=lead.userId","{$sWhere}
  ORDER BY lead.id DESC LIMIT $start, $per_page");
$total_rec=$cm->count_val("lead INNER JOIN user ON lead.userId=user.id","lead.id", "{$sWhere}");
while($row=$result->fetch_assoc())
{
	//$arrayofArray[]=$row;
	$arrayofArray[]=array("create_date"=>$row['create_date'], "id"=>$row['id'], "mobile"=>$row['mobile'],
	"contact_name"=>$row['contact_name'], "createdBy"=>$row['createdBy'], "takenOverBy"=>$row['takenOverBy'], 
	"status"=>$row['status'], "work_since"=>$cm->work_sicne($row['create_date']));
	$secArray['all_data']=$arrayofArray;
}
if($total_rec>0)
{
$secArray['page']=$total_rec;
$secArray['cp']=$cur_page;
$secArray['pp']=$per_page;
$secArray['clickFunc']='lead_rep';
}
$array[]=$secArray;
echo json_encode($array);
?>