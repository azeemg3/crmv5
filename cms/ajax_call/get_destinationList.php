<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectData("web_destination", "status='active'");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['id'].'">
			 <td>'.$count++.'</td>
			 <td>'.(($row['destination_type']=='domestic_dest')?"Domestic":"International").'</td>
			 <td>'.$row['destination_name'].'</td>
			 <td><img src="'.$row['destination_img'].'" width="50"></td>
			 <td>'.$row['create_date'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="addNew_destination?id='.$row['id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'destination\', \''.$row['id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>