<?php 
require_once'inc.func.php';
$cm->get_header("");
$id="";
if(!empty($_POST['branch_name']) && !empty($_POST['branch_location']))
{
	$path=$_FILES['branch_logo']['name'];
	$sign_logo=$_FILES['sign_logo']['name'];
	$email_header=$_FILES['email_header']['name'];
	$id=$_POST['id'];
	move_uploaded_file($_FILES["branch_logo"]["tmp_name"],'branch_logo/'.$path);
	move_uploaded_file($_FILES["sign_logo"]["tmp_name"],'branch_logo/'.$sign_logo);
	move_uploaded_file($_FILES["email_header"]["tmp_name"],'branch_logo/'.$email_header);
	if(!empty($_POST['branch_name'])){
	$columns=array("branch_name, branch_location,address, branch_logo, sign_logo, status, create_date, user_id, branch_email, 
	phone_line, mobile, web, email_header, msg_mask");
	$values=array($_POST['branch_name'], $_POST['branch_location'], $_POST['address'] ,$path , $sign_logo, 'active', $cm->today(), $_SESSION['sessionId'], $_POST['branch_email'], $_POST['phone_line'], $_POST['mobile'], $_POST['web'], $email_header, $_POST['msg_mask']);
	}
	if($id=="" || $id==0)
	{
		$cm->insertData("branches", $columns, $values);
	}
	else{
		if(!empty($path))
		{
			$data=array("branch_logo"=>$path);
			$cm->update_array("branches", $data, "branch_id=".$id."");
		}
		if(!empty($sign_logo))
		{
			$data=array("sign_logo"=>$sign_logo);
			$cm->update_array("branches", $data, "branch_id=".$id."");
		}
		if(!empty($email_header))
		{
			$data=array("email_header"=>$email_header);
			$cm->update_array("branches", $data, "branch_id=".$id."");
		}
		$data=array("branch_name"=>$_POST['branch_name'], "branch_location"=>$_POST['branch_location'], "address"=>$_POST['address'], "user_id"=>$_SESSION['sessionId'], "branch_email"=>$_POST['branch_email'], "phone_line"=>$_POST['phone_line'], "mobile"=>$_POST['mobile'], 
		"web"=>$_POST['web'], "msg_mask"=>$_POST['msg_mask']);
		$cm->update_array("branches", $data, "branch_id=".$id."");
	}
}
?>
<body onLoad="call_ajax('ajax_call/get_branches', '', 'get_branche')">
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <div class="modal fade" id="myModal">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="empty_fields('form')">&times;</button>
          <h4 class="modal-title">Add Branch</h4>
        </div>
        <div class="modal-body">
          <p>
          <div class="panel panel-default">
            <form action="branch" id="form" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" id="id" value="">
              <div class="panel-body">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Branch Name</label>
                      <input type="text" name="branch_name" id="branch_name" class="form-control input-sm">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!--co-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Branch Location </label>
                      <input type="text" class="form-control input-sm" name="branch_location" id="branch_location">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Branch Email </label>
                      <input type="text" class="form-control input-sm" name="branch_email" id="branch_email">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Phone Line </label>
                      <input type="text" class="form-control input-sm" name="phone_line" id="phone_line">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="clearfix"></div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Mobile </label>
                      <input type="text" class="form-control input-sm" name="mobile" id="mobile">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Web </label>
                      <input type="text" class="form-control input-sm" name="web" id="web">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Message Mask</label>
                      <input type="text" name="msg_mask" class="form-control input-sm" id="msg_mask" >
                    </div>
                  </div>
                  <!--col-lg-6-->
                  <div class="clearfix"></div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Branch Logo </label>
                      <input type="file"  name="branch_logo"  onchange="readURL_img(this,'branch_logo');">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group"> <img  id="branch_logo" src="branch_logo/blank.jpg" width="50" height="50"> </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="clearfix"></div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Branch Signature Logo </label>
                      <input type="file"  name="sign_logo" onChange="readURL_img(this,'sign_logo');" >
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group"> <img  id="sign_logo" src="branch_logo/blank.jpg" width="50" height="50"> </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="clearfix"></div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label>Branch Email Header </label>
                      <input type="file"  name="email_header"  onchange="readURL_img(this,'email_header');">
                    </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="col-lg-6 col-sm-6">
                    <div class="form-group"> <img  id="email_header" src="branch_logo/blank.jpg" width="50" height="50"> </div>
                    <!-- form--group--> 
                  </div>
                  <!-- col-lg-3-->
                  <div class="clearfix"></div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" id="address" class="form-control input-sm" style="min-height:100px;"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-3 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-12" id="branch"  value="Add">
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
      </div>
    </div>
  </div>
  <!-- edit--branch-->
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Branches</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="col-lg-2 pull-right">
        <input type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal" value="Add New Branch">
      </div>
      <div class="clearfix"></div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
              <th>#</th>
              <th>Branch Name</th>
              <th>Branch Created By</th>
              <th>Branch Location</th>
              <th>Branch Logo</th>
              <th>Status</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tr>
            <td class="load" align="center" colspan="10"></td>
          </tr>
          <tbody class="get_branche">
          </tbody>
        </table>
      </div>
    </div>
    <!--panel panel-default--> 
  </div>
  <!--panel-body--> 
</div>
<!-- container-->
<?php $cm->get_footer("") ?>
