<?php
require_once'../../inc.func.php';
session_start();
$db=$cm->db();
if(isset($_POST))
{
	$offer_id=$_POST['offer_id'];
	$data['offer_name']=$_POST['offer_name'];
	$data['url_link']=strtolower($_POST['hit-url']);
	$data['status']='active';
	$data['userId']=$_SESSION['sessionId'];
	$data['branch']=$_SESSION['branch_id'];
	$data['create_date']=$cm->current_dt();
	if(!empty($_FILES['thumb_img']['name']))
	{
		$data['thumb_img']="thumb_images/".preg_replace("/[^.a-zA-Z]+/", "-",$_FILES['thumb_img']['name']);
		move_uploaded_file($_FILES['thumb_img']["tmp_name"], "../thumb_images/".preg_replace("/[^.a-zA-Z]+/", "-",$_FILES['thumb_img']['name'])."");
	}
	if($offer_id=="" || $offer_id==0)
	{
		$query=$cm->insert_array("our_offers", $data);
	}
	else
	{
		$query=$cm->update_array("our_offers", $data, "offer_id=".$offer_id."");
	}
		if($query==1){ $_SESSION['msg']=$query;}
			elseif( $query==1062) { $_SESSION['msg']=$query; }
			else { $_SESSION['msg']='2'; }
			header("location:../addNew-our-offer");
	
}
?>