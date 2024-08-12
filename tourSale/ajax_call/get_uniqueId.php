<?php
require_once'../../inc.func.php';
$cm=new crm();
if(!empty($_GET['uniqueId']))
{
	$uniqueId=$_GET['uniqueId'];
	$branch=$_GET['branch'];
	$spo=$_GET['spo'];
	$leadId=$_GET['leadId'];
	$issue_date=$_POST['issue_date'];
	$family_headName=$_POST['family_name'];
	$ltu=$cm->ltu($leadId);// lead taken userid
	if($family_headName!="")
	{
		$col=array('spo, userId, branch, date, uniqueId, leadId, f_head_name, issue_date');
		$values=array($spo, $ltu, $branch, $cm->current_dt(), $uniqueId, $leadId, $family_headName, $issue_date);
		$cm->insertData("tour_sale_invoice", $col, $values);
		$cm->update("lead", "status='process', proc_date='".$cm->current_dt()."'", "id=".$leadId." and status!='process'");
		// vsia sale tour sale invoice
		$cm->update("trans","status='approved'", "".$cm->u_value("tour_visa", "trans_code", "uniqueId='".$uniqueId."'")."");
		// htoel tour sale invoice
		$cm->update("trans","status='approved'", "".$cm->u_value("tour_hotel", "trans_code", "uniqueId='".$uniqueId."'")."");
		// transport tour sale invoice 
		$cm->update("trans","status='approved'", "".$cm->u_value("tour_transport", "trans_code", "uniqueId='".$uniqueId."'")."");
		// tour Tour sale invoice
		$cm->update("trans","status='approved'", "".$cm->u_value("tour_tour", "trans_code", "uniqueId='".$uniqueId."'")."");
		// Other Services sale invoice
		$cm->update("trans","status='approved'", "".$cm->u_value("tour_other", "trans_code", "uniqueId='".$uniqueId."'")."");
		
	}
}
echo $cm->uniqueId();
?>