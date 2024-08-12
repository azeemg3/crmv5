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
//2nd month 
$whereArraySale_two=array(); $sWhereSale_two="";
$whereArrayRP_two=array(); $sWhereRP_two="";
//third month
$whereArraySale_three=array(); $sWhereSale_three="";
$whereArrayRP_three=array(); $sWhereRP_three="";
if(isset($_POST) && !empty($_POST['branch']) && !empty($_POST['spo']))
{
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	$df=$_POST['df'];
	$till_date=$report->fetch_rep_date($df,1);
	$prev_date=$report->fetch_rep_date($df, 30);
	//2nd motnh
	$prev_date_two=$report->fetch_rep_date($df, 60);
	$till_date_two=$prev_date;
	//2nd motnh
	$prev_date_three=$report->fetch_rep_date($df, 90);
	$till_date_three=$prev_date_two;
	if(!empty($branch) && !empty($spo))
	{
		$whereArray[]='lead.spo='.$spo.'';
		$sWhere=implode("AND", $whereArray);
		if(!empty($df))
		{
			$whereArraySale[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date."', '%d-%m-%Y')";
			$sWhereSale=implode("AND",$whereArraySale);
			//***************************************
			$whereArrayRP[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date."', '%d-%m-%Y')";
			$sWhereRP=implode("AND", $whereArrayRP);
			//fetch result for 2nd month 
			$whereArraySale_two[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_two."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_two."', '%d-%m-%Y')";
			$sWhereSale_two=implode("AND",$whereArraySale_two);
			$whereArrayRP_two[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_two."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_two."', '%d-%m-%Y')";
			$sWhereRP_two=implode("AND", $whereArrayRP_two);
			//fetch result for 3rd  month 
			$whereArraySale_three[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_three."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_three."', '%d-%m-%Y')";
			$sWhereSale_three=implode("AND",$whereArraySale_three);
			$whereArrayRP_three[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_three."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_three."', '%d-%m-%Y')";
			$sWhereRP_three=implode("AND", $whereArrayRP_three);
		}
		
	}
	$query=$cm->selectMultiData("lead.id AS leadId, lead.contact_name", 
	"lead INNER JOIN user ON lead.spo=user.id", "{$sWhere}");
	$t_inv=0;
	while($row=$query->fetch_assoc())
	{
		$ob=$lead->lead_ob($till_date,$prev_date, $row['leadId']);
		$inv=$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}");
		$refund=$cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}")+
		$lead->l_psf($row['leadId'], $prev_date, $till_date);
		$dn=$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}")+$tour->lead_tour_ledger($prev_date, $till_date,$row['leadId']);
		$rec=$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$payment=$lead->l_ser_char($row['leadId'],$prev_date,$till_date);
		$cb=$ob+$inv+$dn-$refund-$rec+$payment;
		$arrayOfArray['all_data']=array("leadId"=>$row['leadId'], "client_name"=>$row['contact_name'], 
		"ob"=>$ob,
		"one_month"=>$inv+$dn-$refund-$rec+$payment,
		"two_month"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_two}")-
		($cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_two}")+
		$lead->l_psf($row['leadId'], $prev_date_two, $till_date_two))+$lead->l_ser_char($row['leadId'],$prev_date_two,$till_date_two)-
		$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_two}"),
		"third_month"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_three}")-
		($cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_three}")+
		$lead->l_psf($row['leadId'], $prev_date_three, $till_date_three))+$lead->l_ser_char($row['leadId'],$prev_date_three,$till_date_three)-
		$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_three}")
		);
		$array[]=$arrayOfArray;
	}
	echo json_encode($array);
}
?>