<?php
require_once'../inc.func.php';
if(isset($_GET['status']) && !empty($_GET['status']))
{
	$status=$_GET['status'];
	$id=$_GET['id'];
	$cm->update("lates_packages", "status='$status'", "id=".$id."");
	echo "Package ".ucfirst($status)." Successfully";
}
else if(isset($_GET['del_rec']) && $_GET['del_rec']=='del')
{
	if(!empty($_GET['pkg'])){ $pkg=$_GET['pkg']; $id=$_GET['id']; }
	if($pkg=='get_latest_pkg')
	{
		$cm->delete("lates_packages", "id=".$id."");
	}
}
?>