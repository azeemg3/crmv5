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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Staff List</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Name</th>
                <th>Date</th>
                <th>Department</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody id="get_staff">
    	
    </tbody>
    </table>
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
