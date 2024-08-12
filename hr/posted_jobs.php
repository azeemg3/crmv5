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
<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Posted Jobs</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <form id="form">
 
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <input type="tex" name="frm_dt" class="form-control date input-sm" placeholder="Date From">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <input type="tex" name="to_dt" class="form-control date input-sm" placeholder="Date To" >
            </div>
        </div>
		<div class="col-lg-2 col-sm-3 input-sm" style="margin-top:-5px;">
            <div class="form-group">
		   <input type="reset"  class="btn btn-danger btn-sm" value="Reset">
            </div>
        </div>
        <!-- col-lg-2-->
  <table class="table table-bordered table-striped">
  </thead>
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Job Title</th>
                <th>Posted Date</th>
                <th>Career Level</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody id="get_posted_jobs">
    	
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
