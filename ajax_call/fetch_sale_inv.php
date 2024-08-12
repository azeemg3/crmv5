<?php
require_once'../inc.func.php';
session_start();
if(isset($_GET['inv_no']) && !empty($_GET['inv_no']))
{
	$psf=0;
	$inv=$_GET['inv_no'];
	$ticket=$cm->u_total("add_sale", "recieved","invoice_no='".$inv."' AND branch=".$_SESSION['branch_id']."");
	$otherSale=$cm->u_total("other_sale", "recieved","invoice_no='".$inv."' AND branch=".$_SESSION['branch_id']."");
	$tour_sale=$tour->sum_tour_invoice($inv);
	$rt=$cm->u_value("refund", "ref_type", "status='approved' AND invoice_number=".$inv." AND branch=".$_SESSION['branch_id']."");
	if($rt=='full')
	{
		$rec=$cm->u_total("add_sale", "recieved", "invoice_no='".$inv."' AND branch=".$_SESSION['branch_id']."");
		$nc=$cm->u_total("add_sale", "netCost", "invoice_no='".$inv."' AND branch=".$_SESSION['branch_id']."");
		$psf=$rec-$nc;
	}
	// total paid amount against this invoice number
	$paid_amount=$cm->u_total("sale_inv_aging", "amount", "status='approved' AND invoice_number=".$inv." AND branch_id=".$_SESSION['branch_id']."");
	$refund=$cm->u_total("refund", "net", "status='approved' AND invoice_number=".$inv." AND branch=".$_SESSION['branch_id']."")-
	$cm->u_total("refund", "services_charges", "status='approved' AND invoice_number=".$inv." AND branch=".$_SESSION['branch_id']."")+$psf;
	$total=$ticket+$otherSale+$tour_sale-$refund;
	echo $total-$paid_amount;
}
?>