<?php
require_once'../../inc.func.php';
//$cm->visaSupp();
$uniqueId=$_GET['uniqueId'];
$file=$_GET['tour'];
if($file=='tourVisa')
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$tc=$cm->u_value("tour_visa","trans_code","id=".$id."");
	$cm->delete("trans", "trans_code=".$tc."");
	$cm->delete("tour_visa", "id=".$id."");
	}
	echo $tour->get_tvisa($uniqueId);
	
}
else if($file=='tourHotel')
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$tc=$cm->u_value("tour_hotel","trans_code","id=".$id."");
	$cm->delete("trans", "trans_code=".$tc."");
	$cm->delete("tour_hotel", "id=".$id."");}
	echo $tour->get_tour_hotel($uniqueId);
}
else if($file=='tourTrans')
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$tc=$cm->u_value("tour_transport","trans_code","id=".$id."");
	$cm->delete("trans", "trans_code=".$tc."");
	$cm->delete("tour_transport", "id=".$id."");}
	echo $tour->get_tour_trans($uniqueId);
}
else if($file=="tourTour")
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$tc=$cm->u_value("tour_tour","trans_code","id=".$id."");
	$cm->delete("trans", "trans_code=".$tc."");
	$cm->delete("tour_tour", "id=".$id."");}
	echo $tour->get_tour_tour($uniqueId);
}
else if($file=="tourOther")
{
	if(!empty($_GET['id'])){
	$id=$_GET['id'];
	$tc=$cm->u_value("tour_other","trans_code","id=".$id."");
	$cm->delete("trans", "trans_code=".$tc."");
	$cm->delete("tour_other", "id=".$id."");}
	echo $tour->get_tour_other($uniqueId);
}

?>