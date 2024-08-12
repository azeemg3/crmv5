<?php
require_once'../../inc.func.php';
session_start();
$data=array();
if(isset($_POST) && !empty($_POST['pkg_name']) && !empty($_POST['pkg_details'])){
	$id=$_POST['id'];
	$data['pkg_name']=$_POST['pkg_name'];
	$data['destination']=$_POST['destination'];
	$data['tour_price']=$_POST['tour_price'];
	$data['min_pax']=$_POST['min_pax'];
	$data['duration']=$_POST['duration'];
	$data['discount']=$_POST['discount'];
	$data['url_link']=$_POST['url_link'];
	$data['sorting_by']=$_POST['sorting_by'];
	if(!empty($_FILES['thumb_img']['name'])){
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], "../thumb_images/".$_FILES['thumb_img']['name']);
		$data['thumb_img']=$_FILES['thumb_img']['name'];
	}
	if(!empty($_FILES['cover_img']['name'])){
		move_uploaded_file($_FILES['cover_img']['tmp_name'], "../cover-images/".$_FILES['cover_img']['name']);
		$data['cover_img']=$_FILES['cover_img']['name'];
	}
	$files=""; $i=0;
	foreach($_FILES['pkg_images']['name'] as $val)
	{
		if(!empty($_FILES['pkg_images']['name'][$i])){
		$files.=time().'-'.$val."}";
		move_uploaded_file($_FILES['pkg_images']['tmp_name'][$i], "../pak-tour-pkg-images/".time().'-'.$_FILES['pkg_images']['name'][$i]."");
		}
		$i++;
	}
	if(!empty($_FILES['pkg_images']['name'][0])){
	$files=rtrim($files, "}");
	$data['pkg_images']=$files;
	}
	$data['pkg_details']=$_POST['pkg_details'];
	$data['create_date']=crm::current_dt();
	$data['status']='active';
	if($id==0 || $id==""){
		$query=$cm->insert_array("pak_tour_pkgs", $data);
	}
	else{
		$query=$cm->update_array("pak_tour_pkgs", $data, "id=".$id."");
	}
	
}
	if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../add_new_pk_pkg");
?>