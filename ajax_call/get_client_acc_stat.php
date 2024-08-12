<?php
require_once'../inc.func.php';
session_start();
$Array=array();
$ticketSale=array(); $os=array(); $ts=array(); $refund=array(); $receipts=array(); $refund_payment=array();
$whereArray=array();
$whereArrayofArray=array();
$sWhereW="";
$sWhere=""; $df=""; $dt="";
if(isset($_POST['leadId']) && !empty($_POST['leadId']))
{
	$leadId=$_POST['leadId'];
	$whereArray[]="leadId=".$leadId."";
	$whereArrayofArray[]="leadId=".$leadId."";
	if(!empty($_POST['dt_frm']) && !empty($_POST['dt_to']))
	{
		$df=$_POST['dt_frm'];
		$dt=$_POST['dt_to'];
		$whereArray[]="STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
		$whereArrayofArray[]="STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')";
	}
	if($cm->user_access("branch_admin",$_SESSION['sessionId']) && !$cm->user_access("adminstrator",$_SESSION['sessionId']))
	{
		$whereArray[]="branch=".$_SESSION['branch_id']."";
		$whereArrayofArray[]="branch=".$_SESSION['branch_id']."";
	}
	if(!$cm->user_access("branch_admin",$_SESSION['sessionId']))
	{
		$whereArray[]="userId=".$_SESSION['sessionId']."";
		$whereArrayofArray[]="userId=".$_SESSION['sessionId']."";
	}
	$sWhere = implode(" AND ", $whereArray);
	$sWhereW = implode(" AND ", $whereArrayofArray);
	$ticket_result=$cm->selectData("add_sale", "{$sWhere}");
	$Array['ticket_sale']="";
	while($row=$ticket_result->fetch_assoc())
	{
		$ticketSale[]=$row;
		$Array['ticket_sale']=$ticketSale;
	}
	// other sale visa tour etc
	$Array['other_sale']="";
	$otherSale_result=$cm->selectData("other_sale", "{$sWhere}");
	while($os_row=$otherSale_result->fetch_assoc())
	{
		$os[]=$os_row;
		$Array['other_sale']=$os;
	}
	// tour sale etc
	$Array['tour_sale']="";
	$tourSale_result=$cm->selectData("tour_sale_invoice", "{$sWhere}");
	while($ts_row=$tourSale_result->fetch_assoc())
	{
			$tVisa=$cm->u_total("tour_visa", "t_visaSp", "uniqueId='".$ts_row['uniqueId']."'");
			$tHotel=$cm->u_total("tour_hotel", "t_hotelSp", "uniqueId='".$ts_row['uniqueId']."'");
			$tTrans=$cm->u_total("tour_transport", "t_transSp", "uniqueId='".$ts_row['uniqueId']."'");
			$tTour=$cm->u_total("tour_tour", "t_tourSp", "uniqueId='".$ts_row['uniqueId']."'");
			$tOther=$cm->u_total("tour_other", "t_serSp", "uniqueId='".$ts_row['uniqueId']."'");
			$net=$tVisa+$tHotel+$tTrans+$tTour+$tOther;
			$visaTyppe=$cm->u_value("tour_visa","visaType", "uniqueId='".$ts_row['uniqueId']."'");
			$ppn=$cm->u_value("tour_visa","visa_passportNo", "uniqueId='".$ts_row['uniqueId']."'");
		    $ts[]=array("issue_date"=>$ts_row['issue_date'], "invoice_no"=>$ts_row['invoice_no'], "f_head_name"=>$ts_row['f_head_name']
			, "total_tour_sale"=>$net,"ppn"=>$ppn,"visaType"=>$visaTyppe);
			$Array['tour_sale']=$ts;
	}
	// refunds
	$Array['refund']="";
	$rp=0;$rc=0;$rct=0;
	$refund_result=$cm->selectData("refund", "{$sWhereW} AND status='approved'");
	while($rfnd_row=$refund_result->fetch_assoc())
	{
		$psf=0;
		if($rfnd_row['ref_type']=='full')
		{
			$rec=$cm->u_total("add_sale", "recieved", "airline_code='".$rfnd_row['airline_code']."' AND ticket_no='".$rfnd_row['ticket_no']."'");//receiveable
			$nc=$cm->u_total("add_sale", "netCost", "airline_code='".$rfnd_row['airline_code']."' AND ticket_no='".$rfnd_row['ticket_no']."'");//net cost
			$psf=$rec-$nc;
			//total refund charges
			$rp=$cm->u_value("refund_payment", "amount", "airline_code='".$rfnd_row['airline_code']."' AND ticket_no='".$rfnd_row['ticket_no']."'");
			$rc=$rfnd_row['net'];
			if($rp>0){
			$rct+=$rc-$rp;
			}
		}
		$refund[]=array("ref_app_date"=>$rfnd_row['app_date'], "inv_no"=>$rfnd_row['invoice_number'], "passName"=>$rfnd_row['passName'], 
		"ticket_no"=>$rfnd_row['airline_code'].'-'.$rfnd_row['ticket_no'], "sector"=>$rfnd_row['sector'], "net_ref"=>$rfnd_row['net'], 
		"sc"=>$psf,"service_charges"=>$rfnd_row['services_charges']);
		$Array['refund']=$refund;
	}
	//receipts
	$Array['receipts']="";
	$rec_result=$cm->selectData("payment_reciept", "{$sWhereW} AND status='approved'");
	while($rec_row=$rec_result->fetch_assoc())
	{
		$receipts[]=$rec_row;
		$Array['receipts']=$receipts;
	}
	//payments
	$Array['refund_payment']="";
	$Array['opening_balace']="";
	$rf_result=$cm->selectData("refund_payment", "{$sWhereW} AND status='approved'");
	while($rp_row=$rf_result->fetch_assoc())
	{
		$refund_payment[]=$rp_row;
		$Array['refund_payment']=$refund_payment;
	}
	$Array['opening_balace']=$lead->lead_ob($df, $dt, $leadId);
	$Array['client_name']=$cm->u_value("lead","contact_name", "id=".$leadId."");
	$Array['rc']=$lead->l_ser_char($leadId,$df, $dt);
	//$Array['rc']=$rct;
}
echo json_encode($Array);
?>