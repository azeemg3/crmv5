<?php
require_once'../../inc.func.php';
session_start();
$data=""; $count=1; $id=""; $msg="";$are="";
if(isset($_POST) && !empty($_POST['group_name']))
{
	$array['group_name']=$_POST['group_name'];
	$array['branch_id']=$_SESSION['branch_id'];
	//all ready exit value
	$are=$cm->u_value("e_mark_groups","group_name", "group_name='".$_POST['group_name']."'");
	if(!empty($_POST['group_id']))
	{
		$cm->update("e_mark_groups","group_name='".$_POST['group_name']."'","group_id=".$_POST['group_id']."");
		
	}
	else if(empty($are))
	{
		$query=$cm->insert_array("e_mark_groups", $array);
		if($query==1){}
		else { echo $msg=2; exit();}
	}
	else
	{
		echo $msg=3;
		exit();
	}
	
}
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
$result=$cm->selectData("e_mark_groups","branch_id=".$_SESSION['branch_id']." LIMIT $start, $per_page");
$total_rec=$cm->count_val("e_mark_groups","group_id", "branch_id=".$_SESSION['branch_id']."");
while ($row=$result->fetch_assoc())
 {
 	$id=$row['group_id'];
	$data.='
			<tr id="'.$row['group_id'].'">
				<td>'.$count++.'</td>
				<td>'.$row['group_name'].'</td>
				<td width="10%"><a class="btn btn-default btn-sm" href="javascript::void(0)" 
				onclick="edit_e_mar_group('.$row['group_id'].')">
					<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a class="btn btn-default btn-sm" onclick="del_rec(\'../\',\'e-group\',\''.$row['group_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				</td>
			</tr>
	';
 }
 $data.=$cm->nothing_found($id,3);
 $data.='<tr><td colspan="3">'.$cm->pagination($total_rec,$cur_page,$per_page).'</td></tr>';
 echo $data;
?>