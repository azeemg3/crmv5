<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectData("web_umrah_cat", "1");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['cat_name'].'</td>
			 <td><img src="thumb_images/'.$row['thumb_img'].'" width="50"></td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="umrah_cat?id='.$row['id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'umrah-cat\', \''.$row['id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>