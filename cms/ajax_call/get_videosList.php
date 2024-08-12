<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectData("web_videos", "status='active'");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['video_heading'].'</td>
			 <td>'.$row['video_url'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="web_videos?id='.$row['id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'web-video\', \''.$row['id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>