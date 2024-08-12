<?php
require_once'../../inc.func.php';
session_start();
$query="";
$db=$cm->db();
if(isset($_POST) && !empty($_POST['hotel_name']))
{
	$id=$_POST['id'];
	$data['hotel_name']=$_POST['hotel_name'];
	$data['destination_id']=$_POST['destination_id'];
	$data['status']='active';
	$data['create_date']=$cm->current_dt();
	$data['hotel_details']=mysqli_real_escape_string($db,$_POST['hotel_details']);
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['hotel_location']=$_POST['hotel_location'];
	$data['hotel_star']=$_POST['hotel_star'];
	$data['hotel_type']=$_POST['hotel_type'];
	if(!empty($_FILES['thumb_img']['name']))
	{
		$data['thumb_img']=$_FILES['thumb_img']['name'];
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], "../hotel/images/hotel-destination/".$_FILES['thumb_img']['name']."");
	}
	if(!empty($_FILES['main_img']['name']))
	{
		$data['main_img']=$_FILES['main_img']['name'];
		move_uploaded_file($_FILES['main_img']['tmp_name'], "../hotel/images/hotel-destination/".$_FILES['main_img']['name']."");
	}
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("web_hotels", $data);
	}
	else
	{
		$query=$cm->update_array("web_hotels", $data, "hotel_id=".$id."");
	}
}
if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../hotel/addNew_hotel");
?>