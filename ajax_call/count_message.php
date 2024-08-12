<?php
require_once'../inc.func.php';
session_start();
$row=array();
echo $row['countLead']=$lead->count_lead_cons($_SESSION['sessionId']),"~",
$row['count_noti']=$cm->count_noti($_SESSION['sessionId']);
//echo json_encode($row);
?>