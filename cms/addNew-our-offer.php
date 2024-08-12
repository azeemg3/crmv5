<?php
require_once'../inc.func.php';
$cm->get_header("../");
$row=NULL;
if(isset($_GET['offer_id']) && !empty($_GET['offer_id']))
{
	$id=$_GET['offer_id'];
	$result=$cm->selectData("our_offers", "offer_id=".$id."");
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
            <h3 class="box-title">Add New Our Offer</h3>
          </div>
          <!-- /.box-header -->
           <?php echo $msg->return_msg() ?>
          <!-- form start -->
          <form role="form" action="controllers/save_our_offer" enctype="multipart/form-data" method="post">
          <input type="hidden" name="offer_id" value="<?php echo $row['offer_id'] ?>" />
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Offer Name</label>
                <select name="offer_name" id="offer-name"  class="form-control" onChange="hit_url(this.value)">
                 <option value="">Select From Offers</option>
                 <?php echo $tour->our_offer_pages($row['offer_name']); ?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Thumb Image</label>
                <input type="file" id="" name="thumb_img">
                <?php if(!empty($row['thumb_img'])){ ?>
                <p class="help-block"><img src="cms/../<?php echo $row['thumb_img'] ?>" width="50" height="50" /></p>
                <?php } ?>
              </div>
              <div class="form-group">
              <label>Link</label>
               <input name="hit-url" type="text" id="hit-url" value="<?php echo $row['url_link'] ?>" class="form-control input-sm">
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> 
              <?php if(empty($row['offer_id'])) echo 'Submit'; else echo 'Update'; ?>
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

