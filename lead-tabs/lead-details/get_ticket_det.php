<?php
require_once'../../inc.func.php';
if(isset($_GET['ac']) && !empty($_GET['ticket_no']))
{
	$array=array();
	$ac=$_GET['ac'];
	$ticket_no=$_GET['ticket_no'];
	$query=$cm->selectData("add_sale", "airline_code='".$ac."' && ticket_no='".$ticket_no."'");
	$array=$query->fetch_assoc();
	echo json_encode($array);
}
?>