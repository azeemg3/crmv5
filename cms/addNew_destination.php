<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("web_destination", "id=".$id."");
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
            <h3 class="box-title">Add New Destination</h3>
          </div><!-- /.box-header -->
          <div class="col-md-4">
              <div class="callout callout-warning">
                <p>For Column 1= Wdith:370 px , Height:258 px</p>
              </div>
          </div><!--col-md-4-->
          <div class="col-md-4">
              <div class="callout callout-warning">
                <p>For Column 2= Wdith:700 px, Height:400 px</p>
              </div>
          </div><!--col-md-4-->
          <div class="col-md-4">
              <div class="callout callout-warning">
                <p>For Column 3= Wdith:1200 px, Height:400 px</p>
              </div>
          </div><!--col-md-4-->
          <div class="clearfix"></div>
           <?php echo $msg->return_msg() ?>
          <!-- form start -->
          <form role="form" action="controllers/save_destination" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
            <div class="box-body">
             <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Destination Type</label>
                <select class="form-control input-sm" name="destination_type">
                 <option value="domestic_dest"  <?php if($row['destination_type']=="domestic_dest") echo "selected"; ?>>Domestic</option>
                 <option value="int_dest" <?php if($row['destination_type']=="int_dest") echo "selected"; ?>>International</option>
                </select>
              </div>
             </div><!--col-md-4-->
             <div class="col-md-8">
              <div class="form-group">
                <label for="exampleInputEmail1">Destination Name</label>
                <input type="text" class="form-control input-sm" name="destination_name" placeholder="Destination Name" 
                value="<?php echo $row['destination_name'] ?>">
              </div>
             </div><!--col-md-6-->
             <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Destination Country Name</label>
                <input type="text" name="destination_country" placeholder="Destination Country" class="form-control input-sm" 
                value="<?php echo $row['destination_country'] ?>">
              </div>
             </div><!--col-md-4-->
              <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">In Column</label>
                <select class="form-control input-sm" name="in_column">
                 <?php echo $tour->dest_columns($row['in_column']); ?>
                </select>
              </div>
             </div><!--col-md-4-->
             <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Destination Image</label>
                <input type="file" class="form-control input-sm" name="destination_img">
                <?php if(!empty($row['destination_img'])){ ?>
                <p class="help-block"><img src="cms/../<?php echo $row['destination_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
             </div><!--col-md-4-->
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

