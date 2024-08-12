<?php
require_once'../inc.func.php';
$cm->get_header('../');
?>
<body onload="call_ajax('ajax_call/get_allLeads', 'form', 'get_allLeads')">
<div class="content-wrapper" style="min-height: 921px;"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> All Leads</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Leads Details</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
              	<form id="form">
              		<div class="col-md-2">
	                 <div class="form-group">
	                 	<input type="text" name="contact_name" class="form-control input-sm" placeholder="Contact Name">
	                 </div>
                	</div>
                	<!--col-md-2-->
                	<div class="col-md-2">
	                 <div class="form-group">
	                 	<input type="text" name="mobile_no" class="form-control input-sm" placeholder="Mobile No">
	                 </div>
                	</div>
                	<!--col-md-2-->
	                <div class="col-md-2">
	                 <div class="form-group">
	                 	<input type="text" name="leadId" class="form-control input-sm" placeholder="Lead Id">
	                 </div>
	                </div>
	                <!--col-md-2-->
                <div class="col-md-2">
                	<div class="form-group">
                		<select class="form-control input-sm" name="spo">
                			<option value="">Select</option>
                			<?php echo $lead->all_branch_spo($userId); ?>
                		</select>
                	</div>
                </div>
                <div class="col-md-2">
                	<button type="button" class="btn btn-sm btn-info" onclick="call_ajax('ajax_call/get_allLeads', 'form', 'get_allLeads')"><i class="fa fa-search"></i> Search</button>
                	<button type="button" class="btn btn-sm btn-default"><i class="fa fa-search"></i> Reset</button>
                </div>
                <!--col-md-1-->
                </form>
                <div class="col-sm-6"></div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th>#</th>
                        <th>Lead Id</th>
                        <th>Contact Name</th>
                        <th>Mobile No</th>
                        <th>Spo name</th>
                        <th>Status</th>
                        <th>Services</th>
                        <th>Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="get_allLeads"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<?php
$cm->get_footer('../');
?>
