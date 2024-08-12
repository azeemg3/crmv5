<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<!--=====================================Slider Modal--======================-->
<div class="modal fade new_tour"  role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <form action="controllers/save_pak_tour_dest" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="0">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Destination</h4>
        </div>
        <div class="modal-body">
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Destination Name</label>
                <input type="text" class="form-control input-sm" id="dest-name" name="dest_name" placeholder="Tour Name" onChange="hit_url()">
            </div>
         </div>
         <div class="col-md-5">
         	<div class="form-group">
            	<label>Thumb Image (378px X 258px)</label>
                <input type="file" class="form-control input-sm" name="thumb_img">
            </div>
         </div>
         <div class="col-md-1">
         	<div class="form-group">
            	<img  class="thumb-img" width="50" style="margin-top:30px; margin-left:-10px;">
            </div>
         </div>
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Cover Image (1349px X 208px)</label>
                <input type="file" class="form-control input-sm" name="cover_img">
            </div>
         </div>
         <div class="col-md-4">
         	<div class="form-group">
                <img  class="cover_img" width="80" style="margin-top:30px;">
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="col-md-10">
         	<div class="form-group">
            	<label>URL</label>
            	<input type="text" id="hit-url" name="url_link" class="form-control input-sm" placeholder="Url Link">
            </div>
         </div>
         <div class="col-md-2">
         	<div class="form-group">
            	<label>Sorting By</label>
                <select class="form-control input-sm" name="sorting_by">
                 <?php 
				 for($i=1; $i<100; $i++){
					echo '<option value="'.$i.'">'.$i.'</option>';	 	
				}
				 
				  ?>
                </select>
            </div>
         </div>
        </div>
        <!--modal-body-->
        <div class="clearfix"></div>
        <div class="modal-footer">
          <input type="submit" value="Submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--=====================================Slider Modal--======================-->
<body onLoad="call_ajax('ajax_call/get_pak_tour_dest', '', 'get_pak_tour_dest')">
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
     Pakistan Tours Destination List</span> </h2>
     <?php echo $msg->return_msg() ?>
    <div class="panel panel-default panel-default-top-radius">
      <div class="panel-body">
      	<div class="col-md-2 pull-right row">
         <a href="javascript::void(0)" onClick="add_tour()" class="btn btn-primary btn-flat pull-right">Add New</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Destination Name</th>
                <th width="10%">Thumb Image</th>
                <th>Date</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody class="get_pak_tour_dest"></tbody>
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
function hit_url()
{
	var str = document.getElementById("dest-name").value;
	str = str.replace(/\s+/g, '-'); //new object assigned to var str
	strr=str.replace(/[`~!@#$%^&*()_|+\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
	document.getElementById("hit-url").value=strr;
}
function add_tour(){
	$(".new_tour").modal();
}
function edit_pak_tour_dest(id){
	$(".new_tour").modal();
	$.ajax({
		url:"ajax_call/edit_pak_tour_dest?id="+id,
		dataType:"JSON",
		success: function(data){
			$(".new_tour input[name~='id']").val(data.id);
			$(".new_tour input[name~='dest_name']").val(data.dest_name);
			$(".new_tour .thumb-img").attr("src",""+data.thumb_img+"");
			$(".new_tour .cover_img").attr("src",""+data.cover_img+"");
			$(".new_tour input[name~='url_link']").val(data.url_link);
			$(".new_tour select[name~='sorting_by']").val(data.sorting_by);
		}
	});
}
</script>
<?php 
$cm->get_footer("../");
?>
