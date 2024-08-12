<?php
require_once'../../inc.func.php';
session_start();
$db=$cm->db();
if(isset($_POST['cat_id']) && !empty($_POST['cat_id']))
{
	$catId=$_POST['cat_id'];
	$data['cat_name']=mysqli_real_escape_string($db,$_POST['cat_name']);
	$data['pkg_id']=$_POST['pkg_id'];
	$data['status']='active';
	$data['thumb_det']=mysqli_real_escape_string($db,$_POST['thumb_det']);
	if(!empty($_FILES['thumb_img']['name']))
	{
		$data['thumb_img']='thumb_images/'.preg_replace("/[^.a-zA-Z]+/", "-",$_FILES['thumb_img']['name']);
		move_uploaded_file($_FILES['thumb_img']['tmp_name'], '../thumb_images/'.preg_replace("/[^.a-zA-Z]+/", "-",$_FILES['thumb_img']['name']));	
	}
	$data['file_link']=$_POST['file_link'];
	$data['url_link']=$_POST['url_link'];
	if(!empty($_FILES['header_img']['name']))
	{
		$data['header_img']='header_images/'.preg_replace("/[^.a-zA-Z]+/","-",$_FILES['header_img']['name']);
		move_uploaded_file($_FILES['header_img']['tmp_name'], '../header_images/'.preg_replace("/[^.a-zA-Z]+/","-",$_FILES['header_img']['name']));
	}
	$result=$cm->update_array("web_tour_cat", $data, "cat_id=".$catId."");
	$cm->delete("web_tour_cat_det", "cat_id=".$catId."");
	foreach($_SESSION['content_rec'] as $rec)
	{
		$thisData['heading_text']=mysqli_real_escape_string($db, $rec['content_heading']);
		$thisData['det_img']=$rec['content_img'];
		$thisData['text_det']=mysqli_real_escape_string($db,$rec['content_text']);
		$thisData['cat_id']=$catId;
		$cm->insert_array("web_tour_cat_det", $thisData);
	}
	if($result==1){ $_SESSION['msg']=$result;}
	elseif( $result==1062) { $_SESSION['msg']=$result; }
	else { $_SESSION['msg']='error'; }
	header("location:../addNew-tour-category");
	
}
?>