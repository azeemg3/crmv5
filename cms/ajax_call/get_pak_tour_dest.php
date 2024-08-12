<?php
require_once'../../inc.func.php';
if(isset($_GET['page'])){
	$page=$_GET['page'];
}
else{
	$page=1;
}
if(isset($_POST['per_page']) && !empty($_POST['per_page'])){
	$per_page=$_POST['per_page'];
}
else{ 
	$per_page=10;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$result=$cm->selectData("pak_tour_dest", "status='active' ORDER BY sorting_by ASC LIMIT $start, $per_page");
$total_rec=0;
$total_rec=$cm->count_val("pak_tour_dest", "id", "status='active'");
$data=""; $count=$start+1;
while($row=$result->fetch_assoc()){
	$data.='<tr id="'.$row['id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['dest_name'].'</td>
			<td><img src="'.$row['thumb_img'].'" width="50"></td>
			<td>'.$row['create_date'].'</td>
			<td>'.$row['status'].'</td>
			<td>
			<a class="btn btn-default btn-sm" style="margin-left:5px;" onClick="edit_pak_tour_dest('.$row['id'].')">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
			<a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'pk_tour_dest\', \''.$row['id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>';
}
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec,$cur_page, $per_page).'</td></tr>';
echo $data;
?>