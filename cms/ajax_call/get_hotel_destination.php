<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
//$result=$cm->selectData("web_hotel_destination", "status='active'");
$result=$cm->selectMultiData("countries.country_name, web_hotel_destination.*", "web_hotel_destination INNER JOIN countries ON web_hotel_destination.country_id=countries.country_id", "web_hotel_destination.status='active'");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['destination_id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['destination_name'].'</td>
			 <td>'.$row['country_name'].'</td>
			 <td><img src="../hotel/images/hotel-destination/'.$row['thumb_img'].'" width="50"></td>
			 <td>'.$row['create_date'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="addNew_hotel_destination?id='.$row['destination_id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../../\', \'hotel-dest\', \''.$row['destination_id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>