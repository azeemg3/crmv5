<?php 
require_once'inc.func.php';
$cm->get_header("");
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
.cke_contents 
{
	height:300px !important;
}
</style>
 
<script>
    document.title = 'Address Book';
</script>
<body onLoad="call_ajax('ajax_call/get_address_book', 'form', 'get_address_book')">
<!-- successf full message===============================-->
<div class="modal fade modal-pop" id="myModal">
    <div class="modal-dialog"> 
  <!-- Modal content-->
      <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="alert alert-success">	
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Emails Sent Successfully........ 
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">Ok</button>
       </div>
    </div>
  </div>
<!-- successf full message===============================-->
<!--===================system Already in processs--=====================  -->
<div class="modal fade alread-process">
    <div class="modal-dialog"> 
  <!-- Modal content-->
       <div class="alert alert-warning">	
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        System Already in Process........ 
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">Ok</button>
       </div>
    </div>
  </div>
<!--===================system Already in processs--=====================  -->
<!--=====================Bulk Email sending pop up--================================-->
<div class="modal fade bulk_email_pop_up"  role="dialog">
  <div class="modal-dialog" style="width:80%;"> 
    <!-- Modal content-->
    <form id="bulkEmailForm">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Bulk Emails</h4>
        </div>
        <div class="modal-body">
         <div class="col-md-4">
         	<div class="form-group">
            	<label>Subject</label>
                <input type="text" class="form-control input-sm" name="subject" placeholder="Email Subject">
            </div>
         </div>
          <div class="col-md-4">
         	<div class="form-group">
            	<label>From</label>
                <input type="text" class="form-control input-sm" name="from_email" placeholder="Sender Email">
            </div>
         </div>
         <div class="col-md-3">
          <label>Select Image</label>
          <input type="file" id="bulk_upload_email_img" name="img">
         </div>
         <div class="clearfix"></div>
            <textarea id="editor1" name="email_text" rows="10" cols="80" style="height:500px;"></textarea>
        </div>
        <!--modal-body-->
        <div class="modal-footer">
          <input type="button" value="Send" class="btn btn-primary" onClick="send_emails('bulk_emails', 'bulkEmailForm')">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--=====================Bulk Email sending pop up==================================-->
<div class="modal fade sel_email_pop_up"  role="dialog">
  <div class="modal-dialog" style="width:80%;"> 
    <!-- Modal content-->
    <form  id="emailForm">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Emails</h4>
        </div>
        <div class="modal-body">
         <div class="col-md-4">
         	<div class="form-group">
            	<label>Subject</label>
                <input type="text" class="form-control input-sm" name="subject">
            </div>
         </div>
         <div class="col-md-5">
         	<div class="form-group">
            	<label>Emails</label>
                <input type="text" class="form-control input-sm" name="emails" id="emails" autocomplete="off">
            </div>
         </div>
         <!--col-md-8-->
          <div class="col-md-3">
         	<div class="form-group">
            	<label>From</label>
                <input type="text" class="form-control input-sm" name="email_from" id="emails" autocomplete="off" 
                placeholder="Sender Email">
            </div>
         </div>
         <!--col-md-8-->
         <div class="col-md-3">
          <label>Select Image</label>
          <input type="file" id="upload_email_img" name="img">
         </div>
         <div class="clearfix"></div><br>
           <textarea id="editor2" name="details" rows="10" cols="80" style="height:500px;"></textarea>
        </div>
        <!--modal-body-->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="send_emails('sel_email', 'emailForm')">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--=====================Email sending pop up--================================-->
<?php $cm->loader(); ?>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Address Book</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="form">
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control input-sm selected_branch" name="branch" title="Select Branch">
              <option value="0">Select Branch</option>
              <?php echo $cm->branches($_SESSION['sessionId'],$_SESSION['branch_id']); ?>
            </select>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control input-sm fetch_spo select2" name="spo" id="spo">
              <option value="">Select Spo</option>
              <?php echo $cm->spo($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
            </select>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <input type="text" name="name" class="form-control input-sm" placeholder="Search Name" >
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <input type="text" name="phone" class="form-control input-sm" placeholder="Search phone" >
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <input type="text" name="email" class="form-control input-sm" placeholder="Search Email">
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control input-sm" name="group_id">
			 <option value="">Select</option>
             <?php echo $marketing->e_mar_group(); ?>
            </select>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
          	<select name="per_page" class="form-control input-sm">
            <?php echo $cm->show_rec(); ?>
           </select>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <button type="button"  class="btn btn-primary btn-sm" 
            onClick="call_ajax('ajax_call/get_address_book', 'form', 'get_address_book')"><i class="fa fa-search"></i> search</button>
            <button type="reset"  class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-info btn-sm send_bulk_emails" onClick="send_bulk_emails()" style="width:100%;"><i class="fa fa-envelope-o">
            </i> Send Bulk Emails</button>
          </div>
        </div>
        <div class="col-md-2">
         <div class="form-group">
            <button type="button" class="btn btn-info btn-sm" style="width:100% !important;"
            onClick="send_sel_email()"><i class="fa fa-envelope-o"></i> Send Selected Emails</button>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-3">
          <button type="submit" class="btn btn-sm btn-default" formaction="marketing/print" formmethod="post" formtarget="_blank"> <i class="glyphicon glyphicon-print"></i></button>
          <button type="button" class="btn btn-sm btn-default"> <i class="glyphicon glyphicon-download-alt"></i></button>
        </div>
      </form>
      <span class="clearfix"></span>
      <div class="table-responsive">
        <div class="col-lg-2">
          <div class="form-group"> </div>
        </div>
        <!-- col-lg-2-->
        <table class="table table-bordered table-striped">
          <thead>
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
              <th><input id="checkAll" type="checkbox" name="checkAll[]" value=""></th>
              <th>#</th>
              <th>Date</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Tech</th>
              <th>Gender</th>
              <th>Area</th>
              <th width="12%">Action</th>
            </tr>
          </thead>
          <tbody class="get_address_book">
          </tbody>
        </table>
      </div>
    </div>
    <!--panel panel-default--> 
  </div>
  <!--panel-body--> 
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
//$cm->get_footer("")
?>
<script>
$("#checkAll").click(function () {
	if($('input:checkbox').not(this).prop('input:unchecked', this.checked).length<400)
	{
     	$('input:checkbox').not(this).prop('checked', this.checked);
		$(".send_bulk_emails").attr("disabled","disabled");
	}
	else
	{
		alert("You Are Exceeding The Limit 400");
	}
 });
</script> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="bootstrap/js/jquery-ui.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/raphael-min.js"></script>
  <script src="plugins/morris/morris.min.js"></script>
  <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="plugins/knob/jquery.knob.js"></script>
  <script src="plugins/knob/jquery.knob.js"></script>
  <script src="bootstrap/js/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="plugins/fastclick/fastclick.min.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="dist/js/pages/dashboard.js"></script>
  <script src="dist/js/demo.js"></script>
  <script src="js/inc.func.js"></script>
  <script src="js/lead.func.js"></script>
  <script src="js/tourSale.js"></script>
  <script src="js/account.js"></script>
  <script src="js/reports.js"></script>
  <script src="js/admin.func.js"></script>
  <script src="js/marketing.js"></script>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> 
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor2');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
<script type="text/javascript">
  $.noConflict();  
</script>


  