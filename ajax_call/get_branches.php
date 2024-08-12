<?php 
require_once'../inc.func.php';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$query=$cm->selectData("branches", "branch_id=".$id."");
	$row=$query->fetch_assoc();
	echo $id."=".$row['branch_name']."=".$row['branch_location']."=".$row['branch_logo']."=".$row['address']."=".$row['sign_logo'].
	"=".$row['branch_email']."=".$row['phone_line']."=".$row['mobile']."=".$row['web']."=".$row['email_header']."=".$row['msg_mask'];
	exit;
}
else if(isset($_GET['dlt_rec']) && !empty($_GET['dlt_rec']))
{
	$dlt_id=$_GET['dlt_rec'];
	$cm->update("branches", "status='inactive'", "branch_id=".$dlt_id."");
}
else
{
$query=$cm->selectData("branches", "status='active'");
$count=1;
	while($row=$query->fetch_assoc())
	{
		echo"
			<tr>
				<td>".$count++."</td>
				<td>".$row['branch_name']."</td>
				<td>".$cm->u_value("user", "name", "id=".$row['user_id']."")."</td>
				<td>".$row['branch_location']."</td>
				<td>
				".((!empty($row['branch_logo']))?'<img width="50" height="50" src="branch_logo/'.$row['branch_logo'].'">':"")."
				".((empty($row['branch_logo']))?'<img width="50" height="50" src="branch_logo/blank.jpg">':"")."
				</td>
				<td>".$row['status']."</td>
				<td>".$row['branch_location']."</td>
				<td>
				<button type='button' class='btn btn-default btn-sm' 
				onclick=\"edit_branch('get_branches', 'myModal', 'form', '".$row['branch_id']."')\">
				<span class='glyphicon glyphicon-edit'></span></button>
				<button type='butto' class='btn btn-default btn-sm' onclick=\"del_bra('".$row['branch_id']."', 'ajax_call/get_branche', 'get_branche')\">
				<span class='glyphicon glyphicon-remove'></span></button>
				</td>
			</tr>
		";
	}
}
?>