<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
 <!-- Modal -->
<body onload="loadpage()">
  <div class="modal fade" id="add_candidate" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="close_modal('form')">&times;</button>
          <h4 class="modal-title">Add New Candidate</h4>
          	<div class="panel panel-default">
            <form id="form">
      			<div class="panel-body">
            		<div class="col-lg-12 col-sm-12 col-xs-12 row">
                    	<div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Candidate Name</label>
                              <input type="text" name="candidate_name" class="form-control input-sm" />
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Mobile No:</label>
                              <input type="text" name="mobile" class="form-control input-sm" />
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                     <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Apply For:</label>
                              <select name="job_id" class="form-control input-sm">
                              	<option value="">Select...</option>
                                 <option value="">Select</option>
                                 </select>
                              </select>
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Education</label>
                              <input type="text" name="education" class="form-control input-sm" />
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Experience</label>
                              <select name="experience" class="form-control input-sm">
                              	<option value="0">Select...</option>
                                <option value="">Years</option>
                              </select>
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Location</label>
                              <input type="text" name="location" class="form-control input-sm" />
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Skills</label>
                              <input type="text" name="skill" class="form-control input-sm" />
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<div class="form-group">
                              <label>Refrence</label>
                              <input type="text" name="refrence" class="form-control input-sm" />
                           </div>
                    		<!-- form--group-->
                    	</div>
                    <!-- col-lg-6-->
                    <div class="col-lg-6 col-sm-6">
                    		<input type="button" value="Add" class="btn btn-info btn-sm" style="margin-top:10%;" onClick="add_cand()">
                    	</div>
                    <!-- col-lg-6-->
                    </div>
                    <!-- col-lg-12-->
            	</div>
                </form>
          </div>
          <!--panel-default-->
        </div>
      </div>
      
    </div>
  </div>
 <?php require_once'candidate_detail.php'; ?>
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
<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Candidates List</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="col-lg-2 pull-right">
  	<div class="form-group">
		<input type="button" value="Add Candidate" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_candidate">
    </div>
  </div>
  <!--col-lg-2-->
  <div class="clearfix"></div>
  <form id="search_cand_form">
  <div class="col-lg-2">
  	<div class="form-group">
    	<input type="text" name="frm_dt" class="form-control input-sm date" placeholder="From Date">
    </div>
  </div>
  <!--col-lg-2-->
  <div class="col-lg-2">
  	<div class="form-group">
    	<input type="text" name="to_dt" class="form-control input-sm date" placeholder="To Date" >
    </div>
  </div>
  <!--col-lg-2-->
  <div class="col-lg-2">
  	<div class="form-group">
    	<input type="text" name="mobile" class="form-control input-sm" placeholder="Search With Mobile" >
    </div>
  </div>
  <!--col-lg-2-->
   <div class="col-lg-2">
  	<div class="form-group">
    	<input type="text" name="name" class="form-control input-sm" placeholder="Search Wtih Name" >
    </div>
  </div>
  <!--col-lg-2-->
  <div class="col-lg-2">
  	<div class="form-group">
    	<input type="button" class="btn btn-success btn-sm" value="Search" >
        <input type="reset" class="btn btn-danger btn-sm" value="Reset" >
    </div>
  </div>
  <!--col-lg-2-->
  </form>
  <div class="clearfix"></div>
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
  </thead>
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Candidate Name</th>
                <th>Mobile</th>
                <th>Education</th>
                <th>Location</th>
                <th>Refrence</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody id="get_candidates">
    	
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
