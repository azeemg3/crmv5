<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['class_name']) && !empty($_POST['class_name']))
{
	$data=$_POST;
	if($cm->u_value("travel_class", "class_name", "class_name='".$_POST['class_name']."'")!="")
	{
		echo $msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("travel_class", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("travel_class", "1 ORDER BY class_id DESC");
$count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['class_id'];
	$list.='
		<tr id="'.$row['class_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['class_name'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\'../\',\'travel_class\', \''.$row['class_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
						</a></td>
		</tr>
	';
}
$list.=$cm->nothing_found($id, 5);
echo $msg,"~",$list;
?>