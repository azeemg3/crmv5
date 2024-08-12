<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectMultiData("web_hotels.*, web_hotel_destination.destination_name, countries.country_name", "web_hotels INNER JOIN web_hotel_destination ON 
web_hotels.destination_id=web_hotel_destination.destination_id
INNER JOIN countries ON web_hotel_destination.country_id=countries.country_id
", "1");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['hotel_id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['hotel_name'].'</td>
			 <td>'.$row['country_name'].'</td>
			 <td><img src="../hotel/images/hotel-destination/'.$row['thumb_img'].'" width="50"></td>
			 <td>'.$row['status'].'</td>
			 <td>'.$row['create_date'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="addNew_hotel?id='.$row['hotel_id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../../\', \'hotel\', \''.$row['hotel_id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>