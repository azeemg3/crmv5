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
$result=$cm->selectData("web_sliders", "1 LIMIT $start, $per_page");
$total_rec=$cm->count_val("web_sliders", "id", "1");
$data=""; $count=1; $id="";
while($row=$result->fetch_assoc()){
	$id=$row['id'];
	$data.='<tr id="'.$row['id'].'">
		<td>'.$count++.'</td>
		<td>'.$row['main_title'].'- '.$row['sub_title'].'</td>
		<td><img width="50" src="'.$row['slider_images'].'"></td>
		<td>'.(($row['slider_for']==1)?"Pakist-Tours":" Home Slider").'</td>
		<td>
			<a class="btn btn-default btn-sm" style="margin-left:5px;" onClick="web_slider('.$row['id'].')">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
			<a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'web_slider\', \''.$row['id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>';
}
$data.='<tr><td colspan="10">'.$cm->nothing_found($id, 10).'</td></tr>';
$data.='<tr><td colspan="10">'.$cm->pagination($total_rec,$cur_page, $per_page).'</td></tr>';
echo $data;
?>