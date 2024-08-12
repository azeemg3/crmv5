<?php
require_once'../../inc.func.php';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	echo $cm->u_value("bulk_email_text","email_text","id=".$id."");
}
?>