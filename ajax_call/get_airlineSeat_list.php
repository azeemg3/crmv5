<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['seat_name']) && !empty($_POST['seat_name']))
{
	$data=$_POST;
	if($cm->u_value("airline_seat", "seat_name", "seat_name='".$_POST['seat_name']."'")!="")
	{
		echo $msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("airline_seat", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("airline_seat", "1 ORDER BY seat_id DESC");
$count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['seat_id'];
	$list.='
		<tr id="'.$row['seat_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['seat_name'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\'../\',\'airlineSeat\', \''.$row['seat_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
						</a></td>
		</tr>
	';
}
$list.=$cm->nothing_found($id, 5);
echo $msg,"~",$list;
?>