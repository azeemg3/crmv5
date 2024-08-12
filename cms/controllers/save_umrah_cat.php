<?php
require_once'../../inc.func.php';
session_start();
$db=$cm->db();
if(isset($_POST['cat_name']) && !empty($_POST['cat_name']) && isset($_FILES['thumb_img']['name']))
{
	$id=$_POST['id'];
	$data['cat_name']=$_POST['cat_name'];
	$data['status']='active';
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	if(!empty($_FILES['thumb_img']['name']))
	{
		$data['thumb_img']=$_FILES['thumb_img']['name'];
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], "../thumb_images/".$_FILES['thumb_img']['name']."");
	}
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("web_umrah_cat", $data);
	}
	else
	{
		$query=$cm->update_array("web_umrah_cat", $data, "id=".$id."");
	}
	if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../umrah_cat");
}

?>