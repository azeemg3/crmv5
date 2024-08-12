<?php
require_once'../../inc.func.php';
$sWhere="";
$whereArray=array();
// add_sale, other_sale, tour_sale
$sWhereSale="";
$whereArraySale=array();
//refund, refund payment, payment receipts
$sWhereRP="";
$whereArrayRP=array(); $array=array();
if(isset($_POST) && !empty($_POST['branch']) && !empty($_POST['spo']))
{
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	$df=$_POST['df'];
	$dt=$_POST['dt'];
	if(!empty($branch) && !empty($spo))
	{
		$whereArray[]='lead.spo='.$spo.'';
		$sWhere=implode("AND", $whereArray);
		if(!empty($df) && !empty($dt))
		{
			$whereArraySale[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$dt."', '%d-%m-%Y')";
			$sWhereSale=implode("AND",$whereArraySale);
			//***************************************
			$whereArrayRP[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$dt."', '%d-%m-%Y')";
			$sWhereRP=implode("AND", $whereArrayRP);
		}
		
	}
	$query=$cm->selectMultiData("lead.id AS leadId, lead.contact_name", 
	"lead INNER JOIN user ON lead.spo=user.id", "{$sWhere}");
	$t_inv=0;
	while($row=$query->fetch_assoc())
	{
		$ob=$lead->lead_ob($df, $dt, $row['leadId']);
		$inv=$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}");
		$refund=$cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}")+
		$lead->l_psf($row['leadId'], $df, $dt)-
		$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$dn=$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}")+$tour->lead_tour_ledger($df, $dt,$row['leadId']);
		$rec=$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$payment=$cm->u_total("refund_payment","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$cb=$ob+$inv+$dn-$refund-$rec+$payment;
		$arrayOfArray['all_data']=array("leadId"=>$row['leadId'], "client_name"=>$row['contact_name'], 
		"ob"=>$ob,
		"invoices"=>$inv, 
		"refund"=>$refund,
		"debit_note"=>$dn,
		"receipts"=>$rec,
		"payments"=>$payment,
		"cb"=>$cb
		);
		$array[]=$arrayOfArray;
	}
	echo json_encode($array);
}
?>