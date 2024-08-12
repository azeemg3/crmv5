<?php
require_once'../../inc.func.php';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$row=array();
	$id=$_GET['id'];
	$result=$cm->selectData("other_sale", "id=".$id."");
	$row=$result->fetch_assoc();
}
echo json_encode($row);
?>