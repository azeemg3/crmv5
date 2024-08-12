<?php 
require_once'../inc.func.php';
$cm->get_header("../");
if(!empty($_POST['subject']))
{
	echo $marketing->bulk_emails();
	exit;
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
</style>
 
<script>
    document.title = 'Address Book';
</script>
<body onLoad="call_ajax('ajax_call/get_email_sent_rep', 'form', 'get_email_sent_rep')">
<?php echo $cm->loader('../') ?>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
  <h2 class="bg-green-gradient text-center" style="block;margin:0px;padding:10px 0px;">
  <span class="main-heading">Email Sent Report</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="form">
        <div class="col-md-2">
        	<input type="text" name="df" class="date input-sm form-control" placeholder="Date From">
        </div>
        <div class="col-md-2">
        	<input type="text" name="dt" class="date input-sm form-control" placeholder="Date To">
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control input-sm selected_branch" name="branch" title="Select Branch">
              <option value="0">Select Branch</option>
              <?php echo $cm->branches($_SESSION['sessionId'],$_SESSION['branch_id']); ?>
            </select>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 row">
          <div class="form-group">
            <button type="button"  class="btn bg-green-gradient btn-sm" 
            onClick="call_ajax('ajax_call/get_email_sent_rep', 'form', 'get_email_sent_rep')"><i class="fa fa-search"></i> search</button>
            <button type="reset"  class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button>
          </div>
        </div>
        <!-- col-lg-2-->
      </form>
      <span class="clearfix"></span>
      <div class="table-responsive">
        <div class="col-lg-2">
          <div class="form-group"> </div>
        </div>
        <!-- col-lg-2-->
        <table class="table table-bordered table-striped">
          <thead>
            <tr class="bg-green-gradient">
              <th>#</th>
              <th>Email</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody class="get_email_sent_rep">
          </tbody>
        </table>
      </div>
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
 
  