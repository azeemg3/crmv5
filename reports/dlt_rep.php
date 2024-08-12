<?php
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
    document.title = 'Team Leads';
</script>
<style type="text/css">
  
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    user-select: none;
    -webkit-user-select: none;
    border-radius: 0px;
}
</style>
<body onLoad="call_ajax('ajax_call/get_dlt_rep', 'form', 'get_dlt_rep')">
<?php $cm->loader("../"); ?>
<div class="content-wrapper">
  <section class="content-header" style="padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12"> 
        <!-- /.box-header -->
        <div class="box-body">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Daily Leads Transfer Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="table-responsive">
              <form id="form">
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <input type="tex" name="df" class="form-control date input-sm" placeholder="Date From">
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <input type="tex" name="dt" class="form-control date input-sm" placeholder="Date to">
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <input type="tex" name="leadId" class="form-control input-sm" placeholder="Lead No">
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <input type="tex" name="mobile_no" class="form-control input-sm" placeholder="Mobile No">
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <select class="form-control input-sm" name="status">
                      <option value="">Lead Status</option>
                      <?php $cm->lead_status() ?>
                    </select>
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <select class="form-control input-sm" name="per_page">
                      <option value="">Show Records</option>
                      <?php echo $cm->show_rec(); ?>
                    </select>
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <select class="select2 form-control input-sm" name="technique">
                      <option value="">Select Technique</option>
                      <?php echo marketing::pros_tech(); ?>
                    </select>
                  </div>
                </div>
                <!-- col-lg-2-->
                <div class="col-lg-2 col-sm-3">
                  <div class="form-group">
                    <button type="button" class="btn btn-primary btn-sm" 
                                        onClick="call_ajax('ajax_call/get_dlt_rep', 'form', 'get_dlt_rep')"><i class="fa fa-search"></i>Search</button>
                    <button type="reset"  class="btn btn-default btn-sm">Reset</button>
                  </div>
                </div>
                <!-- col-lg-2-->
              </form>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;margin-top:20px;">
                    <th>#</th>
                    <th>L.Id</th>
                    <th width="15%">Contact Name</th>
                    <th>Mobile No</th>
                    <th>Transfer From</th>
                    <th>Transfer To</th>
                    <th>Status</th>
                    <th>Transfer Date</th>
                    <th>Services</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody class="get_dlt_rep">
                </tbody>
              </table>
            </div>
            <!-- /.box-body --> 
          </div>
        </div>
        <!-- /.box-body --> 
      </div>
      <!--col-xs-12--> 
    </div>
    <!--row--> 
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

    $cm->get_footer("../")
    ?>
