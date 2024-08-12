<?php
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("account-setup",$_SESSION['sessionId'], "");
?>
<script>
    document.title = 'OFFICIAL';
</script>
<body onLoad="call_ajax('../administrator/ajax_call/get_off_doc', '', 'get_off_doc')">
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
<div class="modal fade" id="add-new-off-doc" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create New</h4>
        </div>
         <form id="off-docForm">
            <input type="hidden" name="id" value="0">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<div class="col-sm-6">
                	<div class="form-group">
                    	<label>Document Name</label>
                    	<input type="text" name="doc_name" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>Document Type</label>
                    	<select class="form-control input-sm" name="doc_type">
                         <option value="">Select</option>
                         <option value="Legal/Financial">Legal/Financial</option>   
                         <option value="Liscense">Liscense</option>
                         <option value="BSP/IATA">BSP/IATA</option>
                         <option value="Formal">Formal</option>
                         <option value="Personal">Personal</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Alert Date</label>
                        <input type="text" name="alert_date" class="form-control input-sm date" placeholder="Alert Date">
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Due Date</label>
                        <input type="text" class="form-control input-sm date" name="due_date" placeholder="Due Date">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group">
                    	<label>Expiry Date</label>
                    	<input type="text" class="form-control input-sm date" name="exp_date" placeholder="Expiry Date">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Receiving Email</label>
                        <input type="text" class="form-control input-sm" name="rec_email">
                    </div>
                </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="add_new_off_doc('off-docForm')" >Submit</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('new-vendor')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>
		<section class="content">
        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;">
        <span class="main-heading">Offical Document</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            	<button class="btn btn-sm btn-success pull-right" onClick="add_new_off_doc()" style="border-radius: 0px;">Create New</button>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable">
                        </thead>
                        <thead>
                            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                <th>#</th>
                                <th>Document Name</th>
                                <th>Document Type</th>
                                <th>Alert Date</th>
                                <th>Due Date</th>
                                <th>Expirty Date</th>
                                <th>Receiving Eail</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="get_off_doc">

                        </tbody>
                    </table>
                </div>
            </div>
            <!--panel panel-default-->
        </div>
        <!--panel-body-->
         </section>
    </div>
    <!-- container-->
<?php $cm->get_footer("../") ?>