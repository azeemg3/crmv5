<?php
require_once'inc.func.php';
$c_m=new crm();
if(isset($_GET['leadId']) && !empty($_GET['leadId']))
{
	$leadId=$_GET['leadId'];
	if(!empty($_POST['suppl_name']))
	{
		$columns=array("`branch`, `salesStaff`, `date_issue`, `suppl_name`, `basic_fare`, `tax1`, `tax2`, `tax3`, `tax4`, `tax5`, `total`, `incentive`, `commission`, `net_payable`, `rec_amount`, create_date ,status, `leadId`, `userId`");
		$values=array($_POST['branch'], $_POST['salesStaff'], $_POST['date_issue'], $_POST['suppl_name'], $_POST['basic_fare'], 
		$_POST['tax1'], $_POST['tax2'], $_POST['tax3'], $_POST['tax4'], $_POST['tax5'], $_POST['total'], $_POST['incentive'], $_POST['commission'], 
		$_POST['net_payable'], $_POST['rec_amount'], $c_m->current_dt(), 'pending', $leadId, $userSessionId);
		$c_m->insertData("xo_sale", $columns, $values);
		$xoId=mysql_insert_id();
		// Add air line data information 
		// Passenger Details
		$passName=$_POST['passName'];
		$count_pass=count($passName);
		$pass_detail=$_POST['pass_detail'];
		for($i=0; $i<$count_pass; $i++)
		{
		$c_m->insertData_multi("xo_passenger", "passName, pass_detail, xoId, leadId", " '$passName[$i]', '$pass_detail[$i]', '$xoId', '$leadId' ");
		}
		// xo flight details
	$flight_frm=$_POST['flight_frm'];
	$count_flight=count($flight_frm);
	$flight_to=$_POST['flight_to'];
	$fare_bais=$_POST['fare_bais'];
	$carrier=$_POST['carrier'];
	$flightNo=$_POST['flightNo'];
	$class=$_POST['class'];
	$xo_date=$_POST['xo_date'];
	$dep_time=$_POST['dep_time'];
	$ar_time=$_POST['ar_time'];
	$status=$_POST['status'];
	$airLine_data=$_POST['airLine_data'];
	$colum=" `flight_frm`, `flight_to`, `fare_bais`, `carrier`, `flightNo`, `class`, `xo_date`, `dep_time`, `ar_time`, 
	`status`, `airLine_data`, `xoId`, `leadId` ";
	for($j=0; $j<$count_flight; $j++){
	$c_m->insertData_multi("xo_flight_detail", "$colum", " '$flight_frm[$j]', '$flight_to[$j]', '$fare_bais[$j]', '$carrier[$j]', '$flightNo[$j]', '$class[$j]',
	'$xo_date[$j]', '$dep_time[$j]', '$ar_time[$j]', '$status[$j]', '$airLine_data[$j]', '$xoId', ".$leadId." ");
	}
	}
}
?>