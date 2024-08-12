<?php
ob_start();
ob_clean();
session_start();
?>
<link href="../bootstrap/css/printXo.css" rel="stylesheet" charset="uft-8" />
<title>Payment Receipt</title>
<style media="print">
@page {
  size: auto;
  margin:1 auto;
       }
table{ font-size:12px;}
</style>
<?php
include'../inc.func.php';
$query=$cm->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$query->fetch_assoc();

$receipt="";
if(isset($_GET['id']))
{
	$id=$_GET['id'];
/*$sql="select U.id, U.name, lead.id AS leadId,  lead.contact_name, payment_reciept.* 
from user U
left join lead on U.id=lead.users_Id
left join payment_reciept on payment_reciept.leadId=lead.id
where payment_reciept.id=".$id." AND payment_reciept.status='approved'
";*/

$result=$cm->selectMultiData("user.id,user.name, lead.*, payment_reciept.*, payment_detail.bank_branch, payment_detail.ref_number,
payment_detail.trans_acc_id AS transId ", "user 
INNER JOIN lead ON user.id=lead.userId 
INNER JOIN  payment_reciept ON lead.id=payment_reciept.leadId
INNER JOIN  payment_detail ON payment_reciept.id=payment_detail.rec_id
", "payment_reciept.id=".$id." AND payment_reciept.status='approved'");
$row=$result->fetch_assoc();
if($row['status']=='approved')
{
$receipt.='
<table class="table" style="width:70%; margin-top:20px;" cellpadding="10">
        	<tr>
            	<td>Receipt Number</td><td align="left">RV-'.$row['TPRV'].'</td>
            </tr>
            <tr>
            	<td>Date</td><td align="left">'.$row['create_date'].' ('.$row['create_time'].')</td>
            </tr>
            <tr>
            	<td>Branch</td><td>LHE</td>
            </tr>
            <tr>
            	<td>Recieve From </td><td>'.strtoupper($row['recieve']).'</td>
            </tr>
            <tr>
            	<td>Refrence  </td><td>'.$row['refrence'].'</td>
            </tr>
            <tr>
            	<td>Amount </td><td>'.$row['amount'].'</td>
            </tr>
            <tr>
            	<td>Sector </td> <td>'.$cm->emptyWord(strtoupper($row['sector'])).'</td> 
            </tr>
            <tr>
            	<td>Form of Payment</td> <td>'.strtoupper($row['payment_type']).'</td>
            </tr>
            <tr>
            	<td>Remarks </td><td>
				'.(($row['payment_type']!='cash')?'
					'.$row['remarks'].'('.$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['transId']."").', 
					'.ucwords($row['bank_branch']).' )
				':"").'
				</td>
            </tr>
            <tr>
            	<td>Issued By </td> <td>'.strtoupper($row['name']).'</td>
            </tr>
            <tr>
            	<td>Status</td> <td>'.strtoupper($row['status']).'</td>
            </tr>
        </table>';
}
}
else if($_GET['refId'] && $_GET['refId']!="")
{
	$refId=$_GET['refId'];

$sqlRefundpayment=$cm->selectMultiData("U.id, U.name, lead.id AS leadId,  lead.contact_name, refund_payment.*", "user U
left join lead on U.id=lead.userId
left join refund_payment on refund_payment.leadId=lead.id", "refund_payment.id=".$refId." AND refund_payment.status='approved'");
$row=$sqlRefundpayment->fetch_assoc();
$receipt.='
<table class="table" style="width:70%; margin-top:20px;" cellpadding="10">
        	<tr>
            	<td>Receipt Number</td><td align="left">'.$refId.'</td>
            </tr>
            <tr>
            	<td>Date</td><td align="left">'.$row['create_date'].' ('.$row['create_time'].')</td>
            </tr>
            <tr>
            	<td>Branch</td><td>LHR</td>
            </tr>
            <tr>
            	<td>Recieve From </td><td>'.$row['payment_to'].'</td>
            </tr>
            <tr>
            	<td>Refrence  </td><td>'.$row['refrence'].'</td>
            </tr>
            <tr>
            	<td>Amount </td><td>'.$row['amount'].'</td>
            </tr>
            <tr>
            	<td>Sector </td> <td></td> 
            </tr>
            <tr>
            	<td>Form of Payment</td> <td>'.$row['payment_type'].'</td>
            </tr>
            <tr>
            	<td>Remarks </td><td>'.$row['detail'].'</td>
            </tr>
            <tr>
            	<td>Issued By </td> <td>'.$row['name'].'</td>
            </tr>
			<tr>
				<td>Status</td> <td>'.$row['status'].'</td>
			</tr>
          </table>';
}
?>
<script> 
function printContent(el)
{ 
var restorepage = document.body.innerHTML; 
var printcontent = document.getElementById(el).innerHTML; 
document.body.innerHTML = printcontent; window.print(); 
document.body.innerHTML = restorepage; } 
</script>

<style>
.table tr
{ border-bottom:1px solid black; }
body{ background-color:white !important}
</style>
<div id="print">
<div id="wrapper">
    	<div id="header">
        	<div id="tvt"><img src="../branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
            <div id="header-mid">
            	<div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
                <p align="center"><?php echo nl2br($branch_data['address']) ?>
                      
    			</p>
            </div>
            <!--<div id="iata"></div>-->
        </div><div class="clear"></div>
        <hr />
        <div id="exchange"><?php if(!empty($id)) { ?>RECEIPT VOUCHER <?php } else {  ?> PAYMENT VOUCHER <?php } ?></div>
        <div id="content_main">
        <?php echo $receipt ?>
        	<br /><br />
        </div>
        <!--<span><br /><br /><br /><br /><br /><br /><br /><br />
        ______________________________<br /><br />
        		Signature & Seal
        </span>-->
        
        
        
        
        
    </div>
</div>
    <button style="float:none; margin-left:20%; " onClick="printContent('print')"><b>Print</b></button>
