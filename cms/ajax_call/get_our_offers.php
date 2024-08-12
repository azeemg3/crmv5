<?php 
require_once'../../inc.func.php';
$data=""; $count=1;
$result=$cm->selectData("our_offers", "status='active'");
while($row=$result->fetch_assoc())
{
	$data.='
			<tr id="'.$row['offer_id'].'">
			 <td>'.$count++.'</td>
			 <td>'.$row['offer_name'].'</td>
			 <td><img src="'.$row['thumb_img'].'" width="50"></td>
			 <td>'.$row['create_date'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>
			  <a class="btn btn-default btn-sm" href="addNew-our-offer?offer_id='.$row['offer_id'].'" style="margin-left:5px;">
				<span class="glyphicon glyphicon-edit"></span>
			  </a>
			   <a class="btn btn-default btn-sm" onclick="del_rec(\'../\', \'our-offer\', \''.$row['offer_id'].'\')">
				<span class="glyphicon glyphicon-trash"></span>
			  </a>
			 </td>
			</tr>
		';
}
echo $data;
?>