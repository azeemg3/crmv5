<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['pkg_id']) && !empty($_GET['pkg_id']))
{
	$pkg_id=$_GET['pkg_id'];
	$result=$cm->selectData("web_umrah_pkg", "pkg_id=".$pkg_id."");
	$row=$result->fetch_assoc();
}
?>
<script>
    document.title = 'Add Umrah Packages';
</script>
<style>
#cke_1_contents{ height:300px !important;}
</style>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> 
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
            <h3 class="box-title">Add New Packages</h3>
          </div>
          <!-- /.box-header -->
           <?php echo $msg->return_msg() ?>
          <!-- form start -->
          <form role="form" action="controllers/save_web_umrah_pkg" enctype="multipart/form-data" method="post">
          <input type="hidden" name="pkg_id" value="<?php echo $row['pkg_id'] ?>" />
            <div class="box-body">
             <div class="col-md-10">
              <div class="form-group">
                <label for="exampleInputEmail1">Package Type</label>
                <select class="form-control input-sm" name="cat_id">
                 <?php echo $tour->umrah_cat($row['cat_id']); ?>
                </select>
              </div>
            </div><!--col-md-10-->
            <div class="col-md-2">
             <div class="form-group">
              <label>Currency</label>
              <select class="form-control input-sm" name="currency_type">
              <option <?php if($row['currency_type']=='pkr') echo 'selected'; ?>  value="pkr">PKR</option>
              <option <?php if($row['currency_type']=='sar') echo 'selected'; ?> value="sar">SAR</option>
              </select>
             </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Thumb Detials</label>
                <input type="text" class="form-control" id="" name="thumb_details" placeholder="Thumb Details" value="<?php echo $row['thumb_details'] ?>">
              </div>
            </div><!--col-md-12-->
              <div class="col-md-6">
               <div class="form-group">
                <label>Makkah Hotel</label>
                <input type="text" name="makkah_hotels" class="form-control input-sm" placeholder="Makkah Hotel" value="<?php echo $row['makkah_hotels'] ?>">
               </div>
              </div><!--col-md-6-->
              <div class="col-md-6">
               <div class="form-group">
                <label>Madina Hotel</label>
                <input type="text" name="madina_hotels" class="form-control input-sm" placeholder="Madina Hotel" value="<?php echo $row['madina_hotels'] ?>">
               </div>
              </div><!--col-md-6-->
              <h3>Package Details:</h3>
              <!--============================================while Loop--===============================-->
              <?php
			  $id="";
			  $id=$cm->u_value("web_umrah_pkg_det", "pkg_id", "pkg_id=".$row['pkg_id']."");
			  if(!empty($id))
			  { 
			  $result_det=$cm->selectData("web_umrah_pkg_det", "pkg_id=".$row['pkg_id'].""); $i=1;
			  while($Srow=$result_det->fetch_assoc())
			  {
			   ?>
              <div class="<?php if($i==1) echo 'multi_rec';  if($i!==1) echo 'removeThis'; ?>">
              <div class="col-md-2">
               <div class="form-group">
                <label>Package Duration</label>
                <input type="number" name="pkg_duration[]" class="form-control input-sm" value="<?php echo $Srow['pkg_duration'] ?>" >
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <label>Makkah Night</label>
                <input type="number" name="makkah_night[]" class="form-control input-sm" value="<?php echo $Srow['makkah_night'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <label>Madina Night</label>
                <input type="number" name="madina_night[]" class="form-control input-sm" value="<?php echo $Srow['madina_night'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <label>Makkah Night</label>
                <input type="number" name="r_makkah_night[]" class="form-control input-sm" value="<?php echo $Srow['r_makkah_night'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="clearfix"></div>
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="sharing_price[]" class="form-control input-sm" placeholder="Sharing Price" value="<?php echo $Srow['sharing_price'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="quad_price[]" class="form-control input-sm" placeholder="Quad Price" value="<?php echo $Srow['quad_price'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="triple_price[]" class="form-control input-sm" placeholder="Triple Price" value="<?php echo $Srow['triple_price'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="double_price[]" class="form-control input-sm" placeholder="Double Price" value="<?php echo $Srow['double_price'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="single_price[]" class="form-control input-sm" placeholder="single Price" value="<?php echo $Srow['single_price'] ?>">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-1">
               <div class="from-group">
               <?php if($i==1) 
			   {
				  echo '<button type="button" class="btn btn-sm btn-primary append-multi"><i class="fa fa-plus"></i></button>'; 
			   }
			   else
			   {
				echo '<button type="button" class="btn btn-sm btn-danger remove_div"><i class="fa fa-trash"></i></button>';   
			   }
			   ?>
               </div>
              </div><!--col-md-1-->
              <div class="clearfix"></div>
              </div><!--multi-rec-->
              <?php $i++; } }
			  else { ?>
              <div class="multi_rec">
              <div class="col-md-2">
               <div class="form-group">
                <label>Package Duration</label>
                <input type="number" name="pkg_duration[]" class="form-control input-sm">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <label>Makkah Night</label>
                <input type="number" name="makkah_night[]" class="form-control input-sm">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <label>Madina Night</label>
                <input type="number" name="madina_night[]" class="form-control input-sm">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <label>Makkah Night</label>
                <input type="number" name="r_makkah_night[]" class="form-control input-sm">
               </div>
              </div><!--col-md-2-->
              <div class="clearfix"></div>
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="sharing_price[]" class="form-control input-sm" placeholder="Sharing Price">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="quad_price[]" class="form-control input-sm" placeholder="Quad Price">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="triple_price[]" class="form-control input-sm" placeholder="Triple Price">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="double_price[]" class="form-control input-sm" placeholder="Double Price">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-2">
               <div class="form-group">
                <input type="number" name="single_price[]" class="form-control input-sm" placeholder="single Price">
               </div>
              </div><!--col-md-2-->
              <div class="col-md-1">
               <div class="from-group">
                <button type="button" class="btn btn-sm btn-primary append-multi"><i class="fa fa-plus"></i></button>
               </div>
              </div><!--col-md-1-->
              <div class="clearfix"></div>
              </div><!--multi-rec-->
			<?php }   ?>
              <div class="col-md-12">
               <label>Terms & Conditions</label>
               <!--<textarea class="form-control input-sm textarea" name="terms_condtions"><?php echo $row['terms_condtions'] ?></textarea>-->
               <textarea id="editor1" name="terms_condtions" rows="10" cols="80" style="height:700px;"><?php echo $row['terms_condtions'] ?></textarea>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> 
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
$(".multi_rec").on("click",".append-multi",function(){
	$(".multi_rec").append('<div class="removeThis"><hr>'+
	 '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="pkg_duration[]" class="form-control input-sm" placeholder="Package Duration">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	  '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="makkah_night[]" class="form-control input-sm" placeholder="Makkah Night">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	   '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="madina_night[]" class="form-control input-sm" placeholder="Madina Night">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	   '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="r_makkah_night[]" class="form-control input-sm" placeholder="Makkah Night">'+
	   '</div>'+
	  '</div><!--col-md-2--><div class="clearfix"></div>'+
	  '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="sharing_price[]" class="form-control input-sm" placeholder="sharing Price">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	   '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="quad_price[]" class="form-control input-sm" placeholder="Quad Price">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	   '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="triple_price[]" class="form-control input-sm" placeholder="Triple Price">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	   '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="double_price[]" class="form-control input-sm" placeholder="Doublr Price">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	   '<div class="col-md-2">'+
	   '<div class="form-group">'+
		'<input type="number" name="single_price[]" class="form-control input-sm" placeholder="Sinlge Price">'+
	   '</div>'+
	  '</div><!--col-md-2-->'+
	  '<div class="col-md-1">'+
	   '<div class="from-group">'+
		'<button type="button" class="btn btn-sm btn-danger remove_div"><i class="fa fa-trash"></i></button>'+
	   '</div>'+
	  '</div><!--col-md-1-->'+
	'<div class="clearfix"></div></div>');
	$(".remove_div").on("click", function()
	{
		$(this).parents(".removeThis").remove();
	});
});
$(".remove_div").on("click", function()
	{
		$(this).parents(".removeThis").remove();
	});
</script> 
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
	  var j=$.noConflict();
    </script>
