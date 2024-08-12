<?php
require_once('app.func.php');
header('Access-Control-Allow-Origin: *');
$data=array();
$data=array("pending_lead"=>total_lead("status='pending'"), "total_lead"=>total_lead("branch_id=1 and status!='Trashed'"), "new_lead"=>total_lead("status='new' and branch_id=1 and status!='Trashed'"), "process_lead"=>total_lead("status='process' and branch_id=1 and status!='Trashed'"), "success_lead"=>total_lead("status='successfull' and branch_id=1 and status!='Trashed'"), "unsuc"=>total_lead("status='unsuccessfull' and branch_id=1 and status!='Trashed'"));
echo json_encode($data);
?>