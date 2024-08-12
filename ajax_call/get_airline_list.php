<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['airline_name']) && !empty($_POST['airline_name']))
{
	$data=$_POST;
	if($cm->u_value("airline_list", "airline_name", "airline_name='".$_POST['airline_name']."'")!="")
	{
		echo $msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("airline_list", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("airline_list", "1 ORDER BY airline_id DESC");
$count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['airline_id'];
	$list.='
		<tr id="'.$row['airline_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['airline_name'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\'../\',\'airlinelist\', \''.$row['airline_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
						</a></td>
		</tr>
	';
}
$list.=$cm->nothing_found($id, 5);
echo $msg,"~",$list;
?>