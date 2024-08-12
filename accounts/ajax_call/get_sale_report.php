<?php
require_once'../../inc.func.php';
session_start();
$spo="";
if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$_SESSION['branch_id'];}
if(!empty($_POST['frm_dt']) && !empty($_POST['to_dt']) && empty($_POST['spo']))
{
	$date_frm=$_POST['frm_dt'];
	$date_to=$_POST['to_dt'];
	if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$user_branch;}
	$data=$account->search_reports("STR_TO_DATE(add_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND add_sale.branch=".$branch."", 
	"STR_TO_DATE(other_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND other_sale.branch=".$branch."",
	 "STR_TO_DATE(ub_client_details.ub_issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND ub_client_details.branch=".$branch."", "STR_TO_DATE(issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND branch=".$branch."");
}
else if(!empty($_POST['spo']) && empty($_POST['frm_dt']) && empty($_POST['to_dt']))
{
	$spo=$_POST['spo'];
	$data= $account->search_reports("add_sale.salesStaff='$spo' AND add_sale.branch=".$branch."", "other_sale.salesStaff='$spo'
	 AND other_sale.branch=".$branch."", "ub_client_details.salesStaff='$spo'AND ub_client_details.branch=".$branch."", "spo=".$spo." AND branch=".$branch."");
}
else if(!empty($_POST['frm_dt']) && !empty($_POST['to_dt']) && !empty($_POST['spo']))
{
	$date_frm=$_POST['frm_dt'];
	$date_to=$_POST['to_dt'];
	$spo=$_POST['spo'];
	//if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$user_branch;}
	$data=$account->search_reports("STR_TO_DATE(add_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND add_sale.branch=".$branch." AND add_sale.salesStaff='$spo'", 
	"STR_TO_DATE(other_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND other_sale.branch=".$branch." AND other_sale.salesStaff='$spo'",
	 "STR_TO_DATE(ub_client_details.ub_issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND ub_client_details.branch=".$branch." AND ub_client_details.salesStaff='$spo'", "
	 STR_TO_DATE(issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND spo=".$spo." AND branch=".$branch."");
}

else if(empty($_POST['frm_dt']) && empty($_POST['to_dt']) && empty($_POST['spo']) && !empty($_POST['air_code']) && !empty($_POST['ticket_no']))
{
	$air_code=$_POST['air_code'];
	$ticket_no=$_POST['ticket_no'];
	//if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$user_branch;}
	$data=$account->search_reports("add_sale.airline_code='$air_code' AND add_sale.ticket_no='$ticket_no'  AND  add_sale.branch=".$branch."", 
	"0",
	 "0",0);
}
else if(empty($_POST['frm_dt']) && empty($_POST['to_dt']) && empty($_POST['spo']) && empty($_POST['air_code']) && empty($_POST['ticket_no']) && 
!empty($_POST['passport_num']))
{
	$pass_num=$_POST['passport_num'];
	$data=$account->search_reports("0", 
	"other_sale.passport_num='$pass_num'  AND  other_sale.branch=".$branch."",
	 "0",0);
}

else
{
	//if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$user_branch;}
$data=$account->search_reports("add_sale.issue_date='".$account->today()."' AND add_sale.branch='".$branch."'", "other_sale.issue_date='".$account->today()."' AND other_sale.branch='$branch'", "ub_client_details.ub_issue_date='".$account->today()."' AND ub_client_details.branch=".$branch."", "issue_date='".$account->today()."' AND branch=".$branch."");
}
echo $data,"~","","~".$account->acc_spo($spo, $branch)
?>