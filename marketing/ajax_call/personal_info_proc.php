<?php
require_once'../../inc.func.php';
session_start();
$data=array();
$data=$_POST;
$cm->insertData("address_book", "pros_tech,other_det,userId,cur_date,branch_id", "'".$_GET['pros_tech']."', 
'".$_GET['pt_other_det']."', ".$_SESSION['sessionId'].", NOW(), ".$_SESSION['branch_id']."");
exit;


?>