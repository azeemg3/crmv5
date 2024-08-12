<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['pkg_id']) && !empty($_GET['pkg_id']))
{
	$id=$_GET['pkg_id'];
	$result=$cm->selectData("lates_packages", "id=".$id."");
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
            <h3 class="box-title">Add Latest Tour Packages</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form role="form" action="save_latest_tour_pkg" enctype="multipart/form-data" method="post">
          <input type="hidden" name="pkg_id" value="<?php echo $row['id'] ?>" />
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Tour Name</label>
                <input type="text" class="form-control" id="" name="pkg_name" placeholder="Tour Name" value="<?php echo $row['pack_name'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Tour Price</label>
                <input type="number" class="form-control" name="tourPrice" id="" placeholder="Tour Price Starting From" value="<?php echo $row['tourPrice'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Thumb Image</label>
                <input type="file" id="" name="thumb_img">
                <?php if(!empty($row['thumb_image'])){ ?>
                <p class="help-block"><img src="<?php echo $row['thumb_image'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Main Image</label>
                <input type="file" id="" name="main_img">
                <?php if(!empty($row['main_img'])) { ?>
                <p class="help-block"><img src="<?php echo $row['main_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <textarea class="textarea form-control" name="pkg_details" rows="15"><?php echo $row['pkg_details'] ?></textarea>
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
<?php $cm->get_footer("../") ?>
