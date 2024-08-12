<?php
require_once'../inc.func.php';
session_start();
if(isset($_GET['leadId']) && !empty($_GET['to']))
{
	$leadId=$_GET['leadId'];
	$to=$_GET['to'];
	$teamLeader=$cm->u_value("user", "team_leader", "id=".$_SESSION['sessionId']."");
	$cm->update("lead", "spo='$to'", "id=".$leadId."");
	//lead transfer detials
	$cm->insertData_multi("lead_transfer", "leadId, transfer_from, transfer_to, transfer_date, team_leader", "'".$leadId."', '".$_SESSION['sessionId']."', 
	'".$to."','".$cm->current_dt()."', '".$teamLeader."'");
	/*$cm->update("add_sale", "salesStaff='$to'", "leadId=".$leadId."");
	$cm->update("other_sale", "salesStaff='$to'", "leadId=".$leadId."");
	//ub
	$cm->update("ub_client_details", "salesStaff='$to'", "leadId=".$leadId."");
	$cm->update("ub_hotels_sale", "userId='$to'", "leadId=".$leadId."");
	$cm->update("ub_others", "userId='$to'", "leadId=".$leadId."");
	$cm->update("ub_transports", "userId='$to'", "leadId=".$leadId."");		
	$cm->update("ub_pkg", "userId='$to'", "leadId=".$leadId."");		
	//ub
	$cm->update("payment_reciept", "userId='$to'", "leadId=".$leadId."");
	$cm->update("refund", "userId='$to'", "leadId=".$leadId."");
	$cm->update("xo_sale", "salesStaff='$to'", "leadId=".$leadId."");
	$cm->update("refund_payment", "userId='$to'", "leadId=".$leadId.""); */	
}
?>