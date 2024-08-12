<?php
require_once'../inc.func.php';
$result=$cm->selectData("vendors", "1");
$data=""; $count=1; $id="";
while($row=$result->fetch_assoc())
{
	$id=$row['vendor_id'];
	$data.='
			<tr id="'.$row['vendor_id'].'">
				<td>'.$count++.'</td>
				<td>'.$row['vendor_name'].'</td>
				<td>'.$row['term_cond'].'</td>
				<td><a href="#" onclick="del_rec(\''.$row['vendor_id'].'\', \'saveVendor\')"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
		';
}
$data.=$cm->nothing_found($id, 4);
echo  $data;
?>