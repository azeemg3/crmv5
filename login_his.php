<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<body onLoad="loadpage()">
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
        
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">User Login History</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <form id="form">
  <table class="table table-bordered table-striped">
  <thead>
  <tr>
  	<td colspan="10">
        <div class="col-lg-3">
            <label>Select Spo:</label>
            <select class="form-control input-sm" name="spo">
            	<option value="">Select...</option>
            </select>
        </div>
        <!-- col-lg-2-->
    </td>
  </tr>
  </thead>
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Login Date</th>
                <th>Branch</th>
                <th>View Location</th>
            </tr>
    </thead>
    <tr>
    	<td class="load" align="center" colspan="10"></td>
    </tr>
    <tbody id="get_login_his">
    	
    </tbody>
    </table>
    </form>
  </div>
</div>
    <!--panel-body-->
	</div>
<!--panel panel-default-->

</div>
<!-- container-->
<?php
 $cm->get_footer("")
 ?>
