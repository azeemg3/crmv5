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
<div class="modal fade" id="change_time" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <form action="save.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Office Time</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
            		<div class="col-lg-6 col-sm-6">
                    	<div class="col-lg-6">
                            <div class="form-group">
                              <label>Hour</label>
                             <select class="form-control input-sm" name="change_hour">
                            </select>
                            </div>
                            <!-- form--group-->
                       </div>
                       <div class="col-lg-6">
                            <div class="form-group">
                              <label>Minute</label>
                             <select class="form-control input-sm" name="change_min">
                            </select>
                            </div>
                            <!-- form--group-->
                       </div>
                    </div>
                    <!--co-lg-6-->
                    
                    <div class="clearfix"></div>
                    <div class="col-lg-3 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-12"  value="Update">
                    </div>
                    </div>
                    <!-- col-lg-12-->
                    
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        
      </div>
      </form>
    </div>
  </div>
<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Make Attendance</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <input type="button" class="btn btn-success" data-toggle="modal" data-target="#change_time" value="Change Office Time">
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody id="get_attendance">
    	
    </tbody>
    </table>
  </div>
</div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
</div>
<!-- container-->
<?php 
$cm->get_footer("../");
?>
