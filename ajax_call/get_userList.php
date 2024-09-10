<?php
require_once'../inc.func.php';
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
$per_page=50;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$userList="";
$count=1;
$call_page="call_userlist";
if(isset($_POST['branch']) && !empty($_POST['branch']))
{
	$branch=$_POST['branch'];
	$query=$cm->selectData("user", "branch_id=".$branch." ORDER BY id DESC LIMIT $start, $per_page");
}
else
{
$query=$cm->selectData("user", "branch_id=".$_SESSION['branch_id']."");
}
$total_rec=$cm->count_val("user","id", "branch_id=".$_SESSION['branch_id']." ");
while($row=$query->fetch_assoc())
{
	$query_b=$cm->selectData("branches", "branch_id=".$row['branch_id']."");
	$branch=$query_b->fetch_assoc();
	$userList.='
				<tr id="'.$row['id'].'">
					<td>'.$count++.'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['account_name'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['status'].'</td>
					<td>'.$row['date_created'].'</td>
					<td>'.$branch['branch_name'].'</td>
					<td>
					'.(($cm->user_access("edit",$_SESSION['sessionId']))?'
						<a class="btn btn-default btn-sm" href="register?userid='.$row['id'].'">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					':'').'
					'.(($cm->user_access("delete",$_SESSION['sessionId']))?'
						<a class="btn btn-default btn-sm" onClick = del_rec(\'\',\'users\','.$row['id'].')>
						<span class="glyphicon glyphicon-remove"></span>
						</a>
						':'').'
					</td>
					
				</tr>
	';
}
$userList.='<tr><td colspan="10">'.$cm->pagination($total_rec,$cur_page,$per_page).'</td></tr>';
?>
<?php echo $userList; ?>		