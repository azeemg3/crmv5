<?php
require_once'../../inc.func.php';
session_start();
if(isset($_GET['tp_rc']) && !empty($_GET['tp_rc']))
{
	$tp_rv=$_GET['tp_rc'];
	$ref=$cm->u_value("payment_reciept", "refrence", "TPRV=".$tp_rv." AND branch=".$_SESSION['branch_id']."");
	$rec_id=$cm->u_value("payment_reciept", "id", "TPRV=".$tp_rv." AND branch=".$_SESSION['branch_id']."");
	$refArray=explode(",", $ref);
	$invTotal=0;
	foreach($refArray as $inv)
	{
		if(!empty($inv))
		{
		$invTotal+=$cm->u_total("sale_inv_aging", "amount", "invoice_number=".$inv." AND rec_id=".$rec_id."");
		}
	}
	$received=$cm->u_value("payment_reciept","amount", "TPRV=".$tp_rv." AND branch=".$_SESSION['branch_id']."");
	echo $received-$invTotal;
}
?>