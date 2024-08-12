<?php
require_once'../../inc.func.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
	$id=$_GET['id'];
	$result=$cm->selectData("pak_tour_dest", "id=".$id."");
	$row=$result->fetch_assoc();
	echo json_encode($row);
}
?>