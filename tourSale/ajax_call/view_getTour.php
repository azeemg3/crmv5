<?php
require_once'../../inc.func.php';
//$tour->visaSupp();
$db=$tour->db();
$uniqueId=$_GET['uniqueId'];
$file=$_GET['tour'];
if($file=='tourVisa')
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$q="DELETE tour_visa,trans FROM `tour_visa` INNER JOIN trans ON tour_visa.trans_code=trans.trans_code WHERE tour_visa.id=".$id."";
	$db->query($q);
	}
	echo $tour->get_view_tvisa($uniqueId);
	
}
else if($file=='tourHotel')
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$q="DELETE tour_hotel,trans FROM `tour_hotel` INNER JOIN trans ON tour_hotel.trans_code=trans.trans_code WHERE tour_hotel.id=".$id."";
	$db->query($q);
	}
	echo $tour->get_view_tour_hotel($uniqueId);
}
else if($file=='tourTrans')
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$q="DELETE tour_transport,trans FROM `tour_transport` INNER JOIN trans ON tour_transport.trans_code=trans.trans_code WHERE tour_transport.id=".$id."";
	$db->query($q);
	}
	echo $tour->get_view_tour_trans($uniqueId);
}
else if($file=="tourTour")
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$q="DELETE tour_tour,trans FROM `tour_tour` INNER JOIN trans ON tour_tour.trans_code=trans.trans_code WHERE tour_tour.id=".$id."";
	$db->query($q);
	}
	echo $tour->get_view_tour_tour($uniqueId);
}
else if($file=="tourOther")
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$q="DELETE tour_other,trans FROM `tour_other` INNER JOIN trans ON tour_other.trans_code=trans.trans_code WHERE tour_other.id=".$id."";
	$db->query($q);
	}
	echo $tour->get_view_tour_other($uniqueId);
}

?>