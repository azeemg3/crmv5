<?php
require_once'inc.func.php';
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
			$visaTyppe=$cm->u_value("tour_visa","visaType", "uniqueId='".$ts_row['uniqueId']."'");
			$ppn=$cm->u_value("tour_visa","visa_passportNo", "uniqueId='".$ts_row['uniqueId']."'");
			$net=$tVisa+$tHotel+$tTrans+$tTour+$tOther;
		    $ts[]=array("issue_date"=>$ts_row['issue_date'], "invoice_no"=>$ts_row['invoice_no'], "f_head_name"=>$ts_row['f_head_name']
			, "total_tour_sale"=>$net,"ppn"=>$ppn,"visaType"=>$visaTyppe);
			$Array['tour_sale']=$ts;
	}
	// refunds
	$refund_data="";
	$refund_result=$cm->selectData("refund", "{$sWhereW} AND status='approved'");
	while($rfnd_row=$refund_result->fetch_assoc())
	{
		$psf=0;
		if($rfnd_row['ref_type']=='full')
		{
			$rec=$cm->u_total("add_sale", "recieved", "airline_code='".$rfnd_row['airline_code']."' AND 
			ticket_no='".$rfnd_row['ticket_no']."'");//receiveable
			$nc=$cm->u_total("add_sale", "netCost", "airline_code='".$rfnd_row['airline_code']."' AND
			 ticket_no='".$rfnd_row['ticket_no']."'");//net cost
			$psf=$rec-$nc;
		}
		$t_rfnd+=$rfnd_row['net']+$psf-$rfnd_row['services_charges'];
		$tr=$rfnd_row['net']+$psf-$rfnd_row['services_charges'];
		$refund_data.='
			 <tr>
				<td>'.$rfnd_row['create_date'].'</td>
				<td></td>
				<td></td>
				<td>'.$rfnd_row['passName'].'</td>
				<td>'.$rfnd_row['airline_code'].'- '.$rfnd_row['ticket_no'].'</td>
				<td>'.$rfnd_row['sector'].'</td>
				<td>'.$tr.'</td>
			 </tr>
			 ';
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
	$rf_result=$cm->selectData("refund_payment", "{$sWhereW}");
	while($rp_row=$rf_result->fetch_assoc())
	{
		$refund_payment[]=$rp_row;
		$Array['refund_payment']=$refund_payment;
	}
	$Array['opening_balace']=$lead->lead_ob($df, $dt, $leadId);
	$Array['client_name']=$cm->u_value("lead","contact_name", "id=".$leadId."");
}
$query=$cm->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$query->fetch_assoc();
?>
<link href="bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function print_data() {
		window.print();
		setTimeout(function() {window.close();},0);
	};
</script>
<style media="print">
@page {
 size: auto;
 margin:1 auto;
}
table {
	font-size: 12px;
}
tr{ background-color:#006; }
</style>
<title>Print Sale Report</title>
<body onLoad="print_data()">
<div id="print_data">
  <div id="wrapper">
    <div id="header">
      <div id="tvt"><img src="branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
      <div id="header-mid">
        <div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
        <p align="center"><?php echo nl2br($branch_data['address']) ?> </p>
      </div>
      <!--<div id="iata"></div>--> 
    </div>
    <hr />
    <p align="center">Account Statement (Ticket Wise) for the period From: <?php echo $df ?> To: <?php echo $dt ?></p>
    <div id="exchange"><?php echo $cm->u_value("lead","contact_name","id=".$leadId.""); ?>' Ledger</div>
    <br>
    <span style="float:left;">Printy By: <?php echo $cm->u_value("user","name","id=".$_SESSION['sessionId']."") ?></span> <span style="float:right;">Print Date: <?php echo $cm->today(); ?></span>
    <table border="1" align="center" width="100%" style="border-collapse:collapse;1px solid #f4f4f4; font-size:12px;">
      <thead>
        <tr>
            <td colspan="8" align="center" style="padding:0px;"><h3>Invoices</h3></td>
        </tr>
        <tr style="background:#cdcccc;-webkit-print-color-adjust: exact; box-shadow:0px 0 1px #777 inset; ">
         <th>Date</th>
         <th>Invoice Number</th>
         <th>Passenger Name</th>
         <th>Ticket Number</th>
         <th>Sector</th>
         <th>Fare</th>
         <th>Taxes</th>
         <th>Net Amount</th>
        </tr>
    </thead>
    <?php
	//tt =total ticket invoice 
	$t_rec=0; $t_taxes=0; $t_net=0;
	if(is_array($Array['ticket_sale']))
	{
		foreach($Array['ticket_sale'] as $tVal)
		{
			$t_rec+=$tVal['recieved']-$tVal['airline_taxes'];
			$t_taxes+=$tVal['airline_taxes'];
			$t_net+=$tVal['recieved'];
			echo'
			<tr>
				<td>'.$tVal['issue_date'].'</td>
				<td>'.$tVal['invoice_no'].'</td>
				<td>'.$tVal['passName'].'</td>
				<td>'.$tVal['airline_code'].'-'.$tVal['ticket_no'].'</td>
				<td>'.$tVal['sector'].'</td>
				<td>'.$cm->show_bal_format($tVal['recieved']-$tVal['airline_taxes']).'</td>
				<td>'.$cm->show_bal_format($tVal['airline_taxes']).'</td>
				<td>'.$cm->show_bal_format($tVal['recieved']).'</td>
			</tr>
			';
		}
		echo '
			<tr>
			 	<td colspan="5" align="right" style="padding:0px;"><h4>Invoice Total:</h4></td>
			    <td><b>'.$cm->show_bal_format($t_rec).'</b></td>
             	<td><b>'.$cm->show_bal_format($t_taxes).'</b></td>
            	<td><b>'.$cm->show_bal_format($t_net).'</b></td>
			 	</tr>
			';
	}
		?>
        </table>
       	<table border="1" align="center" width="100%" style="border-collapse:collapse;1px solid #f4f4f4; font-size:12px;">
            <thead>
            	<tr>
                	<td colspan="8" align="center" style="padding:0px;"><h3>Debit Notes</h3></td>
                </tr>
                <tr style="background:#cdcccc;-webkit-print-color-adjust: exact; box-shadow:0px 0 1px #777 inset; ">
                	<th>Date</th>
                    <th>Debit Number</th>
                    <th>Remarks</th>
                    <th>Net Amount</th>
                </tr>
            </thead>
        <?php
		$dn_os=0;
		if(is_array($Array['other_sale']))
		{
			foreach($Array['other_sale'] as $oVal)
			{
				$dn_os+=$oVal['recieved'];
				echo '
				<tr>
					<td>'.$oVal['issue_date'].'</td>	
					<td>'.$oVal['invoice_no'].'</td>
					<td>'.$oVal['passName'].' '.(!empty($oVal['passport_num'])).'</td>	
					<td>'.$cm->show_bal_format($oVal['recieved']).'</td>	
				</tr>
					';
					
			}
		}
		$dn_ts=0;
		if(is_array($Array['tour_sale']))
		{
			foreach($Array['tour_sale'] as $tsVal)
			{
				$dn_ts+=$tsVal['total_tour_sale'];
				echo '
				<tr>
					<td>'.$tsVal['issue_date'].'</td>	
					<td>'.$tsVal['invoice_no'].'</td>
					<td>'.$tsVal['f_head_name'].' '.((!empty($tsVal['ppn']))?'('.$tsVal['ppn'].')':"").' 
					'.((!empty($tsVal['visaType']))?'('.$tsVal['visaType'].')':"").'</td>	
					<td>'.$cm->show_bal_format($tsVal['total_tour_sale']).'</td>	
				</tr>
					';
					
			}
		}
			echo'
			<tr>
				<td colspan="3" align="right" style="padding:0px;"><h4>Debit Note Total</h4></td>
				<td><b>'.$cm->show_bal_format($dn_os+$dn_ts).'</b></td>
			</tr>';
	 ?>
    </table>
    <table border="1" align="center" width="100%" style="border-collapse:collapse;1px solid #f4f4f4; font-size:12px;">
            <thead>
            	<tr>
                	<td colspan="8" align="center" style="padding:0px;"><h3>Void/Refund</h3></td>
                </tr>
                <tr style="background:#cdcccc;-webkit-print-color-adjust: exact; box-shadow:0px 0 1px #777 inset; ">
                <th>Date</th>
                <th>Cr. Note No.</th>
                <th>Invoice Number</th>
                <th>Passenger Name</th>
                <th>Ticket No</th>
                <th>Sector</th>
                <!--<th>Fare</th>
                <th>Taxes</th>-->
                <th>Net Amount</th>
              </tr>
              <?php
			  echo $refund_data;
			  ?>
            </thead>
            <tr>
            	<td colspan="6" align="right" style="padding:0px;"><h4>Credit Note Total:</h4></td>
                <td><?php echo $cm->show_bal_format($t_rfnd) ?></td>
            </tr>
    </table>
    <table border="1" align="center" width="100%" style="border-collapse:collapse;1px solid #f4f4f4; font-size:12px;">
        <thead>
            <tr>
                <td colspan="8" align="center" style="padding:0px;"><h3>Receipts/Payments</h3></td>
            </tr>
            <tr style="background:#cdcccc;-webkit-print-color-adjust: exact; box-shadow:0px 0 1px #777 inset; ">
            	<th>Date</th>
                <th>Voucher N0.</th>
                <th>Invoice Number</th>
                <th>Remarks</th>
                <th>Receipts(Cr)</th>
                <th>Payments(Dr)</th>
            </tr>
       </thead>
       <?php
	   $total_rec=0;
	   if(is_array($Array['receipts']))
	   {
		   foreach($Array['receipts'] as $rcpt)
		   {
			   $total_rec+=$rcpt['amount'];
			   echo
			   '
			   <tr>
				<td>'.$rcpt['app_date'].'</td>
				<td>TPRV-'.$rcpt['TPRV'].'</td>
				<td>'.$rcpt['refrence'].'</td>
				<td>'.$rcpt['remarks'].'</td>
				<td>'.$cm->show_bal_format($rcpt['amount']).'</td>
				<td></td>
			   </tr>
			   ';
		   }
	   }
	   $total_payment=0;
	   if(is_array($Array['refund_payment']))
	   {
		   foreach($Array['refund_payment'] as $rfnd_payment)
		   {
			   $total_payment+=$rfnd_payment['amount'];
			   echo
			   '
			   <tr>
				<td>'.$rfnd_payment['app_date'].'</td>
				<td></td>
				<td>'.$rfnd_payment['refrence'].'</td>
				<td>'.$rfnd_payment['detail'].'</td>
				<td></td>
				<td>'.$cm->show_bal_format($rfnd_payment['amount']).'</td>
			   </tr>
			   ';
		   }
	   }
	   ?>
       <tr>
        <td colspan="4" align="right" style="padding:0px;"><h4>Total Receipts/Payments:</h4></td>
        <td><b><?php echo $cm->show_bal_format($total_rec); ?></b></td>
        <td><b><?php echo $cm->show_bal_format($total_payment); ?></b></td>
       </tr>
   </table>
   <br>
   <table border="1" align="center" width="40%" style="border-collapse:collapse;1px solid #f4f4f4; font-size:12px; text-align:center;">
            <thead>
            	<tr>
                	<td colspan="2" align="center" style="padding:0px;"><h4>Summary</h4></td>
                </tr>
                <tr>
                	<td>Opening Balance:</td>
                    <td><span id="opening_balance"><?php echo $Array['opening_balace']; ?></span></td>
                </tr>
                <tr>
                	<td>(+)Sales:</td>
                    <td><span id="total_sales"><?php echo $cm->show_bal_format($t_net) ?></span></td>
                </tr>
                <tr>
                	<td>(+)Debit Notes:</td>
                    <td><span id="debit_note"><?php echo $cm->show_bal_format($dn_os+$dn_ts); ?></span></td>
                </tr>
                <tr>
                	<td><b>Gross Sale</b>:</td>
                    <td><b><span id="gross_sale"><?php echo $cm->show_bal_format($Array['opening_balace']+$t_net+$dn_os+$dn_ts) ?></span></b></td>
                </tr>
                <tr>
                	<td>(-)Void/Refund:</td>
                    <td><span id="void-refund"><?php echo $cm->show_bal_format($t_rfnd); ?></span></td>
                </tr>
                <tr>
                	<td>Net Sale:</td>
                    <td><span id="net_sale"><?php echo $cm->show_bal_format($Array['opening_balace']+$t_net+$dn_os+$dn_ts-$t_rfnd) ?></span></td>
                </tr>
                <tr>
                	<td>(-)Receipt:</td>
                    <td><span id="payment_receipt"><?php echo $cm->show_bal_format($total_rec); ?></span></td>
                </tr>
                <tr>
                	<td>(+)Payments:</td>
                    <td><span id="payments"><?php echo $cm->show_bal_format($total_payment) ?></span></td>
                </tr>
                <tr>
                	<td>Net Receiveable/Payable:</td>
                    <td><span id="net_rec_pay"><?php echo number_format($Array['opening_balace']+$t_net+$dn_os+$dn_ts-$t_rfnd+$total_payment-$total_rec) ?></span></td>
                </tr>
            </thead>
          </table>
  </div>
</div>
