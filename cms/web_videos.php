<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("web_videos", "id=".$id."");
	$row=$result->fetch_assoc();
}
?>
<script>
    document.title = 'Add Our Offer';
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
            <h3 class="box-title">Add New Web Videos</h3>
          </div>
          <!-- /.box-header -->
           <?php echo $msg->return_msg() ?>
          <!-- form start -->
          <form role="form" action="controllers/save_web_videos" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Video Heading</label>
                <input type="text" name="video_heading" class="form-control input-sm" required value="<?php echo $row['video_heading'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Video Url</label>
                <input type="text" name="video_url" class="form-control input-sm" autocomplete="off" value="<?php echo $row['video_url'] ?>">
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> 
              <?php if(empty($row['id'])) echo 'Submit'; else echo 'Update'; ?>
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

