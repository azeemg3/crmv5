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
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">All Xo</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <img src="../images/back.png" alt="" />
  <div class="table-responsive">
  <form id="form">
  <input type="hidden" name="spo" value="" >
  <input type="hidden" name="page" value="1">
  <table class="table table-bordered table-striped">
  <thead>
  <tr>
  	<td colspan="10">
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Date From:</label>
            <input type="text" name="dt_frm" class="form-control date input-sm">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Date To:</label>
            <input type="text" name="dt_to" class="form-control date input-sm" >
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Lead No:</label>
            <input type="text" name="leadId" class="form-control input-sm" >
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Xo No:</label>
            <input type="text" name="xo_no" class="form-control input-sm" >
            </div>
        </div>
        <!-- col-lg-2-->
		<div class="col-lg-2 col-sm-3" style="margin-top:25px;">
            <div class="form-group">
           <input type="button" class="btn btn-success" value="Search">
		   <input type="reset"  class="btn btn-danger" value="Reset">
            </div>
        </div>
        <!-- col-lg-2-->
    </td>
  </tr>
  </thead>
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Date Of Issue</th>
                <th>User</th>
                <th>L.Id</th>
                <th>Supplier Name</th>
                <th>Total Amount</th>
                <th>Net Payable</th>
                <th>Recieved Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody id="get_pen_xo">
    </tbody>
    </table>
    </form>
  </div>
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
