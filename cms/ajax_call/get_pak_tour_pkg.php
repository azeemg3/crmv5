<?php
require_once'../../inc.func.php';
$result=$cm->selectMultiData("pak_tour_pkgs.id AS pkgId, pkg_name, pak_tour_pkgs.thumb_img, pak_tour_pkgs.create_date, pak_tour_pkgs.status, dest_name", "pak_tour_pkgs INNER JOIN pak_tour_dest ON pak_tour_pkgs.destination=pak_tour_dest.id", "pak_tour_pkgs.status='active' ORDER BY pak_tour_pkgs.sorting_by ASC");
$data="";
while($row=$result->fetch_assoc())
{
	$data.='<tr id="'.$row['pkgId'].'">
		<td></td>
		<td>'.$row['pkg_name'].'</td>
		<td>'.$row['dest_name'].'</td>
		<td>'.((!empty($row['thumb_img']))?'<img src="thumb_images/'.$row['thumb_img'].'" width="50">':"").'</td>
		<td>'.$row['create_date'].'</td>
		<td>'.$row['status'].'</td>
		<td>
			<a class="btn btn-default btn-sm" style="margin-left:5px;" href="add_new_pk_pkg?id='.$row['pkgId'].'">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
			<a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'pak_tour-pkg\', \''.$row['pkgId'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>';
}
echo $data;
?>