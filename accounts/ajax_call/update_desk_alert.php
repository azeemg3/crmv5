<?php
require_once'../../inc.func.php';
session_start();
if(isset($_GET['id']) && !empty($_GET['desk_alert']))
{
	$id=$_GET['id'];
	$desk_alert=$_GET['desk_alert'];
	$cm->update("payment_reciept", "desk_alert='yes'", "id=".$id."");
}
?>