<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<body onload="loadpage()">
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
<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Make Attendance</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <form id="form">
  <div class="col-lg-12">
    	<div class="col-lg-2">
        	<div class="form-group">
            	<label>Date From:</label>
                <input type="tex" name="frm_dt" class="form-control date input-sm">
            </div>
        </div>
        <!--col-lg-2-->
        <div class="col-lg-2">
        	<div class="form-group">
            	<label>To:</label>
                <input type="tex" name="to_dt" class="form-control date input-sm" >
            </div>
        </div>
        <!--col-lg-2-->
        <div class="col-lg-2">
        	<div class="form-group">
            	<label>Select Staff:</label>
                <select class="form-control input-sm" name="staff" >
                	<option value="">select...</option>
                </select>
            </div>
        </div>
        <!--col-lg-2-->
        <div class="col-lg-2">
        	<div class="form-group" style="margin-top:25px;">
                <input type="button" class="btn btn-success" value="Print">
            </div>
        </div>
        <!--col-lg-2-->
    </div>
    <!-- col-lg-12-->
    </form>
    <div class="clearfix"></div>
   <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Name</th>
                <th>Attendance Date</th>
                <th>Attendance Time</th>
                <th>Attendance By</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody id="get_att_rep">
    	
    </tbody>
    </table>
  </div>
</div>
    <!--panel-body-->

	</div>
    <!--panel panel-default-->

</div>
<!-- container-->
<?php 
$cm->get_footer("../");
?>
