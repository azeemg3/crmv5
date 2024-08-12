<?php
require_once'../inc.func.php';
session_start();
$spo="";
if(!empty($_POST['dt_frm']) && !empty($_POST['dt_to']))
{
	$date_frm=$_POST['dt_frm'];
	$date_to=$_POST['dt_to'];
	$data=$account->search_reports("STR_TO_DATE(add_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND add_sale.branch=".$_SESSION['branch_id']." AND 
	add_sale.salesStaff=".$_SESSION['sessionId']."", 
	"STR_TO_DATE(other_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND other_sale.branch=".$_SESSION['branch_id']." AND other_sale.salesStaff=".$_SESSION['sessionId']."",
	 "STR_TO_DATE(ub_client_details.ub_issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND ub_client_details.branch=".$_SESSION['branch_id']." AND ub_client_details.salesStaff=".$_SESSION['sessionId']."", "STR_TO_DATE(issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND branch=".$_SESSION['branch_id']." AND spo=".$_SESSION['sessionId']."");
}
else
{
$data=$account->search_reports("add_sale.issue_date='".$cm->today()."' AND add_sale.branch='".$_SESSION['branch_id']."' AND add_sale.salesStaff=".$_SESSION['sessionId']."", "other_sale.issue_date='".$cm->today()."' AND other_sale.branch=".$_SESSION['branch_id']." AND other_sale.salesStaff=".$_SESSION['sessionId']."", "ub_client_details.ub_issue_date='".$cm->today()."' AND ub_client_details.branch=".$_SESSION['branch_id']." AND ub_client_details.salesStaff=".$_SESSION['sessionId']."", "issue_date='".$cm->today()."' AND branch=".$_SESSION['branch_id']." AND spo=".$_SESSION['sessionId']."");
}
echo $data;
?>