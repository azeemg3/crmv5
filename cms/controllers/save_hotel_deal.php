<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['deal_name']))
{
	$id=$_POST['id'];
	$data['deal_name']=$_POST['deal_name'];
	$data['country_id']=$_POST['country_id'];
	$data['deal_details']=$_POST['deal_details'];
	$data['start_price']=$_POST['start_price'];
	$data['create_date']=$cm->current_dt();
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['status']='active';
	if(!empty($_FILES['thumb_img']['name']))
	{
		$data['thumb_img']=$_FILES['thumb_img']['name'];
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], "../hotel/images/hotel-deal/".$_FILES['thumb_img']['name']."");
	}
	if(!empty($_FILES['main_img']['name']))
	{
		$data['main_img']=$_FILES['main_img']['name'];
		move_uploaded_file($_FILES['main_img']['tmp_name'], "../hotel/images/hotel-deal/".$_FILES['main_img']['name']."");
	}
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("web_hotel_deal", $data);
	}
	else
	{
		$query=$cm->update_array("web_hotel_deal", $data, "deal_id=".$id."");
	}
}
if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../hotel/addNew_hotel_deal");
?>