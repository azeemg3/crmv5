<?php
require_once'../inc.func.php';
$saleTour=new tourSale();
$file=$_GET['thistour'];
if($file=='visaTour')
{
	$id=$_GET['id'];
	$array=array();
	$query=$saleTour->selectData('tour_visa', "id=".$id."");
	$row=$query->fetch_assoc();
	echo json_encode($row);
}
else if($file=='tourHotel')
{
	$id=$_GET['id'];
	$query=$saleTour->selectData("tour_hotel", "id=".$id."");
	$row=$query->fetch_assoc();
	echo json_encode($row);
}
else if($file=='tourTrans')
{
	$id=$_GET['id'];
	$query=$saleTour->selectData("tour_transport", "id=".$id."");
	$row=$query->fetch_assoc();
	echo json_encode($row);
}
else if($file=='tourTour')
{
	$id=$_GET['id'];
	$query=$saleTour->selectData("tour_tour", "id=".$id."");
	$row=$query->fetch_assoc();
	echo json_encode($row);
}
else if($file=='tourOther')
{
	$id=$_GET['id'];
	$query=$saleTour->selectData('tour_other', "id=".$id."");
	$row=$query->fetch_assoc();
	echo json_encode($row);
}
?>