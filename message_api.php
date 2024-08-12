<?php 
require_once'inc.func.php';
$cm->get_header("");
if(!empty($_POST['api_id']) && !empty($_POST['api_id']))
{
	$mask=$_POST['msg_mask'];
	$api_id=$_POST['api_id'];
	$pswd=$_POST['api_pswd'];
	$id=$_POST["id"];
	$branch=$_POST['branch'];
	$columns=array("msg_mask, api_id, api_pswd, status, cr_date ,userId, branch");
	$values=array($mask, $api_id, $pswd, 'active', $cm->current_dt() , $_SESSION['sessionId'], $_SESSION['branch_id']);
	if($id=="" || $id==0){ $cm->insertData("msg_api", $columns, $values); }
	else {
			$data=array("msg_mask"=>$mask, "api_id"=>$api_id, "api_pswd"=>$pswd,"branch"=>$branch, "status"=>'active');	
			$cm->update_array("msg_api", $data, "id=".$id."");
	}
	header("location:message_api");
}
?>
<body onLoad="call_ajax('ajax_call/get_message_api','form','get_msg_api')">
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
        
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="empty_fields('form')">&times;</button>
          <h4 class="modal-title">Add Message Api</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form action="message_api" method="post" id="form">
      <input type="hidden" name="id" id="id" value="">
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
            		<div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Mask</label>
                         <input type="text" name="msg_mask" id="msg_mask" class="form-control input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Id</label>
                          <input type="text" class="form-control input-sm" name="api_id" id="api_id">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Password </label>
                          <input type="text" class="form-control input-sm" name="api_pswd" id="api_pswd">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Select Branch</label>
                          <select class="form-control input-sm" name="branch" id="branch">
                          	<option value="">Select Branch</option>
                            	<?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <div class="col-lg-3 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-12 btn-change" id="branch"  value="Add">
                    </div>
                    </div>
                    <!-- col-lg-12-->
            </div>
            <!-- panel-body-->
            </form>
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- edit--messageapi-->
<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Branches</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="col-lg-2 pull-right">
  	<input type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal" value="Add Api">
  </div>
  <div class="clearfix"></div>
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Mask</th>
                <th>ID</th>
                <th>Branch</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
    </thead>
    <tr>
    	<td class="load" align="center" colspan="10"></td>
    </tr>
    <tbody class="get_msg_api">
    	
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