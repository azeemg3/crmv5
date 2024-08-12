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
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Post A Job</span></h2>
        <div class="panel panel-default col-lg-6">
        <form action="save_job" method="post">
            <div class="panel-body">
            	<div class="col-lg-12">
                	<div class="form-group">
                    	<label>Job Title</label>
                        <input type="text" name="job_title" class="form-control input-sm" value="">
                    </div>
                </div>
                <!--col-lg-12-->
                <div class="col-lg-12">
                	<div class="form-group">
                    	<label>Job Type</label>
                        <input type="text" name="job_type" class="form-control input-sm" value="">
                    </div>
                </div>
                <!--col-lg-12-->
                <div class="col-lg-12">
                	<div class="form-group">
                    	<label>Career Level</label>
                        <input type="text" name="career_level" class="form-control input-sm" value="">
                    </div>
                </div>
                <!--col-lg-12-->
                <div class="col-lg-12">
                	<div class="form-group">
                    	<label>Descriptions</label>
                        <textarea name="description" class="form-control input-sm"></textarea>
                    </div>
                </div>
                <!--col-lg-6-->
                <div class="clearfix"></div>
                <div class="col-lg-12">
                	<input  type="submit" class="btn btn-success pull-right" value="Set">
                     <input  type="submit" class="btn btn-success pull-right" value="Update">
                </div>
            </div>
            <!-- panel-body-->
            </form>
          </div>
          <!--panel-default-->
          </section>
    </div>
    <!-- container-->
<?php 
$cm->get_footer("../");
?>
