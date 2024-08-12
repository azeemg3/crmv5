<?php
require_once'../inc.func.php';
$cm->get_header('../');
$rec_id="";
if(isset($_GET['rec_id']) && !empty($_GET['rec_id']))
{
	$rec_id=$_GET['rec_id'];
	$query=$cm->selectMultiData("user.id AS userId,lead.id, lead.contact_name, user.name, branches.branch_name,  payment_reciept.*, 
	payment_detail.bank_branch, payment_detail.ref_number,payment_detail.trans_acc_id AS transId", 
							"payment_reciept INNER JOIN user ON payment_reciept.userId=user.id
							INNER JOIN lead ON payment_reciept.leadId=lead.id
							INNER JOIN  payment_detail ON payment_reciept.id=payment_detail.rec_id
							INNER JOIN branches ON payment_reciept.branch=branches.branch_id", "payment_reciept.id=".$rec_id." AND payment_reciept.status='pending' AND payment_reciept.branch=".$_SESSION['branch_id']."");
							$row=$query->fetch_assoc();
}
else if(isset($_GET['ref_id']) && !empty($_GET['ref_id']))
{
	$ref_id=$_GET['ref_id'];
	$query=$cm->selectMultiData("user.id, user.name,lead.id, lead.contact_name, branches.branch_name, refund_payment.*", 
								"refund_payment INNER JOIN user ON refund_payment.userId=user.id
								INNER JOIN lead ON refund_payment.leadId=lead.id
								INNER JOIN branches ON refund_payment.branch=branches.branch_id", 
								"refund_payment.status='pending' AND refund_payment.id=".$ref_id." AND refund_payment.branch=".$_SESSION['branch_id']."");
								$row=$query->fetch_assoc();
}
?>
<script>
document.title='<?php if(isset($_GET['rec_id']) && !empty($_GET['rec_id'])) { echo 'Receipt Details'; }
	else { echo 'Payment Voucher'; } ?>';
</script>
<div class="clearfix"></div>
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
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">
    <?php
	if(isset($_GET['rec_id']) && !empty($_GET['rec_id'])) { echo 'Receipt Details'; }
	else { echo 'Payment Voucher'; }
	 ?>
    </span></h2>
	<div class="panel panel-default col-md-10" style="border-radius:0px; border:0px;">
  		<div class="panel-body">
        <form action="pending_cheque" method="post">
            <input type="hidden" name="rec_id" value="<?php echo $rec_id ?>">
            <input type="hidden" name="ref_id" value="<?php echo $ref_id ?>">
            <input type="hidden" name="leadId" value="<?php echo $row['leadId'] ?>" />
    	<div class="col-md-3">
        	<div class="form-group">
            	<label>Enter Password:</label>
                <input type="password" name="password" class="form-control input-sm" autocomplete="off" >
            </div>
        </div>
        <!-- col-lg-3-->
        <div class="col-md-3">
        	<div class="form-group">
            	<label>Select Bank:</label>
                <select class="form-control input-sm" name="bank_id">
                	<option value="">--Select--</option>
                	<?php echo $cm->banks(); ?>
                </select>
            </div>
        </div>
        <!-- col-lg-5-->
        <div class="col-md-2">
         <div class="form-group">
          <label>TP-RV</label>
          <input type="text" name="TPRV" title="Travelpro Refrebce Number" class="form-control input-sm" />
         </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
                <input type="submit" value="Authorize Payment" name="approved" class="btn btn-success btn-sm" style="margin-top: 25px;">
            </div>
        </div>
        <!-- col-lg-5-->
        </form>
        <div class="clearfix"></div>
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
            	<tr>
                	<td>Receipt No:</td>
                    <td><?php echo $row['id'] ?></td>
                </tr>
                <tr>
                	<td>Date:</td>
                    <td><?php echo $row['create_date'] ?></td>
                </tr>
                <tr>
                	<td>Branch:</td>
                    <td><?php echo $row['branch_name'] ?></td>
                </tr>
                <tr>
                	<td>Receive From:</td>
                    <td><?php echo $row['contact_name'] ?></td>
                </tr>
                <tr>
                	<td>Refrence:</td>
                    <td><?php echo $row['refrence'] ?></td>
                </tr>
                <tr>
                	<td>Amount:</td>
                    <td><?php echo $row['amount'] ?></td>
                </tr>
                <tr>
                	<td>Sector:</td>
                    <td>
					<?php
					if(!empty($rec_id)) 
					echo $row['sector'];
					else  echo "";
					 ?>
                    </td>
                </tr>
                <tr>
                	<td>Form Of Payment:</td>
                    <td><?php echo $row['payment_type'] ?></td>
                </tr>
                <tr>
                	<td>Remarks:</td>
                    <td>
					<?php
					if(!empty($rec_id))
					{ 
						echo $row['remarks'];
						if($row['payment_type']!='cash')
						{
							echo '('.$cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['transId']."").', '.ucwords($row['bank_branch']).')';
						}
					}
					else  echo $row['detail'];
					 ?>
                    </td>
                </tr>
                <tr>
                	<td>Issued By:</td>
                    <td><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                	<td>Action By:</td>
                    <td>Not Authorize</td>
                </tr>
            </table>
          </div>
          <!-- responsive--> 
          <form action="pending_voucher" method="post">
            <input type="hidden" name="rec_id" value="<?php echo $rec_id ?>">
            <input type="hidden" name="ref_id" value="<?php echo $ref_id ?>">
          <div class="col-lg-6">
        	<div class="form-group">
            	<label>Enter Password:</label>
                <input type="password" name="password" class="form-control input-sm">
            </div>
        </div>
        <!-- col-lg-6--> 
        <div class="col-lg-5">
        	<div class="form-group">
                <input type="submit" value="Void Receipt" name="void" class="btn btn-warning btn-sm" style="margin-top: 25px;">
            </div>
        </div>
        <!-- col-lg-5-->
    </form>
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<?php $cm->get_footer("../"); ?>