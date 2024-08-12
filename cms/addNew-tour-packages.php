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
?>
<script>
    document.title = 'Add Tour Packages';
</script>

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
            <h3 class="box-title">Add Tour Packages</h3>
          </div>
          <!-- /.box-header -->
           <?php echo $msg->return_msg() ?>
          <!-- form start -->
          <form role="form" action="controllers/save_tour_pkg" enctype="multipart/form-data" method="post">
          <input type="hidden" name="pkg_id" value="<?php echo $row['pkg_id'] ?>" />
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Package Name</label>
                <input type="text" class="form-control" id="pkg-name" name="pkg_name" placeholder="Package Name" value="<?php echo $row['pkg_name'] ?>" 
                onChange="hit_url()">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Thumb Detials</label>
                <input type="text" class="form-control" id="" name="thumb_det" placeholder="Package Name" value="<?php echo $row['pkg_thumb_det'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Thumb Image</label>
                <input type="file" id="" name="thumb_img">
                <?php if(!empty($row['pkg_thumb_img'])){ ?>
                <p class="help-block"><img src="cms/../<?php echo $row['pkg_thumb_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <div class="form-group">
              <label>File Link</label>
               <input name="file_link" type="text" value="tours/" readonly class="form-control input-sm">
              </div>
              <div class="form-group">
              <label>Link</label>
               <input name="hit-url" type="text" id="hit-url" value="<?php echo $row['hit_url'] ?>" readonly class="form-control input-sm">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Package Header Image</label>
                <input type="file" id="" name="header_img">
                <?php if(!empty($row['pkg_header_img'])) { ?>
                <p class="help-block"><img src="cms/../<?php echo $row['pkg_header_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <textarea class="textarea form-control" name="pkg_details"><?php echo $row['pkg_det'] ?></textarea>
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
</script>
