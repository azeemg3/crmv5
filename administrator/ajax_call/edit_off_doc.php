<?php
require_once'../../inc.func.php';
if(isset($_GET) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("office_doc_alerts","id=".$id."");
	$row=$result->fetch_assoc();
}
echo json_encode($row);
?>