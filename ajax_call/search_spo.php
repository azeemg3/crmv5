<?php
require_once'../inc.func.php';
session_start();
if(isset($_GET['branch_id']) && !empty($_GET['branch_id']))
{
	$branch_id=$_GET['branch_id'];
	echo $cm->spo($_SESSION['sessionId'], $branch_id);
	
}
?>