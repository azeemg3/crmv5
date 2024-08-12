<?php
require_once'../../inc.func.php';
if(isset($_GET) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("e_mark_groups","group_id=".$id."");
	$row=$result->fetch_assoc();
}
echo json_encode($row);
?>