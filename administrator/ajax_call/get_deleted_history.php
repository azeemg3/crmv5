<?php
require_once'../../inc.func.php';
$result=$cm->selectData("deleted_history", "1");
$data=""; $count=0; $id="";
while($row=$result->fetch_assoc())
{
	$id=$row['id'];
	$data.='
			<tr>
			 <td>'.$count++.'</td>
			 <td>'.$row['create_date'].'</td>
			 <td>'.$row['file_type'].'</td>
			 <td>'.$row['deleted_id'].'</td>
			 <td>'.$cm->u_value("user", "name","id=".$row['userId']."").'</td>
			 <td><a href="javascript::void(0)">N/A></a></td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 6);
echo $data;
?>