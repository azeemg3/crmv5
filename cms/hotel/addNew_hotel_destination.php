<?php
require_once'../../inc.func.php';
$cm->get_header("../../");
$row=NULL;
if(isset($_GET['id']) &&  !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("web_hotel_destination", "destination_id=".$id."");
	$row=$result->fetch_assoc();
}
?>
<script>
    document.title = 'Add New Hotel Deal';
</script>
<style type="text/css">
.select2-container .select2-selection--single {
	box-sizing: border-box;
	cursor: pointer;
	display: block;
	user-select: none;
	-webkit-user-select: none;
	border-radius: 0px;
}
</style>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="../../index"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">CMS</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Add New Destination</h3>
          </div>
          <!-- /.box-header --> 
          <?php echo $msg->return_msg() ?> 
          <!-- form start -->
          <form role="form" action="../controllers/save_hotel_destination" enctype="multipart/form-data" method="post">
            <input type="hidden" name="destination_id" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Destination Name</label>
                  <input type="text" name="destination_name" class="form-control input-sm" placeholder="Hotel Destination" 
                  value="<?php echo $row['destination_name'] ?>">
                </div>
              </div>
              <!--col-md-4-->
              <div class="col-lg-4 col-sm-6">
                <div class="form-group">
                  <label>Country</label>
                  <select class="form-control select2 input-sm" name="country_id" onChange="select_city(this.value)">
                    <option value="">Select Country</option>
                    <?php echo $cm->countries($row['country_id']); ?>
                  </select>
                </div>
                <!-- form--group--> 
              </div>
              <!-- col-lg-4-->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Thumb Image</label>
                  <input type="file" name="thumb_img">
                   <?php if(!empty($row['thumb_img'])){ ?>
                <p class="help-block"><img src="images/hotel-destination/<?php echo $row['thumb_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
                </div>
              </div><!--col-md-4-->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i>
              <?php if(empty($row['destination_id'])) echo 'Submit'; else echo 'Update'; ?>
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
<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<script>
 $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
</script>
<?php $cm->get_footer("../../") ?>
