<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectData("lates_packages", "1");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['pack_name'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>'.$row['date'].'</td>
			 <td>
			  <select class="form-control" name="" style="width:40%; float:left;" onchange="pkg_status(this.value, \'proc\', \''.$row['id'].'\')">
			   <option value="">--Select--</option>
			   <option value="active">Active</option>
			   <option value="inactive">InActive</option>
			  </select>
			  <a class="btn btn-default btn-sm" href="latest_tour_pkg?pkg_id='.$row['id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'latest_pkg\', \''.$row['id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>