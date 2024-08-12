<?php
require_once'../../inc.func.php';
session_start();
$db=$cm->db(); 
if(isset($_POST) && !empty($_POST['dest_name']))
{
	$id=$_POST['id'];
	$data['dest_name']=$_POST['dest_name'];
	if(!empty($_FILES['thumb_img']['name'])){
		$data['thumb_img']='thumb_images/pak-tours/'.$db->real_escape_string(time().'-'.$_FILES['thumb_img']['name']);
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], "../thumb_images/pak-tours/".$db->real_escape_string(time().'-'.$_FILES['thumb_img']['name'])."");
	}
	if(!empty($_FILES['cover_img']['name'])){
		$data['cover_img']='cover-images/'.$db->real_escape_string(time().'-'.$_FILES['cover_img']['name']);
		move_uploaded_file($_FILES['cover_img']['tmp_name'], "../cover-images/".$db->real_escape_string(time().'-'.$_FILES['cover_img']['name'])."");
	}
	$data['status']='active';
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['create_date']=$cm->current_dt();
	$data['url_link']=strtolower($_POST['url_link']);
	$data['sorting_by']=$_POST['sorting_by'];
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("pak_tour_dest", $data);
	}
	else
	{
		$query=$cm->update_array("pak_tour_dest", $data, "id=".$id."");
	}
	
}
if($query==1){ $_SESSION['msg']=$query;}
			elseif( $query==1062) { $_SESSION['msg']=$query; }
			else { $_SESSION['msg']='2'; }
			header("location:../pak_tour_destinations");
?>