<?php
require_once'../../inc.func.php';
$data="";
$count=1;
$result=$cm->selectMultiData("web_tour_cat.cat_name, web_tour_cat.thumb_det AS thumbDet, web_tour_cat.thumb_img, tour_pkg.pkg_name AS pkgName, web_tour_cat.thumb_img AS thumbImg, web_tour_cat.cat_id "
,"tour_pkg INNER JOIN web_tour_cat ON tour_pkg.pkg_id=web_tour_cat.pkg_id", "web_tour_cat.status='active'");
$total_rec=0;
while($row=$result->fetch_array())
{
	$total_rec=+$count;
	$data.='
		<tr id="'.$row['cat_id'].'">
		 <td>'.$count++.'</td>
		 <td>'.$row['cat_name'].'</td>
		 <td>'.$row['pkgName'].'</td>
		 <td>'.$row['thumbDet'].'</td>
		 <td><img src="'.$row['thumbImg'].'" width="50"></td>
		 <td></td>
		 <td>
		  <a href="edit_addNew-tour-category?cat_id='.$row['cat_id'].'" class="btn btn-app btn-default"> <i class="fa fa-edit"></i></a>
		  <a  onClick="del_rec(\'models/\',\'tour-cat-pkg\', \''.$row['cat_id'].'\')" class="btn btn-app btn-default"> <i class="fa fa-trash"></i></a>
		 </td>
		</tr>
	';
}
//$data.='<tr><td colspan="10">'.$cm->pagination($total_rec,'1', '10').'</td></tr>';
echo $data;
?>