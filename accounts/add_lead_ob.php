<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
?>
<script>
document.title='Lead Opening Balance';
</script>
<body onLoad="call_ajax('ajax_call/get_lead_ob', '', 'get_lead_ob')">
<div class="clearfix"></div>
<div class="modal fade" id="OB" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Opening Balance</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form id="form">
      <input type="hidden" name="id" id="id">
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
            		<div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Opening Balance</label>
                         <input type="text" name="opeing_balance" class="form-control input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-md-3 col-sm-6">
                    	<div class="form-group">
                          <label>Type</label>
                         <select class="form-control input-sm input-sm" name="type">
                         	<option value="dr">Dr</option>
                            <option value="cr">Cr</option>
                         </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="clearfix"></div>
                    <div class="col-lg-3 col-xs-12 col-sm-6 pull-right">
                    <input type="button" class="btn btn-success col-xs-12 col-sm-12" value="Add" onClick="add_OB()">
                    </div>
                    </div>
                    <!-- col-lg-12-->
            </div>
            <!-- panel-body-->
      </form>
          </div>
          <!--panel-default-->
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <!-- edit--branch-->
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Lead Opening Balance</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php echo $cm->go_back(); ?>
          <div class="table-responsive">
          <form id="formSearch">
          <div class="col-md-2 col-sm-6">
            <div class="form-group">
             <input type="text" name="srch_leadId" class="form-control input-sm" placeholder="Lead Id" >
           </div>
    	<!-- form--group-->
    	</div>
    <!--co-lg-2-->
    <div class="col-md-1">
    	<button type="button" class="btn btn-info btn-sm" onClick="call_ajax('ajax_call/get_lead_ob', 'formSearch', 'get_lead_ob')"><i class="fa fa-search"></i> Search</button>
    </div>
    </form>
          	<table class="table table-bordered table-striped">
            	<thead>
                	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                    	<th>#</th>
                        <th>LeadId</th>
                        <th>Contact Name</th>
                        <th>Mobile No</th>
                        <th>Created By</th>
                        <th>Opening Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="get_lead_ob">
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
 <?php 
$cm->get_footer("../");
?>
