<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectData("web_hotel_deal", "status='active'");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['deal_id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['deal_name'].'</td>
			 <td><img src="../hotel/images/hotel-deal/'.$row['thumb_img'].'" width="50"></td>
			 <td>'.$row['create_date'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="addNew_hotel_deal?id='.$row['deal_id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../../\', \'hotel-deal\', \''.$row['deal_id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>