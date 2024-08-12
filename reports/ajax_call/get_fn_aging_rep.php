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
//2nd fn 
$whereArraySale_two=array(); $sWhereSale_two="";
$whereArrayRP_two=array(); $sWhereRP_two="";
//third fn
$whereArraySale_three=array(); $sWhereSale_three="";
$whereArrayRP_three=array(); $sWhereRP_three="";
//fourth fn
$whereArraySale_four=array(); $sWhereSale_four="";
$whereArrayRP_four=array(); $sWhereRP_four="";
//five fn
$whereArraySale_five=array(); $sWhereSale_five="";
$whereArrayRP_five=array(); $sWhereRP_five="";
//six fn
$whereArraySale_six=array(); $sWhereSale_six="";
$whereArrayRP_six=array(); $sWhereRP_six="";
if(isset($_POST) && !empty($_POST['branch']) && !empty($_POST['spo']))
{
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	$df=$_POST['df'];
	$till_date=$report->fetch_rep_date($df,0);
	$timestamp = strtotime($till_date);
	$d=date("d", $timestamp);
	if($d>=16)
	{
		$day=$d-16;
		$prev_date=$report->fetch_rep_date($df, $day);
	}
	elseif($d<=15)
	{
		$day=16-$d;
		$prev_date=$report->fetch_rep_date($df, 15-$day);
	}
	/*echo ($prev_date."=".$till_date);
	echo "<br>";*/
	//2nd fn
	$prev_date_two=$report->fetch_rep_date($prev_date, $account->month_days($prev_date));
	$till_date_two=$report->fetch_rep_date($prev_date, 1);
	/*echo ($prev_date_two."=".$till_date_two);
	echo "<br>";*/
	// 3rd fn
	$prev_date_three=$report->fetch_rep_date($prev_date_two, $account->month_days($prev_date_two));
	$till_date_three=$report->fetch_rep_date($prev_date_two, 1);
	/*echo ($prev_date_three."=".$till_date_three);
	echo "<br>";*/
	//4th fn
	$prev_date_four=$report->fetch_rep_date($prev_date_three, $account->month_days($prev_date_three));
	$till_date_four=$report->fetch_rep_date($prev_date_three, 1);
	/*echo ($prev_date_four."=".$till_date_four);
	echo "<br>";*/
	//5th fn
	$prev_date_five=$report->fetch_rep_date($prev_date_four, $account->month_days($prev_date_four));
	$till_date_five=$report->fetch_rep_date($prev_date_four, 1);
	/*echo ($prev_date_five."=".$till_date_five);
	echo "<br>";*/
	//6th fn
	$prev_date_six=$report->fetch_rep_date($prev_date_five, $account->month_days($prev_date_five));
	$till_date_six=$report->fetch_rep_date($prev_date_five, 1);
	/*echo ($prev_date_six."=".$till_date_six);
	echo "<br>";*/
	//7th fn
	$prev_date_svn=$report->fetch_rep_date($prev_date_six, $account->month_days($prev_date_six));
	$till_date_svn=$report->fetch_rep_date($prev_date_six, 1);
	/*echo ($prev_date_svn."=".$till_date_svn);
	echo "<br>";*/
	//8th fn
	$prev_date_eight=$report->fetch_rep_date($prev_date_svn, $account->month_days($prev_date_svn));
	$till_date_eight=$report->fetch_rep_date($prev_date_svn, 1);
	/*echo ($prev_date_eight."=".$till_date_eight);
	echo "<br>";*/
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
			$whereArraySale_two[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_two."', '%d-%m-%Y') AND STR_TO_DATE('".$till_date_two."', '%d-%m-%Y')";
			$sWhereSale_two=implode("AND",$whereArraySale_two);
			$whereArrayRP_two[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_two."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_two."', '%d-%m-%Y')";
			$sWhereRP_two=implode("AND", $whereArrayRP_two);
			//fetch result for 3nd fn
			$whereArraySale_three[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_three."', '%d-%m-%Y') AND STR_TO_DATE('".$till_date_three."', '%d-%m-%Y')";
			$sWhereSale_three=implode("AND",$whereArraySale_three);
			$whereArrayRP_three[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_three."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_three."', '%d-%m-%Y')";
			$sWhereRP_three=implode("AND", $whereArrayRP_three);
			//fetch result for 4th fn
			$whereArraySale_four[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_four."', '%d-%m-%Y') AND STR_TO_DATE('".$till_date_four."', '%d-%m-%Y')";
			$sWhereSale_four=implode("AND",$whereArraySale_four);
			$whereArrayRP_four[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_four."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_four."', '%d-%m-%Y')";
			$sWhereRP_four=implode("AND", $whereArrayRP_four);
			//fetch result for 5th fn
			$whereArraySale_five[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_five."', '%d-%m-%Y') AND STR_TO_DATE('".$till_date_five."', '%d-%m-%Y')";
			$sWhereSale_five=implode("AND",$whereArraySale_five);
			$whereArrayRP_five[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_five."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_five."', '%d-%m-%Y')";
			$sWhereRP_five=implode("AND", $whereArrayRP_five);
			//fetch result for 6th fn
			$whereArraySale_six[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_six."', '%d-%m-%Y') AND STR_TO_DATE('".$till_date_six."', '%d-%m-%Y')";
			$sWhereSale_six=implode("AND",$whereArraySale_six);
			$whereArrayRP_six[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$prev_date_six."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$till_date_six."', '%d-%m-%Y')";
			$sWhereRP_six=implode("AND", $whereArrayRP_six);
		}
	}
	$query=$cm->selectMultiData("lead.id AS leadId, lead.contact_name", 
	"lead INNER JOIN user ON lead.spo=user.id", "{$sWhere}");
	$t_inv=0;
	while($row=$query->fetch_assoc())
	{
		$ob=$lead->lead_ob($till_date,$prev_date, $row['leadId']);
		if($ob>0){
		$inv=$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}");
		$refund=$cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}")+
		$lead->l_psf($row['leadId'], $prev_date, $till_date)-$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$dn=$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}")+$tour->lead_tour_ledger($prev_date, $till_date,$row['leadId']);
		$rec=$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$cb=$lead->lead_ob($till_date_six,$prev_date_six, $row['leadId']);
		$arrayOfArray['all_data']=array("leadId"=>$row['leadId'], "client_name"=>$row['contact_name'], 
		"ob"=>$ob,
		"one"=>$inv+$dn-$refund-$rec,
		
		"two"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_two}")
		+$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_two}")
		+$tour->lead_tour_ledger($prev_date_two, $till_date_two,$row['leadId'])
		-($cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_two}")
		-$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_two}")
		+$lead->l_psf($row['leadId'], $prev_date_two, $till_date_two))
		-$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_two}"),
		
		"three"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_three}")-
		($cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_three}")+
		$lead->l_psf($row['leadId'], $prev_date_three, $till_date_three))-
		$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_three}")
		-$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_three}"),
		
		"four"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_four}")
		+$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_four}")
		+$tour->lead_tour_ledger($prev_date_four, $till_date_four,$row['leadId'])
		-($cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_four}")
		+$lead->l_psf($row['leadId'], $prev_date_four, $till_date_four))
		-$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_four}")
		-$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_four}"),
		
		"five"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_five}")
		+$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_five}")
		+$tour->lead_tour_ledger($prev_date_five, $till_date_five,$row['leadId'])
		-($cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_five}")
		+$lead->l_psf($row['leadId'], $prev_date_five, $till_date_five))
		-$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_five}")
		-$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_five}"),
		
		"cb"=>$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_six}")
		+$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale_six}")
		+$tour->lead_tour_ledger($prev_date_six, $till_date_six,$row['leadId'])
		-($cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_six}")-
		$cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_six}")
		+$lead->l_psf($row['leadId'], '01-01-2017', $till_date_six))-$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP_six}")
		);
		$arrayOfArray['first_date']=$df;
		$arrayOfArray['sec_date']=$till_date_two;
		$arrayOfArray['three_date']=$till_date_three;
		$arrayOfArray['four_date']=$till_date_four;
		$arrayOfArray['five_date']=$till_date_five;
		$arrayOfArray['six_date']=$till_date_six;
		$array[]=$arrayOfArray;
		}
	}
	echo json_encode($array);
}
?>