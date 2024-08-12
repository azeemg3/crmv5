<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['membership_name']) && !empty($_POST['membership_name']))
{
	$data=$_POST;
	if($cm->u_value("airline_membership", "membership_name", "membership_name='".$_POST['membership_name']."'")!="")
	{
		echo $msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("airline_membership", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("airline_membership", "1 ORDER BY member_id DESC");
$count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['member_id'];
	$list.='
		<tr id="'.$row['member_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['membership_name'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\'../\',\'airline_member\', \''.$row['member_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
						</a></td>
		</tr>
	';
}
$list.=$cm->nothing_found($id, 5);
echo $msg,"~",$list;
?>