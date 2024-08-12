<?php
require_once'../inc.func.php';
clearstatcache();
if(isset($_GET['leadId']) && $_GET['leadId'])
{
	$data=''; $payment=0;$total_rec=0;$total_pay=0; $psf=0;$rfnd=0;$rp=0;
	$leadId=$_GET['leadId'];
	/*============service charges calculate=================*/
	//fetch all refund against lead numbers $rq=refund_query
	$rq=$cm->selectData("refund", "leadId=".$leadId." AND status='approved'");
	while($row=$rq->fetch_assoc())
	{
	 if($row['ref_type']=='full')
	 {
		 $total_rec=$cm->u_total("add_sale", "recieved", "airline_code='".$row['airline_code']."' AND ticket_no='".$row['ticket_no']."'");
		 $total_pay+=$cm->u_total("add_sale", "netCost", "airline_code='".$row['airline_code']."' AND ticket_no='".$row['ticket_no']."'");
		 $psf+=$total_rec-$total_pay;
	 }
	}
	$ser_char=$cm->u_total("refund", "services_charges", "leadId=".$leadId." AND status='approved'");
	$data.='
			<tr>
				<td>'.(($cm->u_value("lead", "dr_cr", "id=".$leadId."")=='dr')?'Dr.':'Cr.').''.$cm->show_bal_format($cm->u_value("lead", "opening_balance", "id=".$leadId."")).'</td>
				<td>'.$cm->show_bal($lead->l_net_sale($leadId)).'</td>
				<td>'.$cm->cr_balance($cm->u_total("refund", "net", "leadId=".$leadId." AND status='approved'")+
				$lead->l_psf($leadId)-$ser_char).'</td>
				<td>'.$cm->cr_balance($cm->u_total("payment_reciept", "amount", "leadId=".$leadId." AND status='approved'")).'</td>
				
				<td>'.$cm->show_bal($cm->u_total("refund_payment", "amount","leadId=".$leadId." AND status='approved'")).'</td>
				<td>'.$lead->ledger_summary($leadId).'</td>
			</tr>
		';
		echo $data;
}
?>