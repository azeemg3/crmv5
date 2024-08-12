<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts",$_SESSION['sessionId'], "../");
$p_r=$cm->count_val("payment_reciept", "id", "status='pending' AND payment_type!='cheque' AND branch=".$_SESSION['branch_id']."")+
$cm->count_val("refund_payment", "id", "status='pending' AND payment_type!='cheque' AND branch=".$_SESSION['branch_id']."");
$p_cheque=$cm->count_val("payment_reciept", "id", "status='pending' AND payment_type='cheque' AND branch=".$_SESSION['branch_id']."")+
$cm->count_val("refund_payment", "id", "status='pending' AND payment_type='cheque' AND branch=".$_SESSION['branch_id']."");
?>
<script>
document.title='Accounts';
</script>
<div class="content-wrapper">
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Accounts Message Box</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
  			<p>
                <ul class="list-group">
                <?php if($p_r!="" || $p_r!=0) { ?>
                    <li class="list-group-item">
                    <span class="badge">
						<?php echo $p_r; ?>
                	</span>
                    <a href="pending_voucher">Pending Receipts</a> <img class="blink_img" src="../images/icon_new.gif" /> </li> 
                    <?php } ?>
                    <?php if($p_cheque!="" || $p_cheque!=0) { ?>
                    <li class="list-group-item">
                    <span class="badge">
						<?php echo $p_cheque; ?>
                	</span>
                    <a href="pending_cheque">Pending Cheque</a> <img class="blink_img" src="../images/icon_new.gif" /> </li> 
                    <?php } ?>
                </ul>
            </p>
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
    <span class="main-heading" style="font-size:30px;margin:0px;padding:5px 10px;font-style:italic;background:darkcyan;color:#fff;border-radius:5px;">Accounts Dashboard</span>
	<div class="panel panel-default">
  		<div class="panel-body">
  			<!--<div class="col-lg-3 col-sm-4">
            	<div class="panel panel-default">
                	<img src="../images/dsashbord-img/cash.png"> 
                    <a href="cash_book"><span title="Lead Management System"> Daily Cash Book </span></a>
                </div>
            </div>-->
            <!-- col-lg-3-->
            <div class="col-lg-3 col-sm-4">
            	<div class="panel panel-default">
                	<img src="../images/dsashbord-img/sale_reports.png">
                    <a href="sale_report"><span title="Accounts"> Sales Reports</span></a>
                </div>
            </div>
            <!-- col-lg-3-->
            <div class="col-lg-3 col-sm-4">
            	<div class="panel panel-default">
                	<img src="../images/dsashbord-img/payment-icons.png">
                    <a href="payment_refunds"><span title="Accounts"> Payment & Refunds</span></a>
                </div>
            </div>
            <!-- col-lg-3-->
            <div class="col-lg-3 col-sm-4">
            	<div class="panel panel-default">
                	<img src="../images/dsashbord-img/report.png">
                    <a href="acc_auth_allLeads"><span title="Accounts">All Leads</span></a>
                </div>
            </div>
            <!-- col-lg-3-->
		</div>
		<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<?php $cm->get_footer("../"); ?>

