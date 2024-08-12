<?php
require_once'../inc.functions.php';
require_once'../session.php';
$c_m=new crm();
$lead=new lead();
$query=$c_m->selectData("branches", "branch_id=".$user_branch."");
$branch_data=mysql_fetch_array($query);
//Ticket Sale
$tkt="";
$countTkt=1;
//Visal sale
$visa="";
$countVisa=1;
//ub sale
$ub="";
$countUb=1;
//Refunds 
$ref="";
$countRef=1;
//Receipts 
$rec="";
$countRef=1;
// Refund Payment
$rp="";
$countRp=1;
if(isset($_GET['leadId']) && !empty($_GET['leadId']))
{
	$leadId=$_GET['leadId'];
	$query=$c_m->selectData("add_sale","leadId=".$leadId." ORDER BY id DESC" );
	while($row=mysql_fetch_array($query))
	{ 
	$tkt.='
			<tr>
			<td>'.$countTkt++.'</td>
			<td>'.$row['leadId'].'</td>
			<td>'.$row['issue_date'].'</td>
			<td>'.$row['airline_code'].$row['ticket_no'].'</td>
			<td>'.$row['invoice_no'].'</td>
			<td>'.$row['passName'].'</td>
			<td>'.$row['sector'].'</td>
			<td>'.$row['accDetails'].'</td>
			<td>'.$row['payment_type'].'</td>
			<td>'.number_format($row['recieved']).'</td>
		</tr>
			';
	}
	$queryVisa=$c_m->selectData("other_sale", "leadId=".$leadId." ORDER BY id DESC");
	while($row=mysql_fetch_array($queryVisa))
	{
		$visa.='
			<tr>
				<td>'.$countVisa++.'</td>
				<td>'.$row['leadId'].'</td>
				<td>'.$row['issue_date'].'</td>
				<td>'.$row['ser_type'].'</td>
				<td>'.$row['invoice_no'].'</td>
				<td>'.$row['passName'].'</td>
				<td>'.$row['sales_detail'].'</td>
				<td>'.$row['accDetails'].'</td>
				<td>'.$row['payment_type'].'</td>
				<td>'.number_format($row['recieved']).'</td>
			</tr>
		';
	}
	$queryUb=$c_m->selectData("ub_client_details", "leadId=".$leadId."");
	while($row=mysql_fetch_array($queryUb))
	{
	$client_id=$row['ub_client_id'];
	//$v_t_s_price=$c_m->u_total("ub_client_details", "ub_v_t_s_price" ,"ub_client_id=".$client_id."");
	$h_t_s_price=$c_m->u_total("ub_hotels_sale", "ub_h_t_s_price" ,"client_id=".$client_id."");
	$t_t_s_price=$c_m->u_total("ub_transports", "ub_t_t_s_price" ,"client_id=".$client_id."");
	$o_t_s_price=$c_m->u_total("ub_others", "ub_o_t_s_price" ,"client_id=".$client_id."");
	$pkg_t_s_price=$c_m->u_total("ub_pkg", "t_sale_price" ,"client_id=".$client_id."");
	$ub_net=$row['ub_v_t_s_price']+$h_t_s_price+$t_t_s_price+$o_t_s_price+$pkg_t_s_price;
	$ub.='
		<tr>
			<td>'.$countUb++.'</td>
			<td>'.$row['leadId'].'</td>
			<td>'.$row['ub_no'].'</td>
			<td>'.$row['ub_issue_date'].'</td>
			<td>'.$row['ub_client_name'].'</td>
			<td>'.$row['ub_payment_type'].'</td>
			<td>'.number_format($ub_net).'</td>
		</tr>
		';
	}
	$queryRefund=$c_m->selectData("refund", "leadId=".$leadId."");
	while($row=mysql_fetch_array($queryRefund))
	{
		$ref.='
				<tr>
				<td>'.$countRef++.'</td>
				<td>'.$row['leadId'].'</td>
				<tD>'.$row['passName'].'</td>
				<td>'.$row['phone'].'</td>
				<td>'.$row['sector'].'</td>
				<td>'.$row['ticket_no'].'</td>
				<td>'.$row['create_date'].'</td>
				<td>'.$row['net'].'</td>
			</tr>
				';
	}
	$queryRec=$c_m->selectMultiData("user.id AS userId, user.name AS user_name,payment_reciept.*, lead.*",
		"payment_reciept INNER JOIN user ON user.id=payment_reciept.userId
		INNER JOIN lead ON lead.id=payment_reciept.leadId",
		 "leadId=".$leadId." AND payment_reciept.status='approved'");
	while($row=mysql_fetch_array($queryRec))
	{
	$rec.='
		<tr>
			<td>'.$row['create_date'].'</td>
			<td>'.$row['id'].'</td>
			<td>'.$row['contact_name'].'</td>
			<td>'.$row['leadId'].'</td>
			<td>'.$row['remarks'].'</td>
			<td>'.$row['payment_type'].'</td>
			<td>0.00</td>
			<td>'.number_format($row['amount']).'</td>
		</tr>
	';
	}
	$queryRp=$c_m->selectMultiData("user.id AS userId, user.name AS user_name, refund_payment.*, lead.*",
		"refund_payment INNER JOIN user ON user.id=refund_payment.userId
		INNER JOIN lead ON lead.id=refund_payment.leadId",
		 "leadId=".$leadId." AND refund_payment.status='approved'");
		 while($row=mysql_fetch_array($queryRp))
		 {
			 $rp.='
			<tr>
				<td>'.$row['create_date'].'</td>
				<td>'.$row['id'].'</td>
				<td>'.$row['contact_name'].'</td>
				<td>'.$row['leadId'].'</td>
				<td></td>
				<td>'.$row['payment_type'].'</td>
				<td>0.00</td>
				<td>'.number_format($row['amount']).'</td>
			</tr>
			';
		 }
		 
}
?>
<style>
table{ text-align:center;}
</style>
<link href="../css/printXo.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function print_data() {
		document.getElementById("print_data").style.display="none";
		window.print();
		setTimeout(function() {window.close();},0);
	};
