<?php
require_once'inc.func.php';
$cm->get_header("");
$status="";
if(isset($_GET['status']) && $_GET['status']!=="update")
{
	$status=$_GET['status'];	
}
?>
<script>
    document.title = 'Feedback List';
</script>
<body onLoad="call_ajax('ajax_call/get_feedbackList', 'form', 'get_feedbackList')">
<div class="content-wrapper">
<?php echo $cm->loader() ?>
  <section class="content-header" style="padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lead Feedback List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <form id="form" action="prints/feedback-print" method="post" target="_blank">
          <div class="col-md-2">
           <div class="form-group">
            <input type="text" class="form-control input-sm date" placeholder="Date From" name="df" autocomplete="off" value="<?php echo $cm->today(); ?>">
           </div>
          </div><!--col-md-2-->
          <div class="col-md-2">
           <div class="form-group">
            <input type="text" class="form-control input-sm date" placeholder="Date To" name="dt" autocomplete="off" value="<?php echo $cm->today(); ?>">
           </div>
          </div><!--col-md-2-->
          <div class="col-md-2">
           <div class="form-group">
            <select class="form-control input-sm" name="spo">
                <option value="">Select Spo</option>
                <?php echo $cm->spo("", $_SESSION['branch_id']); ?>
            </select>
           </div>
          </div><!--col-md-2-->
          <div class="col-md-2">
           <div class="form-group">
            <select class="form-control input-sm" name="per_page">
              <?php echo $cm->show_rec(); ?>
            </select>
           </div>
          </div><!--col-md-2-->
          <div class="col-md-2">
           <div class="form-group">
            <button  type="button"class="btn btn-sm btn-info" onClick="call_ajax('ajax_call/get_feedbackList', 'form', 'get_feedbackList')"> <i class="fa fa-search"></i>Search</button>
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button>
           </div>
          </div><!--col-md-2-->
          </form>
            <div class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12 table-responsive">
                  <table id="example2" class="table table-bordered table-hover text-center">
                    <thead>
                      <tr role="row">
                        <th>Lead Id</th>
                        <th>Customer Name</th>
                        <th>Spo</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Feedback</th>
                        <th>Feedback Time</th>
                        <th>Working Since</th>
                      </tr>
                    </thead>
                    <tbody class="get_feedbackList"></tbody>                  
                  </table>
                </div>
                <!--col-sm-12-->
              </div>
              
            </div>
          </div>
          <!-- /.box-body --> 
        </div>    
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
  </section>
</div>
<!-- container-->
<?php

    $cm->get_footer("")
    ?>

