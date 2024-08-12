<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST['video_heading']) && !empty($_POST['video_url']))
{
	$id=$_POST['id'];
	$data['video_heading']=$_POST['video_heading'];
	$data['video_url']=$_POST['video_url'];
	$data['status']='active';
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['create_date']=$cm->current_dt();
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("web_videos", $data);
	}
	else
	{
		$query=$cm->update_array("web_videos", $data, "id=".$id."");
	}
	if($query==1){ $_SESSION['msg']=$query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../web_videos");
}

?>