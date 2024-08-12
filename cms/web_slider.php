<?php 
require_once'../inc.func.php';
$cm->get_header("../");
if(isset($_POST) && !empty($_POST['main_title'])){
	$id=$_POST['id'];
	$data['main_title']=$_POST['main_title'];
	$data['sub_title']=$_POST['sub_title'];
	$data['other_det']=$_POST['other_det'];
	$data['slider_for']=$_POST['slider_for'];
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	if(!empty($_FILES['slider_image']['name'])){
		$data['slider_images']="sliders/".$_FILES['slider_image']['name'];
		move_uploaded_file($_FILES['slider_image']['tmp_name'], "sliders/".$_FILES['slider_image']['name']);
	}
	if($id==0 || $id==""){
		$query=$cm->insert_array("web_sliders", $data);
	}
	else{
		$query=$cm->update_array("web_sliders", $data, "id=".$id."");
	}
	header("location:web_slider");
}
?>
<!--=====================================Slider Modal--======================-->
<div class="modal fade web_slider"  role="dialog">
  <div class="modal-dialog" style="width:80%;"> 
    <!-- Modal content-->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="post">
    <input type="hidden" value="0" id="id" name="id">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Slider</h4>
        </div>
        <div class="modal-body">
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Main Title</label>
                <input type="text" class="form-control input-sm" name="main_title" placeholder="Main Title">
            </div>
         </div>
         <div class="col-md-6">
         	<div class="form-group">
          <label>Sub Title</label>
          <input type="text" class="form-control input-sm" name="sub_title" placeholder="Sub Title">
          </div>
         </div>
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Slider For</label>
                <select class="form-control input-sm" name="slider_for">
                    <option value="1">Pakistan Tour Slider</option>
                    <option value="2">Home Slider</option>
                </select>
            </div>
         </div>
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Slider Other Details</label>
                <input type="text" class="form-control input-sm" name="other_det" placeholder="Other Details">
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Slider Image</label>
                <span style="color:red;">( Image Size Should be 1920 X 714 px )</span>
                <input type="file" name="slider_image" class="">
            </div>
         </div>
         <div class="c0l-md-6">
         	<div class="form-group">
            
            </div>
         </div>
        </div>
        <!--modal-body-->
        <div class="modal-footer">
          <input type="submit" value="Submit" class="btn btn-primary add-content">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--=====================================Slider Modal--======================-->
<body onLoad="call_ajax('ajax_call/get_web_sliders', '', 'get_web_sliders')">
<div class="content-wrapper">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading">
     Website Slidrs</span> </h2>
    <div class="panel panel-default panel-default-top-radius">
      <div class="panel-body">
      	<div class="col-md-2 pull-right row">
         <a href="javascript::void(0)" onClick="web_slider()" class="btn btn-primary btn-flat pull-right">Add New</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Slider Title</th>
                <th width="10%">Thumb Image</th>
                <th>Home/Pakistan Tour</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody class="get_web_sliders"></tbody>
          </table>
        </div>
      </div>
      <!--panel panel-default--> 
    </div>
    <!--panel-body--> 
  </section>
</div>
<!-- container-->
<script>
function web_slider(id=null){
	$(".web_slider").modal();
	if(id!=0 || id!=""){
		$.ajax({
			url:"ajax_call/edit_web_slider?id="+id,
			dataType:"JSON",
			success: function(data){
				$("#id").val(data.id);
				$("form input[name~='main_title']").val(data.main_title);
				$("form input[name~='sub_title']").val(data.sub_title);
				$("form select[name~='slider_for']").val(data.slider_for);
				$("form input[name~='other_det']").val(data.other_det);
			}
		});
	}
	
}
</script>
<?php 
$cm->get_footer("../");
?>
