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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Add New User</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            	<form action="save" method="post">
                <input type="hidden" name="id" value="" />
            	<div class="col-lg-12 col-sm-12 col-xs-12 row">
            		<div class="col-lg-3 col-sm-6">
                    	<div class="form-group">
                          <label>Full Name</label>
                         <input type="text" id="name" name="name" required value="" class="form-control input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-3 col-sm-6">
                    	<div class="form-group">
                          <label>Mobile No:  </label>
                          <input type="text" name="mobile" id="" value="" class="form-control input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-6">
                    	<div class="form-group">
        						<label>Email: </label>
	                            <input type="text" name="email" required value="" class="form-control input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-3 col-sm-6">
                    	<div class="form-group">
        						<label>Department:</label>
	                            <select class="form-control input-sm" name="department">
									<option value="">Select...</option>
								</select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                   <div class="clearfix"></div>
				   <div class="col-lg-12">
						<div class="form-group">
							<lable>Description</label>
							<textarea name="description" class="form-control input-sm"></textarea>
                        </div>
				   </div>
                     <div class="clearfix"></div>
                    <div class="col-lg-2 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-12" value="Add" >
                    <input type="submit" class="btn btn-primary col-xs-12 col-sm-12" value="Update" >
                    </div>
                    </div>
                    <!-- col-lg-12-->
                    </form>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </section>
    </div>
    <!-- container-->
<?php 
$cm->get_footer("../");
?>
