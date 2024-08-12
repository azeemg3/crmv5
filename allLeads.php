<?php
require_once'inc.func.php';
$cm->get_header("");
$status="";
if(isset($_GET['status']) && $_GET['status']!=="update")
{
	$status=$_GET['status'];	
}
?>
<script>
    document.title = 'All Leads';
</script>
<style type="text/css">
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    user-select: none;
    -webkit-user-select: none;
    border-radius: 0px;
	width:100% !important;
}
</style>
<body onLoad="call_ajax('ajax_call/get_allLeads', 'form', 'get_allLeads')">
<?php $cm->loader(); ?>
<div class="content-wrapper">
        <section class="content-header" style="padding-bottom: 14px;">
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
        <div class="row">
            <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box box-success">
                    <div class="box-header">
                <h3 class="box-title">All Leads</h3>
              </div>
              <!-- /.box-header -->
                        <div class="table-responsive">
                            <form id="form">
                                <input type="hidden" name="user_id" value="" >
                                <input type="hidden" name="leadStatus" value="<?php echo $status; ?>">
                                <input type="hidden" name="page" value="1">

                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Date From:</label>
                                        <input type="tex" name="date_frm" class="form-control date input-sm" placeholder="Date From">
                                    </div>
                                </div>
                                <!-- col-lg-2-->
                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Date To:</label>
                                        <input type="tex" name="date_to" class="form-control date input-sm" placeholder="Date to">
                                    </div>
                                </div>
                                <!-- col-lg-2-->
                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Contact Name:</label>
                                        <input type="tex" name="contact_name" class="form-control input-sm" placeholder="Contact Name">
                                    </div>
                                </div>
                                <!-- col-lg-2-->
                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Lead No:</label>
                                        <input type="tex" name="leadId" class="form-control input-sm" placeholder="Lead No">
                                    </div>
                                </div>
                                <!-- col-lg-2-->
                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Service Type</label>
                                        <select class="select2 form-control input-sm" name="service_type">
                                            <option value="">Select...</option>
                                            <?php echo $cm->services(); ?>
                                        </select>
                                    </div>
                                </div>
                                <!--col-lg-2-->
                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Mobile No:</label>
                                        <input type="tex" name="mobile_no" class="form-control input-sm" placeholder="Mobile No">
                                    </div>
                                </div>
                                <!-- col-lg-2-->
                                <div class="col-lg-2 col-sm-3">
                                    <div class="form-group">
                                        <select class="select2 form-control input-sm" name="spo">
                                            <option value="">Select spo</option>
                                            <?php echo $cm->spo('', $_SESSION['branch_id']) ?>
                                        </select>
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
                                        <button type="button" class="btn btn-primary btn-sm" onClick="call_ajax('ajax_call/get_allLeads', 'form', 'get_allLeads')"><i class="fa fa-search"></i>Search</button>
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
                                            <th>Spo Name</th>
                                            <th>Status</th>
                                            <th>Travel Date</th>
                                            <th>Services</th>
                                            <th>Balance</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="get_allLeads">

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
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
$(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
		});
</script>
    <?php

    $cm->get_footer("")
    ?>
