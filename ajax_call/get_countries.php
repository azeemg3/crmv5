<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['country_name']) && !empty($_POST['country_name']))
{
	$data=$_POST;
	if($cm->u_value("countries", "country_name", "country_name='".$_POST['country_name']."'")!="")
	{
		$msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("countries", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("countries", "1 ORDER BY country_id DESC");
$count=1;
while($row=$result->fetch_assoc())
{
	$list.='
		<tr id="'.$row['country_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['country_name'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\'country\', \''.$row['country_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
						</a></td>
		</tr>
	';
}
echo $msg,"~",$list;
?>