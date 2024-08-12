<?php
require_once'inc.func.php';
$cm->get_header("")
?>
<script>
    document.title = 'Vendor List';
</script>
<body onLoad="call_ajax('ajax_call/get_vendors', '', 'get_vendors')">
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
<div class="modal fade" id="vendor" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Vendor:</h4>
        </div>
         <form id="new-vendor">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<div class="col-sm-6">
                	<div class="form-group">
                    	<label>Vendor Name</label>
                    	<input type="text" name="vendor_name" class="form-control input-sm">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<label>Term & Conditons</label>
                    	<textarea class="form-control input-sm" name="term_cond" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="addVendor()" >Submit</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('new-vendor')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>

        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Vendors List</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            	<button class="btn btn-sm btn-success pull-right" onClick="addVendor()">Add New Vendor</button>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable">
                        </thead>
                        <thead>
                            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                <th>#</th>
                                <th>Vendor Name</th>
                                <th>Term & Conditions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="get_vendors">

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