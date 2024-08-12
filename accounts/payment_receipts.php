<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
?>
<script>
document.title='All Payment Receipts';
</script>
<body onLoad="call_ajax('ajax_call/get_payment_receipts', 'form', 'get_payment_receipts')">
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">All Payment Reciepts</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php echo $cm->go_back(); ?>
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
            	<thead>
                	<tr>
                    	<form id="form">
                    	<div class="col-lg-2">
                        	<div class="form-group">
                            	<label>Date From</label>
                                <input type="tex" name="frm_dt" class="form-control date input-sm">
                            </div>
                        </div>
                        <div class="col-lg-2">
                        	<div class="form-group">
                            	<label>To</label>
                                <input type="tex" name="to_dt" class="form-control date input-sm" 
                                 >
                            </div>
                        </div>
                        <div class="col-lg-2" style="padding-top:25px;">
                        	<div class="form-group">
                                <button type="button"  class="btn btn-primary btn-sm" 
                                onclick="call_ajax('ajax_call/get_payment_receipts', 'form', 'get_payment_receipts')" >
                                <i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                        </form>
                    </tr>
                </thead>
            	<thead>
                	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                    	<td>Date</td>
                        <td>User</td>
                        <td>TP-RV</td>
                        <td>Issued To</td>
                        <td>Form Of Payment</td>
                        <td>Amount</td>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="get_payment_receipts">
                </tbody>
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
<?php $cm->get_footer("../");?>
