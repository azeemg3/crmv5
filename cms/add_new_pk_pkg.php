<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("pak_tour_pkgs", "id=".$id."");
	$row=$result->fetch_assoc();
}
?>
<script>
    document.title = 'Add Tour Packages';
</script>

<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Add Pak Tour Packages</h3>
            <?php echo $msg->return_msg() ?>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form role="form" action="controllers/save_pak_tour_pkgs" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
            <div class="box-body">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Package Name</label>
                <input type="text" class="form-control" id="pkg_name" name="pkg_name" placeholder="Tour Name" value="<?php echo $row['pkg_name'] ?>" onChange="hit_url()">
              </div>
              <div class="form-group col-md-5">
                <label for="exampleInputEmail1">Select Destination</label>
                <select class="form-control"  name="destination">
                	<option value="0">Select Destination</option>
                    <?php echo $cm->pak_destination($row['destination']); ?>
                </select>
              </div>
              <div class="form-group col-md-1">
                <label for="exampleInputEmail1">Sort By</label>
                <select class="form-control"  name="sorting_by">
                    <?php 
						for($i=1; $i<100; $i++){
							echo '<option '.(($row['sorting_by']==$i)?"selected":"").' value="'.$i.'">'.$i.'</option>';
						}?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="exampleInputPassword1">Tour Price</label>
                <input type="number" class="form-control" name="tour_price"  placeholder="Tour Price Starting From" value="<?php echo $row['tourPrice'] ?>">
              </div>
              <div class="form-group col-md-1">
                <label for="exampleInputPassword1">Min Pax</label>
                <input type="number" class="form-control" name="min_pax" id="" placeholder="Min Pax" value="<?php echo $row['min_pax'] ?>">
              </div>
              <div class="form-group col-md-1">
                <label for="exampleInputPassword1">Duration</label>
                <input type="number" class="form-control" name="duration" id="" placeholder="Duration" value="<?php echo $row['duration'] ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="exampleInputPassword1">Discount %</label>
                <input type="number" class="form-control" name="discount" id="" placeholder="Discount %" value="<?php echo $row['discount'] ?>">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Url Link</label>
                <input type="text" class="form-control" name="url_link" placeholder="Url Link" value="<?php echo $row['url_link'] ?>" id="hit-url">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputFile">Thumb Image</label>
                <input type="file" id="" name="thumb_img">
                <?php if(!empty($row['thumb_img'])){ ?>
                <p class="help-block"><img src="thumb_images/<?php echo $row['thumb_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputFile">Cover Image</label>
                <input type="file" id="" name="cover_img">
                <?php if(!empty($row['cover_img'])) { ?>
                <p class="help-block"><img src="cover-images/<?php echo $row['cover_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputFile">Package Images</label>
                <input type="file" id="" name="pkg_images[]" multiple>
                <?php if(!empty($row['pkg_images'])) { ?>
                <p class="help-block"><?php echo $row['pkg_images']; ?></p>
                <?php } ?>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
              <textarea id="editor1" class="form-control" name="pkg_details" rows="15">
			  <?php echo $row['pkg_details'] ?></textarea>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script> 
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
      });
function hit_url()
{
	var str = document.getElementById("pkg_name").value;
	str = str.replace(/\s+/g, '-'); //new object assigned to var str
	strr=str.replace(/[`~!@#$%^&*()_|+\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
	document.getElementById("hit-url").value=strr;
}
    </script>
<?php $cm->get_footer("../") ?>