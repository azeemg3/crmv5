<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST['amount_in']) && !empty($_POST['amount_in']))
{
	$columns=array("`pay_type`, `details`, `amount`, `create_date`, branch, `userId`, bank_id");
	$values=array($_POST['payment_type'], $_POST['details'], $_POST['amount_in'], $cm->current_dt(), $_SESSION['branch_id'], 
	$_SESSION['sessionId'], $_POST['bank_id']);
	$account->insertData("paymentin", $columns, $values);
}
else if(isset($_POST['amount_out']) && !empty($_POST['amount_out']))
{
	$columns=array("`pay_type`, `detail`, `amount`, `pay_date`, branch, `userId`, bank_id");
	$values=array($_POST['payment_type'], $_POST['details'],$_POST['amount_out'], $account->current_dt(), $_SESSION['branch_id'],
	$_SESSION['sessionId'], $_POST['bank_id']);
	$account->insertData("paymentout", $columns, $values);
}
$amountIn="";$amountOut="";
$amountIn.=$account->payment_receipt($cm->selectData("payment_reciept", "branch=".$_SESSION['branch_id']." AND status='approved' 
AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$account->today()."', '%d-%m-%Y') AND 
STR_TO_DATE('".$account->today()."', '%d-%m-%Y ')"));
$amountIn.=$account->paymentIn($cm->selectData("paymentin", "branch=".$_SESSION['branch_id']." AND STR_TO_DATE(create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$account->today()."', '%d-%m-%Y') AND 
STR_TO_DATE('".$account->today()."', '%d-%m-%Y ') AND branch=".$_SESSION['branch_id'].""));
$amountOut.=$account->refundPayment($cm->selectData("refund_payment", "status='approved' AND STR_TO_DATE(create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$account->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$account->today()."', '%d-%m-%Y ') AND branch=".$_SESSION['branch_id'].""));
$amountOut.=$account->paymentOut($cm->selectData("paymentout", "STR_TO_DATE(pay_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$account->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$account->today()."', '%d-%m-%Y ') AND branch=".$_SESSION['branch_id'].""));
echo $amountIn,"~",$amountOut,"~".number_format($account->closing_balance($cm->today())),"~",
$account->dr_balance($account->totalAmountIn($cm->today())),"~",$account->cr_balance($account->totalAmountOut($cm->today())),"~",$account->day_closing_bal();
?>
