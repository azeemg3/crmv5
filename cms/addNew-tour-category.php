<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['pkg_id']) && !empty($_GET['pkg_id']))
{
	$id=$_GET['pkg_id'];
	$result=$cm->selectData("tour_pkg", "pkg_id=".$id."");
	$row=$result->fetch_assoc();
}

unset($_SESSION['content_rec']);
?>
<script>
    document.title = 'Add Tour Packages';
</script>

<!--modal-->
<div class="modal fade cat_content"  role="dialog">
  <div class="modal-dialog" style="width:80%;"> 
    <!-- Modal content-->
    <form id="content-form">
    <input type="hidden" value="0" id="uid">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Text Block Setting</h4>
        </div>
        <div class="modal-body">
         <div class="col-md-8">
         	<div class="form-group">
            	<label>Heading Text</label>
                <input type="text" class="form-control input-sm heading-text" id="content_heading" name="content_heading" placeholder="Type Heading">
            </div>
         </div>
         <div class="col-md-3">
          <label>Select Image</label>
          <input type="file" class="content-img" name="content_img">
         </div>
         <div class="clearfix"></div>
            <textarea class="textarea form-control" id="content_text"  name="content_text"></textarea>
        </div>
        <!--modal-body-->
        <div class="modal-footer">
          <input type="button" value="Send" class="btn btn-primary add-content">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--end-modal-->
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="../index"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="">Dashboard</li>
      <li class="active">CMS</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Add Category Name</h3>
          </div>
          <!-- /.box-header -->
           <?php echo $msg->return_msg() ?>
          <!-- form start -->
          <form role="form" action="controllers/save_tour_cat" enctype="multipart/form-data" method="post">
          <input type="hidden" name="cat_id" value="<?php echo $row['cat_id'] ?>" />
          <input type="hidden" name="type" value="add">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" class="form-control" id="pkg-name" name="cat_name" placeholder="Package Name" value="<?php echo $row['cat_name'] ?>" 
                onChange="hit_url()">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tour Package</label>
                <select class="form-control input-ms" name="pkg_id">
                 <?php echo tourSale::tour_list(); ?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Thumb Detials</label>
                <input type="text" class="form-control" id="" name="thumb_det" placeholder="Package Name" value="<?php echo $row['cat_thumb_det'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Thumb Image</label>
                <input type="file" id="" name="thumb_img">
                <?php if(!empty($row['cat_thumb_img'])){ ?>
                <p class="help-block"><img src="cms/../<?php echo $row['pkg_thumb_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <div class="form-group">
              <label>File Link</label>
               <input name="file_link" type="text" value="tour-package/" readonly class="form-control input-sm">
              </div>
              <div class="form-group">
              <label>Link</label>
               <input name="url_link" type="text" id="hit-url" value="<?php echo $row['hit_url'] ?>" class="form-control input-sm">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Package Header Image</label>
                <input type="file" id="" name="header_img">
                <?php if(!empty($row['pkg_header_img'])) { ?>
                <p class="help-block"><img src="cms/../<?php echo $row['pkg_header_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <h3 align="center">Category Details Content</h3>
              	<div class="form-group">
                  <button type="button" class="btn btn-primary form-control" onClick="more_content()">Click More</button>
                </div>
                </div>
            <!-- /.box-body -->
            <hr>
          <table class="table table-bordered table-striped">
           <thead>
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
             <th>#</th>
             <th>Category Name</th>
             <th>Content</th>
             <th>Image</th>
             <th>Action</th>
            </tr>
           </thead>
           <tbody id="get_session_content"></tbody>
          </table>
          <div class="box-footer">
              <button type="submit" class="btn btn-success btn-flat pull-right"><i class="fa fa-save"></i> 
              <?php if(empty($row['pkg_id'])) echo 'Submit'; else echo 'Update'; ?>
              </button>
            </div>
          </form>
        </div>
        <!-- /.box --> 
      </div>
    </div>
    <!--row--> 
  </section>
</div>
<!-- container-->
<?php $cm->get_footer("../") ?>
<script>
function hit_url()
{
	var str = document.getElementById("pkg-name").value;
	str = str.replace(/\s+/g, '-'); //new object assigned to var str
	strr=str.replace(/[`~!@#$%^&*()_|+\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
	document.getElementById("hit-url").value=strr;
}
function more_content(thisVal)
{
	$(".cat_content").modal();
	if(thisVal!==undefined)
	{
		$("#uid").val(thisVal);
		$.ajax({
			url:"models/edit_tour_pkg?uid="+thisVal,
			dataType:"JSON",
			success: function(data)
			{
					$("#content_heading").val(data.content_heading);
					$(".wysihtml5-sandbox").contents().find("body").html(data.content_text);
					$(".cat_content input type=[file]").attr("value","image_link");
					
			}
		});
		cache:false;
		
	}
}
var tst="";
var i=0;
$(".add-content").click(function(){
		var headingText=$(this).parents().find("#content-form").find(".heading-text").val();
		file_data = $(".content-img").prop("files")[0];
		if(file_data!=undefined)
		{
			var contentImage=$(this).parents().find("#content-form").find(".content-img")[0].files[0]['name'];
		}
		var content_text=$("#content_text").val();
		var content_heading=$("#content_heading").val();
		var uid=$("#uid").val();
		$.ajax({
			url:"controllers/save_tour_pkg_session",
			data:{'content_heading':content_heading, 'content_img':contentImage, 'content_text':content_text, 'uid':uid, 'type':'add'},
			type:"POST",
			success: function(data)
			{
				$("#get_session_content").html(data);
				document.getElementById("content-form").reset();
				$("#uid").val('');
				$(".cat_content").modal('hide');
			}
		});
		
		
});
$(document).on("change", ".content-img", function() {
	var file_data = $(".content-img").prop("files")[0];
	var form_data = new FormData();  
	form_data.append("file", file_data)
	$.ajax({
                url: "controllers/save_tour_pkg_img",
                //dataType: 'script',
                contentType: false,
                processData: false,
                data: form_data,                         // Setting the data attribute of ajax with file_data
                type: 'post',
				success: function(data)
				{
					
				}
       })
});
function del_tour_cat(thisVal)
{
	$("#"+thisVal).load('controllers/save_tour_pkg_session?vcr='+thisVal);
	$("#"+thisVal).hide();
}
</script>


