<?php
require_once'../inc.func.php';
session_start();
$db=$cm->db();
$data=array(); $id="";
if(isset($_POST) && !empty($_POST['pkg_name']))
{
	$id=$_POST['pkg_id'];
	$data['pack_name']=$_POST['pkg_name'];
	if(!empty($_FILES['thumb_img']["name"]))
	{
		$data['thumb_image']="latest-tour-image-package/".$_FILES['thumb_img']["name"];
		move_uploaded_file($_FILES['thumb_img']["tmp_name"], "latest-tour-image-package/".$_FILES['thumb_img']["name"]);
	}
	if(!empty($_FILES['main_img']["name"]))
	{
		$data['main_img']="latest-tour-image-package/".$_FILES['main_img']["name"];
	move_uploaded_file($_FILES['main_img']["tmp_name"], "latest-tour-image-package/".$_FILES['main_img']["name"]);
	}
	$data['tourPrice']=$_POST['tourPrice'];
	$data['pkg_details']=mysqli_real_escape_string($db,$_POST['pkg_details']);
	$data['userId']=$_SESSION['sessionId'];
	$data['branch']=$_SESSION['branch_id'];
	$data['status']='pending';
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("lates_packages", $data, "date", "NOW()");
	}
	else
	{
		$query=$cm->update_array("lates_packages", $data, "id=".$id."");
	}
	if($query==1)
	{
		header("location:latestPkgList");
	}
	else
	{
		echo("Error description: " . mysqli_error($cm->db()));
	}
}
?>