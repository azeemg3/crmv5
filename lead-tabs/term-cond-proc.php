<?php
require_once'../inc.func.php';
if(isset($_GET['vendor_id']) && !empty($_GET['vendor_id']))
{
	$vendor_id=$_GET['vendor_id'];
	$vendor_name=$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$vendor_id."");
	$term_cond=$cm->u_value("trans_acc", "trans_acc_address", "trans_acc_id=".$vendor_id."");
	echo $vendor_name,"~",$term_cond;
}
?>
 