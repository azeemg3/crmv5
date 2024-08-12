<?php
require_once'inc.func.php';
$cm->get_header("");
$cm->user_auth("account-setup",$_SESSION['sessionId'], "");
?>
<script>
    document.title = 'Transaction A/C';
</script>
<body onLoad="call_ajax('ajax_call/get_transacc', '', 'get_transacc')">
    <div class="content-wrapper" id="loadpage">

        <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

 <!-- Modal -->
<div class="modal fade" id="transacc" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Creat New A/C:</h4>
        </div>
         <form id="new-transacc">
         <input type="hidden" name="trans_acc_id" value="0">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<div class="col-sm-6">
                	<div class="form-group">
                    	<label>A/C Type</label>
                    	<select class="form-control input-sm" name="trans_acc_type">
                        	<option value="">Select A/C Type</option>
                            <?php echo $administrator->trans_acc_type(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>A/C Name</label>
                    	<input type="text" name="trans_acc_name" placeholder="A/C Name" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Opening Balance</label>
                        <select class="form-control input-sm" name="dr_cr">
                        	<option value="dr">Dr</option>
                            <option value="cr">Cr</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Amount</label>
                        <input type="text" class="form-control input-sm" name="amount" placeholder="Amount">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<label>Details (e.g Term & Conditions)</label>
                    	<input type="text" class="form-control input-sm" name="trans_acc_address">
                    </div>
                </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="add_acc()" >Submit</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('new-vendor')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>

        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Transactions A/C</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            	<button class="btn btn-sm btn-success pull-right" onClick="add_acc()">New/AC</button>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable">
                        </thead>
                        <thead>
                            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                <th>#</th>
                                <th>Date</th>
                                <th>Opening Balance</th>
                                <th>A/C Type</th>
                                <th>A/C Name</th>
                                <td>Status</td>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="get_transacc">

                        </tbody>
                    </table>
                </div>
            </div>
            <!--panel panel-default-->
        </div>
        <!--panel-body-->
    </div>
    <!-- container-->
<?php $cm->get_footer("") ?>