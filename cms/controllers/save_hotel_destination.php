<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST) && !empty($_POST['destination_name']))
{
	$id=$_POST['destination_id'];
	$data['destination_name']=$_POST['destination_name'];
	$data['country_id']=$_POST['country_id'];
	if(!empty($_FILES['thumb_img']['name']))
	{	
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], "../hotel/images/hotel-destination/".$_FILES['thumb_img']['name']."");
		$data['thumb_img']=$_FILES['thumb_img']['name'];
	}
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['status']='active';
	$data['create_date']=$cm->current_dt();
	
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("web_hotel_destination", $data);
	}
	else
	{
		$query=$cm->update_array("web_hotel_destination", $data, "destination_id=".$id."");
	}
}
if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../hotel/addNew_hotel_destination");
?>