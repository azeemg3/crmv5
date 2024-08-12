<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<body onLoad="call_ajax('marketing/ajax_call/get_sms_log', '', 'get_sms_log')">
<!--Message detials--->
<div class="modal fade" id="msg_det_mdl">
	<div class="modal-dialog">
     <div class="modal-content">
     	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title">Message Details</h4>
      	</div>
         <div class="modal-body">
        <p class="well">Some text in the modal.</p>
      </div>
     </div>
    </div>
</div>
<!--Message detials--->
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
   
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Message Log's</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
  	<div class="col-lg-2 col-sm-6">
    	<div class="form-group">
        	<input type="text" name="frm_dt" class="form-control date input-sm" placeholder="Date From">
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
    	<div class="form-group">
        	<input type="text" name="to_dt" class="form-control date input-sm" placeholder="Date to"  />
            
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
    	<div class="form-group">
        	<button type="button" class="btn btn-sm btn-info" onClick="call_ajax('marketing/ajax_call/get_sms_log', 'form', 'get_sms_log')"><i class="fa fa-search"></i></button>
        </div>
    </div>
    </form>
    <div class="clearfix"></div>
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th style="width:9%;">Mobile </th>
                <th style="width:10%;">Sent By</th>
                <th style="width:15%;">Status</th>
                <th style="width:30%;">Message</th>
                <th style="width:15%;">Date</th>
                <th style="width:15%;">Branch</th>
            </tr>
    </thead>
    <tbody class="get_sms_log">
    </tbody>
    </table>
  </div>
</div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
</div>
<!-- container-->
<?php $cm->get_footer("")?>