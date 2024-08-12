<?php
require_once'../inc.func.php';
if(isset($_GET['id']) &&  !empty($_GET['id']))
{
	$id=$_GET['id'];
	$query=$cm->selectData("msg_api", "id=".$id."");
	$row=$query->fetch_assoc();
	echo $id,",".$row['msg_mask'],",",$row['api_id'],",".$row['api_pswd'],",".$row['branch'];
}
else
{
$result=$cm->selectData("msg_api", "1");
$count=1;
while($row=$result->fetch_assoc())
{
	echo '
			<tr>
				<td>'.$count++.'</td>
				<td>'.$row['msg_mask'].'</td>
				<td>'.$row['api_id'].'</td>
				<td>'.$cm->u_value('branches', 'branch_name', 'branch_id='.$row['branch'].'').'</td>
				<td>'.$row['status'].'</td>
				<td>'.$row['cr_date'].'</td>
				<td>
					<a class="btn btn-default btn-xs" onClick="update_msg_api('.$row['id'].')">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
			</tr>
		';
}
}
?>