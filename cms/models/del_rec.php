<?php
require_once'../../inc.func.php';
$id=$_GET['del_rec'];
if(isset($_GET['type']) && $_GET['type']=="tour-cat-pkg")
{
	$cm->update("web_tour_cat", "status='trash'", "cat_id=".$id."");
}
else if(isset($_GET['type']) && $_GET['type']=='tour-pkg')
{
	$cm->update("tour_pkg", "status='trash'", "pkg_id=".$id."");
}
?>