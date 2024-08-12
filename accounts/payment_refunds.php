<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
?>
<style type="text/css">
  
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
    border-radius: 0px;
	height: 30px !important;
}
.select2
{
	width:100% !important;
}
</style>
<script>
document.title='Payment & Refunds';
</script>
<!----Pop Up Window for Account Transaction -->
<div class="modal fade" id="transaction" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Journal:</h4>
        </div>
        <div class="col-sm-8 col-sm-offset-2 alert alert-success alert-dismissable success-load" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
            Transaction Successfully.
        </div>
        <div class="col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable error-load" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              Something Wrong With your Query.      
        </div>
        <div class="clearfix"></div>
         <form id="trans_acc_form">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>Transaction Date</label>
                    	<input type="text" class="form-control input-sm date" name="trans_date" placeholder="Transaction Date"
                        value="<?php echo $cm->today(); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>Voucher Type</label>
                    	<select class="form-control input-sm" name="vt">
                        	<?php echo $administrator->vt(); ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<select class="form-control select2 trans_from" name="trans_from">
                        	<option value="">From</option>
                          <?php echo $account->trans_acc(); ?>
                        </select>
                    </div>
                </div>
                 <div class="col-sm-12">
                	<div class="form-group">
                    	<select  class="form-control select2 trans_to" name="trans_to">
                        	<option value="">To</option>
                            <option value="">Select A/C</option>
                          <?php echo $account->trans_acc(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                        <input type="text" class="form-control input-sm number" placeholder="Amount" name="amount">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<label>Narration </label>
                    	<input type="text" class="form-control input-sm" name="short_address">
                    </div>
                </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="trans_action()" >Submit</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('new-vendor')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>
<!-- End Account Transaction---->

<body onLoad="loadpage()">
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Payment & Refunds</span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
        <h3>View Pending Receipts:</h3>
        <ul class="list-group">
          <li class="list-group-item"> <span class="badge">
		  <?php echo $cm->count_val("payment_reciept", "id", "status='pending' AND payment_type!='cheque' AND branch=".$_SESSION['branch_id']."")+
				$cm->count_val("refund_payment", "id", "status='pending' AND payment_type!='cheque' AND branch=".$_SESSION['branch_id'].""); ?> </span> 
                <a href="pending_voucher">Pending Receipts</a></li>
                <li class="list-group-item"> <span class="badge">
		  <?php echo $cm->count_val("payment_reciept", "id", "status='pending' AND payment_type='cheque' AND branch=".$_SESSION['branch_id']."")+
				$cm->count_val("refund_payment", "id", "status='pending' AND payment_type='cheque' AND branch=".$_SESSION['branch_id'].""); ?> </span> 
                <a href="pending_cheque">Pending Cheque</a></li>
          <li class="list-group-item"> <span class="badge"><?php echo $cm->count_val("payment_reciept", "id", "branch=".$_SESSION['branch_id']."")+
				$cm->count_val("refund_payment", "id", "branch=".$_SESSION['branch_id'].""); ?> </span> <a href="payment_receipts">All Receipts</a></li>
        </ul>
        <h3>Refund Reports:</h3>
        <ul class="list-group">
          <li class="list-group-item"> <span class="badge"><?php echo $cm->count_val("refund", "id", "status='pending' AND branch=".$_SESSION['branch_id'].""); ?></span> <a href="pending_refunds">Pending Refunds</a></li>
          <li class="list-group-item"> <span class="badge"><?php echo $cm->count_val("refund", "id", "status='process' AND branch=".$_SESSION['branch_id'].""); ?></span> <a href="refunds?st=process">In Process Refunds</a></li>
          <li class="list-group-item"> <span class="badge"><?php echo $cm->count_val("refund", "id", "branch=".$_SESSION['branch_id'].""); ?></span> <a href="refunds">All Refunds</a></li>
        </ul>
        <h3>Cash Book:</h3>
        <ul class="list-group">
          <li class="list-group-item"> <a onClick="new_transaction()">Transactions</a></li>
          <li class="list-group-item"> <a href="cash_book">Payment- cash Book Entry</a></li>
          <li class="list-group-item"><a href="../reports/payViewCB">Payment- View Cash Book </a></li>
          <li class="list-group-item"><a href="../reports/payViewPB">Payment- View Petty Cash Book </a></li>
        </ul>
        <h3>Opening Balance:</h3>
        <ul class="list-group">
          <li class="list-group-item"> <a href="add_lead_ob">Add Leads Opening Balance</a></li>
        </ul>
         <h3>Ledger:</h3>
        <ul class="list-group">
          <li class="list-group-item"> <a href="add_lead_ob">Ledger Reports</a></li>
        </ul>
      </div>
      <!--panel panel-default--> 
    </div>
    <!--panel-body--> 
  </section>
</div>
<!-- container-->
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
 $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
</script>
<?php 
$cm->get_footer("../");
?>
