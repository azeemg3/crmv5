<?php
require_once'../../inc.func.php';
$result=$cm->selectData("tour_pkg", "status='active'");
$data=""; $count=1; $id="";
while($row=$result->fetch_assoc())
{
	if(!empty($row['pkg_name']))
	{
		$id=$row['pkg_id'];
	$data.='
		<tr id="'.$row['pkg_id'].'">
		 <td>'.$count++.'</td>
		 <td>'.$row['pkg_name'].'</td>
		 <td>'.$row['pkg_thumb_det'].'</td>
		 <td><img src="cms/../'.$row['pkg_thumb_img'].'" width="50"></td>
		 <td>'.$row['status'].'</td>
		 <td>
		  <a class="btn btn-default btn-sm" href="addNew-tour-packages?pkg_id='.$row['pkg_id'].'">
							<span class="glyphicon glyphicon-edit"></span>
		 </a>
		  <a class="btn btn-default btn-sm" href="javascript::void(0)"
		  onClick="del_rec(\'models/\',\'tour-pkg\', \''.$row['pkg_id'].'\')">
							<span class="glyphicon glyphicon-remove"></span>
		 </a>
		 </td>
		</tr>
		';
	}
}
$data.=$cm->nothing_found($id, 7);
echo $data;
?>