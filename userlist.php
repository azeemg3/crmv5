<?php 
require_once'inc.func.php';
$cm->get_header("");
$cm->user_auth("branch_admin",$_SESSION['sessionId'], "");
?>
<body onLoad="call_ajax('ajax_call/get_userList', 'form', 'get_userList')">
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
        
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">All User List</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
  <thead>
  	<tr>
    	<td colspan="9">
        	<div class="col-lg-3">
            	<form id="form">
            	<div class="form-inline">
                	<label>Select branch</label>
                    <select class="form-control input-sm" name="branch" onChange="call_ajax('ajax_call/get_userList', 'form', 'get_userList')">
                    	<option value="">Select...</option>
                    	<?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                        
                    </select>
                </div>
                </form>
            </div>
            <!--col-lg-3-->
        </td>
    </tr>
  </thead>
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>User Name</th>
                <th>Account Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
    </thead>
    <tr>
    	<td class="load" align="center" colspan="10"></td>
    </tr>
    <tbody class="get_userList">
    	
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
$cm->get_footer("")
?>
