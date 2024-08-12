<?php 
require_once'../inc.func.php';
$cm->get_header("../");
if(!empty($_POST['subject']))
{
	echo $marketing->bulk_emails();
	exit;
}
$msg="";
if(isset($_GET['msg']))
{
	$msg=$_GET['msg'];
}
?>
<style type="text/css">
.select2-container .select2-selection--single {
	box-sizing: border-box;
	cursor: pointer;
	display: block;
	height: 30px;
	user-select: none;
	-webkit-user-select: none;
	border-radius: 0px;
}
.cke_contents {
	height: 300px !important;
}
</style>
<script>
    document.title = 'Address Book';
</script>
<body onLoad="">
<?php $cm->loader(); ?>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <!--==============alert-message========-->
  <?php
  if($msg==2){
  echo '
  		 <div class="alert alert-success alert-dismissable col-md-4 col-md-offset-3">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4>	<i class="icon fa fa-check"></i> Alert!</h4>
			Contacts Import Successfully.....
		 </div>	
  		';
  }
  else if($msg==1)
  {
	  echo '<div class="alert alert-danger alert-dismissable col-md-4 col-md-offset-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    Something Wrong With Your Query.....
                  </div>';
  }
   ?>
  <!--==============alert-message========-->
  <div class="clearfix"></div>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading"> Import Contacts</span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="proc" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="col-md-2">
            <select class="form-control input-sm" name="group_id">
            	<option value="">Select</option>
                <?php echo $marketing->e_mar_group() ?>
            </select>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label class="col-sm-3 control-label">Upload File </label>
              <div class="col-sm-6">
                <input type="file" name="file_name">
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label class="col-sm-2 control-label" style="visibility:hidden">Focused </label>
              <div class="col-sm-6">
                <a href="excel-sample/excel-file.xlsx" class="btn btn-link" download>Download Sample Excel File</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-12">
          	<button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-file"></i> Import</button>
          </div>
        </form>
      </div>
      <!--panel panel-default--> 
    </div>
    <!--panel-body--> 
  </section>
</div>
<!-- container--> 
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<script type="text/javascript">
	$(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
</script>
<?php 
$cm->get_footer("../")
?>
