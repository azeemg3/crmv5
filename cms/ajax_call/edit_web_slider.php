<?php
require_once'../../inc.func.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
	$id=$_GET['id'];
	$result=$cm->selectData("web_sliders", "id=".$id."");
	$row=$result->fetch_assoc();
	echo json_encode($row);
}
?>