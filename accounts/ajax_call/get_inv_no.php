<?php
require_once'../../inc.func.php';
if(!empty($_GET['id']) && !empty($_GET['type']))
{
	$id=$_GET['id'];
	$type=$_GET['type'];
	$inv_no=$_POST['invoice_no'];
	if($type=='ticket_sale')
	{
		$cm->update("add_sale", "invoice_no='$inv_no'", "id=".$id."");
		echo $cm->u_value("add_sale", "invoice_no", "id=".$id."");
	}
	elseif($type=='other_sale')
	{
		$cm->update("other_sale", "invoice_no='$inv_no'", "id=".$id."");
		echo $cm->u_value("other_sale", "invoice_no", "id=".$id."");
	}
	elseif($type=='tour')
	{
		$cm->update("tour_sale_invoice", "invoice_no='$inv_no'", "id=".$id."");
		echo $cm->u_value("tour_sale_invoice", "invoice_no", "id=".$id."");
	}
	
}
?>