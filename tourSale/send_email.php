<?php
require_once'../inc.functions.php';
require_once'../session.php';
$tourSale=new tourSale();
if(isset($_GET['tour']) && $_GET['tour']=='tour_email_det')
{
	$uniqueId=$_GET['uniqueId'];
	$subject=$_POST['subject'];
	$email=$_POST['email'];
	$descr=$_POST['description'];
	$tourSale->tour_inv_email($subject, $email, $descr, $tourSale->tour_det_inv($uniqueId));
	echo "Email Sent Successfully";
}
else if(isset($_GET['tour']) && $_GET['tour']=='tour_email_summery')
{
	$uniqueId=$_GET['uniqueId'];
	$subject=$_POST['subject'];
	$email=$_POST['email'];
	$descr=$_POST['description'];
	$tourSale->tour_inv_email($subject, $email, $descr, $tourSale->tour_summery_inv($uniqueId));
	echo "Email Sent Successfully";
}
?>