</script>
<title>Statement</title>
<div id="print">
<div id="wrapper">
<div id="header">
        	<div id="tvt"><img src="../branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
            <div id="header-mid">
            	<div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
                <p align="center"><?php echo nl2br($branch_data['address']) ?></p>
            </div>
        </div>
        <hr />
  <table border="1" align="center" width="100%" style="border-collapse:collapse">
  	<?php if($tkt!=""){ ?>
  	  <thead>
  			<tr>
            	<th colspan="10">Ticket Sale:</th>
            </tr>
      </thead>
      <thead>
          <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
          <th>#</th>
            <th>Lead Id</th>
            <th>Issue Date</th>
            <th>Ticket</th>
            <th>Invoice No</th>
            <th>Passenger</th>
            <th>Sector</th>
            <th>A/c Details</th>
            <th>FOP</th>
            <th>Net</th>
          </tr>
     </thead>
     <tbody>
     	<?php echo $tkt; ?>
     </tbody>
     <?php } 
	 if(!empty($visa)){
	 ?>
		<thead>
  			<tr>
            	<th colspan="10">Visa Sale:</th>
            </tr>
      </thead>
      <thead>
         <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
              <th>#</th>
              	<th>Lead Id</th>
                <th>Issue Date</th>
                <th>Service Type</th>
                <th>Invoice No</th>
                <th>Passenger</th>
                <th>SaleDetails</th>
                <th>A/c Details</th>
                <th>FOP</th>
                <th>Net</th>
         </tr>
     </thead>
     <tbody>
     	<?php echo $visa ?>
     </tbody>
     <?php } ?>
    </table>
    <?php if(!empty($ub)){ ?>
    <table border="1" align="center" width="100%" style="border-collapse:collapse">
    	<thead>
  			<tr>
            	<th colspan="11">Ub Sale:</th>
            </tr>
      </thead>
      <thead>
         <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
              	<th>#</th>
              	<th>Lead Id</th>
                <th>Ub No</th>
                <th>Issue Date</th>
                <th>Client Name</th>
                <th>FOP</th>
                <th>Net</th>
         </tr>
     </thead>
     <?php echo $ub ?>
    </table>
    <?php } 
	if(!empty($ref)){
	?>
    <table border="1" align="center" width="100%" style="border-collapse:collapse">
    	<thead>
  			<tr>
            	<th colspan="11">Refunds:</th>
            </tr>
      </thead>
      <thead>
        <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
              <th>#</th>
              	<th>Lead Id</th>
                <th>Passanger Name</th>
                <th>Mobile No</th>
                <th>Sector</th>
                <th>Ticket No</th>
                <th>Date</th>
                <th>Net</th>
              </tr>
     </thead>
     <tbody>
     	<?php echo $ref ?>
     </tbody>
    </table>
    <?php } ?>
    <table border="1" align="center" width="100%" style="border-collapse:collapse">
    <?php if(!empty($rec)){ ?>
    	<thead>
  			<tr>
            	<th colspan="11">Receipts:</th>
            </tr>
      </thead>
      <?php }
	  if(!empty($rec) || !empty($rp))
	  {
	   ?>
      <thead>
         <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
              	<th>Date</th>
                <th>Receipt No</th>
                <th>Passanger Name</th>
                <th>Lead Id</th>
                <th>A/c Details</th>
                <th>FOP</th>
                <th>Debit</th>
                <th>Credit</th>
		</tr>
     </thead>
     <tbody>
     	<?php echo $rec ?>
     </tbody>
     <?php }
	 	if(!empty($rp))
		{
	  ?>
     <thead>
     	<tr>
        	<th colspan="10">Refund Payment</th>
        </tr>
     </thead>
     <?php } ?>
     <tbody>
        	<?php echo $rp ?>
        </tbody>
    </table>
    <table border="1" align="center" width="100%" style="border-collapse:collapse">
    	<thead>
        	<tr>
        		<th colspan="10">Ledger</th>
            </tr>
        </thead>
        <thead>
        	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
              <th>Opening Balance</th>
              	<th>Add Sale Invoice</th>
                <th>Less Credit Notes</th>
                <th>Less Receipts</th>
                <th>Add Payment</th>
                <th>Net Balance</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        	<td><?php echo number_format($c_m->u_value("lead", "opening_balance", "id=".$leadId."")); ?></td>
            <td><?php  
				echo number_format($c_m->u_total("add_sale", "recieved", "leadId=".$leadId."")+ $c_m->u_total("other_sale", "recieved", 																																																																										               "leadId=".$leadId."")+$lead->lead_ub_net($leadId));
				?>
    		</td>
    		<td><?php  echo $c_m->u_total("refund", "net", "leadId=".$leadId."")  ?></td>
            <td><?php  echo number_format($c_m->u_total("payment_reciept", "amount", "leadId=".$leadId." AND status='approved'"))  ?></td>
    		<td><?php  echo number_format($c_m->u_total("refund_payment", "amount", "leadId=".$leadId." AND status='approved'"))  ?></td>
            <td>
            	<?php $net=($c_m->u_value("lead", "opening_balance", "id=".$leadId.""))+($c_m->u_total("add_sale", "recieved", "leadId=".$leadId."")+ $lead->lead_ub_net($leadId)+$c_m->u_total("other_sale", "recieved", "leadId=".$leadId."")-$c_m->u_total("refund", "net", "leadId=".$leadId."")-$c_m->u_total("payment_reciept", "amount", "leadId=".$leadId." AND status='approved'")+$c_m->u_total("refund_payment", "amount", "leadId=".$leadId." AND status='approved'")); echo number_format($net);  ?>
            </td>
        </tr>
        </tbody>
    </table>
<button style="margin-top:5px;" id="print_data" onClick="print_data()" type="button">Print</button>
</div>
</div>
