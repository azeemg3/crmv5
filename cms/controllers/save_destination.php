<?php
require_once'../../inc.func.php';
session_start();
$db=$cm->db(); 
if(isset($_POST))
{
	$id=$_POST['id'];
	$data['destination_type']=$_POST['destination_type'];
	$data['destination_name']=$_POST['destination_name'];
	$data['destination_country']=$_POST['destination_country'];
	$data['in_column']=$_POST['in_column'];
	$data['status']='active';
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$data['create_date']=$cm->current_dt();
	
	if(!empty($_FILES['destination_img']['name']))
	{
		$data['destination_img']='thumb_images/'.$_FILES['destination_img']['name'];
		move_uploaded_file($_FILES['destination_img']['tmp_name'], "../thumb_images/".$_FILES['destination_img']['name']."");
	}
	if($id=="" || $id==0)
	{
		$query=$cm->insert_array("web_destination", $data);
	}
	else
	{
		$query=$cm->update_array("web_destination", $data, "id=".$id."");
	}
		if($query==1){ $_SESSION['msg']=$query;}
			elseif( $query==1062) { $_SESSION['msg']=$query; }
			else { $_SESSION['msg']='2'; }
			header("location:../addNew_destination");
	
}
?>