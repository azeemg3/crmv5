<?php
require_once'../../inc.func.php';
$cm->get_header("../../");
$row=NULL;
if(isset($_GET['id']) &&  !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("web_hotels", "hotel_id=".$id."");
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
      <li class="">CMS</li>
      <li class="">Hotel</li>
      <li class="active">Add New Hotel</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Add New Hotel</h3>
          </div>
          <!-- /.box-header --> 
          <?php echo $msg->return_msg() ?> 
          <!-- form start -->
          <form role="form" action="../controllers/save_hotel" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Hotel Name</label>
                  <input type="text" name="hotel_name" class="form-control input-sm" placeholder="Hotel Name" 
                  value="<?php echo $row['hotel_name'] ?>">
                </div>
              </div>
              <!--col-md-4-->
              <div class="col-lg-4 col-sm-6">
                <div class="form-group">
                  <label>Destination</label>
                  <select class="form-control select2 input-sm" name="destination_id" onChange="select_city(this.value)">
                    <option value="">Select Destination</option>
                    <?php echo $tour->hotel_destination($row['destination_id']); ?>
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
              <div class="col-md-4">
                <div class="form-group">
                  <label>Main Image</label>
                  <input type="file" name="main_img">
                   <?php if(!empty($row['main_img'])){ ?>
                <p class="help-block"><img src="images/hotel-destination/<?php echo $row['main_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
                </div>
              </div><!--col-md-4-->
              <div class="clearfix"></div>
              <div class="col-md-4">
               <div class="form-group">
                <label>Hotel Location</label>
                <input type="text" name="hotel_location" value="<?php echo $row['hotel_location'] ?>" class="form-control input-sm" placeholder="Hotel Location">
               </div>
              </div><!--col-md-4-->
              <div class="col-md-4">
               <div class="form-group">
                <label>Hotel Star</label>
                <select class="form-control input-sm" name="hotel_star">
                 <option value="">Hotel Star</option>
                 <?php echo $tour::hotel_star($row['hotel_star']); ?>
                </select>
               </div>
              </div><!--col-md-4-->
              <div class="col-md-4">
               <div class="form-group">
                <label>Hotel type</label>
                <select class="form-control input-sm" name="hotel_type">
                 <option value="">Hotel Type</option>
                 <?php echo $tour::hotel_type($row['hotel_type']); ?>
                </select>
               </div>
              </div><!--col-md-4-->
              <div class="clearfix"></div>
              <div class="col-md-12">
               <div class="form-group">
                <label>Other Details:</label>
                <textarea name="hotel_details" class="textarea form-control input-sm"><?php echo $row['hotel_details'] ?></textarea>
               </div>
              </div><!--col-md-12-->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i>
              <?php if(empty($row['hotel_id'])) echo 'Submit'; else echo 'Update'; ?>
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
