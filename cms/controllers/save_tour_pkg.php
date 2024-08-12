<?php
require_once'../../inc.func.php';
session_start();
$db=$cm->db();
if(isset($_POST))
{
	$id=$_POST['pkg_id'];
	$data['pkg_name']=$_POST['pkg_name'];
	$data['hit_url']=$_POST['hit-url'];
	$data['pkg_thumb_det']=mysqli_real_escape_string($db, $_POST['thumb_det']);
	$data['file_link']=$_POST['file_link'];
	$data['status']='active';
	if(!empty($_FILES['thumb_img']['name']))
	{
		$data['pkg_thumb_img']="thumb_images/".preg_replace("/[^.a-zA-Z]+/", "-",$_FILES['thumb_img']['name']);
		move_uploaded_file($_FILES['thumb_img']["tmp_name"], "../thumb_images/".preg_replace("/[^.a-zA-Z]+/", "-",$_FILES['thumb_img']['name'])."");
	}
	if(!empty($_FILES['header_img']['name']))
	{
		$data['pkg_header_img']="header_images/".$_FILES['header_img']['name'];
		move_uploaded_file($_FILES['header_img']["tmp_name"], "../header_images/".$_FILES['header_img']['name']."");
	}
	$data['pkg_det']=mysqli_real_escape_string($db,$_POST['pkg_details']);
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("tour_pkg", $data);
	}
	else
	{
		$query=$cm->update_array("tour_pkg", $data, "pkg_id=".$id."");
	}
		if($query==1){ $_SESSION['msg']=$query;}
			elseif( $query==1062) { $_SESSION['msg']=$query; }
			else { $_SESSION['msg']='error'; }
			header("location:../addNew-tour-packages");
	
}
?>