<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST['refrence']) && !empty($_POST['refrence']))
{
	$val=""; $amount=0;
	$amount=array_sum($_POST['amount']);
	$tp_rv=$_POST['tp_rv'];
	$ref=$_POST['refrence'];
	$recRef=$cm->u_value("payment_reciept","refrence", "TPRV=".$tp_rv."");
	$recRefArray=explode(",", $recRef);
	$finalArray=array_merge($ref,$recRefArray);
	$refrence=implode(",", array_unique($finalArray));
	$countRefNo=count($_POST['refrence']);
	$rec_amount=$_POST['rec_amount'];
	$rec_id=$cm->u_value("payment_reciept","id", "TPRV=".$tp_rv."");
	if($amount<=$rec_amount)
	{
		for($i=0; $i<$countRefNo; $i++)
		{
				if(!empty($_POST['refrence'][$i]))
				{
					if(!empty($_POST['amount'][$i])){
				$cm->insertData_multi("sale_inv_aging", "invoice_number, amount, status, userId, branch_id, rec_id", "'".$_POST['refrence'][$i]."', 
				'".$_POST['amount'][$i]."','approved','".$_SESSION['sessionId']."', '".$_SESSION['branch_id']."', '".$rec_id."'");
					}
				// update to done against sale invoices
					$ticket=$cm->u_total("add_sale", "recieved", "invoice_no=".$_POST['refrence'][$i]."");
					$otherSale=$cm->u_total("other_sale", "recieved", "invoice_no=".$_POST['refrence'][$i]."");
					$tour=$tour->sum_tour_invoice($_POST['refrence'][$i]);
					$refund=$cm->u_total("refund", "net", "invoice_number=".$_POST['refrence'][$i]." 
					AND status='approved'");
					$ser_char=$cm->u_total("refund", "services_charges", "invoice_number=".$_POST['refrence'][$i]." 
					AND status='approved'");
					$rt=$cm->u_value("refund", "ref_type", "invoice_number=".$_POST['refrence'][$i]." 
					AND status='approved'");
					if($rt=='full')
					{
						$net=$cm->u_total("add_sale", "netCost", "invoice_no=".$_POST['refrence'][$i]."");
						$psf=$ticket-$net;
						//$psf=$ticket+$otherSale+$tour-$refund;
					}
					$trfnd=$refund+$psf-$ser_char;
					$totalSale=$ticket+$otherSale+$tour-$trfnd;
					$total_payment=$cm->u_total("sale_inv_aging", "amount", "invoice_number=".$_POST['refrence'][$i]." AND status='approved'");
					if($totalSale==$total_payment)
					{
						$cm->update("add_sale", "status='done'", "invoice_no=".$_POST['refrence'][$i]."");
						$cm->update("other_sale", "status='done'", "invoice_no=".$_POST['refrence'][$i]."");
						$cm->update("tour_sale_invoice", "status='done'", "invoice_no=".$_POST['refrence'][$i]."");
					}
				}
		}
		$cm->update("payment_reciept", "refrence='".$refrence."'", "TPRV=".$tp_rv."");
	}
	else
	{
		echo 'error';
		exit();
	}
}
?>