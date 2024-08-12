<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
$msg="";$TPRV=0;
if(isset($_POST['approved']) && md5($_POST['password'])==$cm->password_app($_SESSION['sessionId']))
{
	$rec_id=$_POST['rec_id'];
	$ref_id=$_POST['ref_id'];
	$TPRV=$_POST['TPRV'];
	if(!empty($rec_id))
	{
		$branch_name=$cm->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."");
		$contact_name=$cm->u_value("lead", "contact_name", "id=".$_POST['leadId']."");
		$leadId=$_POST['leadId'];
		$mobile=$cm->u_value("lead", "mobile", "id=".$_POST['leadId']."");
		$already_app=$cm->u_value("payment_reciept", "status", "status='approved' AND id=".$rec_id."");
		if($already_app!=='approved')
		{
			$cm->update("payment_reciept", "TPRV=".$TPRV.", status='approved', app_date='".$cm->today()."', app_by=".$_SESSION['sessionId']."", "id=".$rec_id."");
			/* Approved the Transaction Account  */
			$transCode=$cm->u_value("payment_reciept","trans_code","id=".$rec_id."");
			$cm->update("trans","status='approved'","trans_code=".$transCode."");
			$cm->update("sale_inv_aging", "status='approved'", "rec_id=".$rec_id."");
			// approved the status after aging if balce o all sale will hide from lead details...............
			$result=$cm->selectData("sale_inv_aging", "rec_id=".$rec_id." AND status='approved'");
			while($row=$result->fetch_assoc())
			{
				$ticket=$cm->u_total("add_sale", "recieved", "invoice_no=".$row['invoice_number']."");
				$otherSale=$cm->u_total("other_sale", "recieved", "invoice_no=".$row['invoice_number']."");
				$tourInv=$tour->sum_tour_invoice($row['invoice_number']);
				$refund=$cm->u_total("refund", "net", "invoice_number=".$row['invoice_number']." 
					AND status='approved'");
				$ser_char=$cm->u_total("refund", "services_charges", "invoice_number=".$row['invoice_number']." 
				AND status='approved'");
				$rt=$cm->u_value("refund", "ref_type", "invoice_number=".$row['invoice_number']." 
				AND status='approved'");
				if($rt=='full')
				{
					$net=$cm->u_total("add_sale", "netCost", "invoice_no=".$row['invoice_number']."");
					$psf=$ticket-$net;
					//$psf=$ticket+$otherSale+$tour-$refund;
				}
				$trfnd=$refund+$psf-$ser_char;
				$totalSale=$ticket+$otherSale+$tourInv-$trfnd;
				$total_payment=$cm->u_total("sale_inv_aging", "amount", "invoice_number=".$row['invoice_number']." AND status='approved'");
				if($totalSale==$total_payment)
				{
					$cm->update("add_sale", "status='done'", "invoice_no=".$row['invoice_number']."");
					$cm->update("other_sale", "status='done'", "invoice_no=".$row['invoice_number']."");
					$cm->update("tour_sale_invoice", "status='done'", "invoice_no=".$row['invoice_number']."");
				}
			}
			$amount=$cm->u_value("payment_reciept", "amount", "id=".$_POST['rec_id']."");
			//$account->succacc($leadId);
			//Cusotmer will receive message when payment paid to Accountant via this message api
			$branch_name=$cm->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."");
			$phone=$cm->u_value("branches", "phone_line", "branch_id=".$_SESSION['branch_id']."");
			$message = "Thanks ".$contact_name.",\nWe have received the payment ".$amount.".\nWe value you as a preferred  customer and look forward to future business with you. \n".$branch_name." ".$phone."";
			$account->message_api($mobile, $message);
	$msg='<div class=" col-md-4 col-md-offset-4 alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                Payment Has been received! 
         </div>';
		}
	}
	else if(isset($_POST['ref_id']) && !empty($_POST['ref_id']))
	{
		$ref_id=$_POST['ref_id'];
		$leadId=$_POST['leadId'];
		$TPPV=$_POST['TPRV'];
		$password=md5($_POST['password']);
		$cm->update("refund_payment", "TPPV='$TPPV', status='approved', app_by='".$_SESSION['sessionId']."', app_date='".$cm->today()."'", "id=".$ref_id."");
		/* Approved the Transaction Account  */
		$transCode=$cm->u_value("refund_payment","trans_code","id=".$ref_id."");
		$cm->update("sale_inv_aging", "status='approved'", "ref_id=".$ref_id."");
			// approved the status after aging if balce o all sale will hide from lead details...............
			$result=$cm->selectData("sale_inv_aging", "ref_id=".$ref_id." AND status='approved'");
			while($row=$result->fetch_assoc())
			{
				$ticket=$cm->u_total("add_sale", "recieved", "invoice_no=".$row['invoice_number']."");
				$otherSale=$cm->u_total("other_sale", "recieved", "invoice_no=".$row['invoice_number']."");
				$tourInv=$tour->sum_tour_invoice($row['invoice_number']);
				$refund=$cm->u_total("refund", "net", "invoice_number=".$row['invoice_number']." 
					AND status='approved'");
				$ser_char=$cm->u_total("refund", "services_charges", "invoice_number=".$row['invoice_number']." 
					AND status='approved'");
				$rt=$cm->u_value("refund", "ref_type", "invoice_number=".$_POST['refrence'][$i]." 
					AND status='approved'");
					if($rt=='full')
					{
						$net=$cm->u_total("add_sale", "netCost", "invoice_no=".$_POST['refrence'][$i]."");
						$psf=$ticket-$net;
						//$psf=$ticket+$otherSale+$tour-$refund;
					}
				$trfnd=$refund+$psf-$ser_char;
				$totalSale=$ticket+$otherSale+$tourInv-$trfnd;
				$total_payment=$cm->u_total("sale_inv_aging", "amount", "invoice_number=".$row['invoice_number']." AND status='approved'");
				if($totalSale==$total_payment)
				{
					$cm->update("add_sale", "status='done'", "invoice_no=".$row['invoice_number']."");
					$cm->update("other_sale", "status='done'", "invoice_no=".$row['invoice_number']."");
					$cm->update("tour_sale_invoice", "status='done'", "invoice_no=".$row['invoice_number']."");
				}
			}
		$cm->update("trans","status='approved'","trans_code=".$transCode."");
		//$account->succ_acc($leadId);
		$msg='<div class=" col-md-4 col-md-offset-4 alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                Payment Has been Refund! 
         </div>'; 
	}

}
else if(!empty($_POST['approved']) && md5($_POST['approved'])!=$cm->password_app($_SESSION['sessionId']))
{
	$msg='<div class="col-md-5 col-md-offset-3 alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
				You Entered  Wrong Password OR You are not Authorize 
				 <a onClick="history.go(-1)">Go Back</a></p>
		 </div>';
}

if(isset($_POST['void']) && md5($_POST['password'])==$cm->password_app($_SESSION['sessionId']))
{
		$rec_id=$_POST['rec_id'];
		$ref_id=$_POST['ref_id'];
		if(!empty($rec_id))
		{
		$cm->update("payment_reciept", "status='cancel', app_date='".$cm->today()."'", "id=".$rec_id."");
		}
		else{
		$cm->update("refund_payment", "status='cancel', app_date='".$cm->today()."'", "id=".$ref_id."");
		}
		echo'
			<div class="col-lg-6 col-md-6 col-sm-4 col-xs-offset-4 success">
			<p> <span>Success:</span> Voucher Has been Void! 
			<a onClick="history.go(-2)">Go Back</a></p>   	
		</div>';
			exit;
}
else if(!empty($_POST['void']) && md5($_POST['password'])!=$cm->password_app($_SESSION['sessionId']))
{
	$msg='
			<div class="col-lg-6 col-md-6 col-sm-4 col-xs-offset-4 login-erro">
 				<p> <span>Error:</span> You Entered  Wrong Password OR You are not Authorize 
				<a onClick="history.go(-1)">Go Back</a></p>   	
			</div>';
			
}
//************************//
$query=$cm->selectMultiData("user.id AS userId,lead.id, lead.contact_name, user.name, payment_reciept.*", 
							"payment_reciept INNER JOIN user ON payment_reciept.userId=user.id
							INNER JOIN lead ON payment_reciept.leadId=lead.id", 
							"payment_reciept.status='pending' AND payment_reciept.payment_type!='cheque' AND payment_reciept.branch=".$_SESSION['branch_id']."");
$query_r=$cm->selectMultiData("user.id, user.name,lead.id, lead.contact_name, refund_payment.*", 
								"refund_payment INNER JOIN user ON refund_payment.userId=user.id
								INNER JOIN lead ON refund_payment.leadId=lead.id", 
								"refund_payment.status='pending' AND refund_payment.payment_type!='cheque' AND refund_payment.branch=".$_SESSION['branch_id']."");
?>
<script>
document.title='Pending Vochers';
</script>
<body onLoad="loadpage()">
<div class="content-wrapper" id="loadpage">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <?php echo $msg; ?>
        <div class="clearfix"></div>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Pending</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php echo $cm->go_back(); ?>
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
            	<thead>
                	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                    	<td>Date</td>
                        <td>User</td>
                        <td>Receipt No</td>
                        <td>Issued To</td>
                        <td>Form Of Payment</td>
                        <td>Amount</td>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                     <?php
					while($row=$query->fetch_assoc())
					{
						echo'
							<tr>
								<td>'.$row['create_date'].'</td>
								<td>'.$row['name'].'</td>
								<td>'.$row['id'].'</td>
								<td>'.$row['contact_name'].'</td>
								<td>'.$row['payment_type'].'</td>
								<td>'.$row['amount'].'</td>
								<td>'.$row['status'].'</td>
								<td><a href="receipt_det?rec_id='.$row['id'].'">View Receipt</a></td>
							</tr>
						';
					}
					while($row=$query_r->fetch_assoc())
					{
						echo'
							<tr>
								<td>'.$row['create_date'].'</td>
								<td>'.$row['name'].'</td>
								<td>'.$row['id'].'</td>
								<td>'.$row['contact_name'].'</td>
								<td>'.$row['payment_type'].'</td>
								<td>'.$row['amount'].'</td>
								<td>'.$row['status'].'</td>
								<td><a href=receipt_det?ref_id='.$row['id'].'>View PV</a></td>
							</tr>
						';
					}
				?>
                </thead>
            </table>
          </div>
          <!-- responsive-->  
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
 <?php 
$cm->get_footer("../");
?>
