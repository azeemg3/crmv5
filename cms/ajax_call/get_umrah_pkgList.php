<?php 
require_once'../../inc.func.php';
$data=""; $count=1; $id=0;
$result=$cm->selectMultiData("web_umrah_pkg.pkg_id,web_umrah_pkg.status, web_umrah_cat.cat_name,web_umrah_cat.thumb_img, web_umrah_pkg.makkah_hotels, web_umrah_pkg.madina_hotels","web_umrah_pkg 
INNER JOIN web_umrah_cat ON web_umrah_pkg.cat_id=web_umrah_cat.id", "web_umrah_pkg.status='active'");
while($row=$result->fetch_assoc())
{
	$id=$row['pkg_id'];
	$data.='
			<tr id="'.$row['pkg_id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['cat_name'].'</td>
			 <td>'.$row['makkah_hotels'].'</td>
			 <td>'.$row['madina_hotels'].'</td>
			 <td><img src="thumb_images/'.$row['thumb_img'].'" width="50"></td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="addNewUmrah_pkg?pkg_id='.$row['pkg_id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'umrah-pkg\', \''.$row['pkg_id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
$data.='<tr><td colspan="10">'.$cm->nothing_found($id, 10).'</td></tr>';
echo $data;
?>