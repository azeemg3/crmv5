<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<script>
document.title='All Lead Contact';
</script>
<body onLoad="call_ajax('marketing/ajax_call/get_lead_addresses', 'form', 'get_lead_addresses')">
<?php $cm->loader(); ?>
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
         <div class="col-md-4">
         	<div class="form-group">
            	<label>From</label>
                <input type="text" class="form-control input-sm" name="email_from">
            </div>
         </div>
         <div class="col-md-4" id="lead_email">
         	<div class="form-group">
            	<label>Emails</label>
                <input type="text" class="form-control input-sm" name="emails" id="emails">
            </div>
         </div>
         <div class="clearfix"></div>
          <textarea id="editor1" name="email_text" rows="10" cols="80" style="height:500px;"></textarea>
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
<!--=====================Bulk Email sending pop up==================================-->
<div class="modal fade bulk_email_pop_up"  role="dialog">
  <div class="modal-dialog" style="width:80%;"> 
    <!-- Modal content-->
    <form  id="leadEmailForm">
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
         <div class="col-md-4">
         	<div class="form-group">
            	<label>From</label>
                <input type="text" class="form-control input-sm" name="from_email">
            </div>
         </div>
         <div class="clearfix"></div>
          <textarea id="editor2" name="email_text" rows="10" cols="80" style="height:500px;"></textarea>
        </div>
        <!--modal-body-->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="send_emails('lead_bulk_emails', 'leadEmailForm')">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--=====================Email Bulk Emails pop up--================================-->
<!-- Send unique sms===============================-->
<div class="modal fade"  role="dialog" id="uni_sms">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Message</h4>
        </div>
        <form id="uniForm">
        <div class="modal-body">
         <div class="col-md-6">
          <div class="form-group">
           <label>Subject</label>
           <input type="text" name="subject" class="form-control input-sm">
          </div>
         </div>
         <div class="col-md-6">
         	<div class="form-group">
            	<label>Mobile</label>
                <input type="text" class="form-control input-sm" name="mobile" id="uni_mobile">
            </div>
         </div>
         <div class="col-md-12">
         <div class="form-group">
          <textarea rows="5" id="msgarea" name="message" class="form-control" ></textarea>
          <span id="count"></span>/500
          </div>
        </div>
        <!--modal-body-->
        <div class="modal-footer">
          <input type="button" value="Send" class="btn btn-primary" onClick="uni_sms('sendNow')">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
  </div>
 </div>
</div>
<!-- Send unique sms===============================--> 
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <!-- unique sms pop up-->
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Lead Contacts</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="table-responsive">
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
            <select class="form-control input-sm fetch_spo" name="spo" id="spo">
              <option value="">Select Spo</option>
              <?php echo $cm->spo($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
            </select>
          </div>
        </div>
        <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <input type="text" name="name" class="form-control input-sm" placeholder="Search With Name">
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <input type="text" name="mobile" class="form-control input-sm" placeholder="Search With Phone">
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <input type="text" name="email" class="form-control input-sm" placeholder="Search With Email">
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-md-2">
          	<div class="form-group">
            	<select class="form-control input-sm" name="lead_status">
                	<option value="">Lead Status</option>
                    <?php echo $cm->lead_status(); ?>
                </select>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-2">
          	<div class="form-group">
            	<button type="button"  class="btn btn-primary btn-sm" 
            onClick="call_ajax('marketing/ajax_call/get_lead_addresses', 'form', 'get_lead_addresses')"><i class="fa fa-search"></i> search</button>
            <button type="reset"  class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button>
            </div>
          </div>
          <div class="col-sm-3">
           <div class="form-group">
            <button type="button" class="btn btn-sm btn-info" onClick="send_bulk_emails()">
            <i class="fa fa-envelope"></i> Send Bulk Emails</button>
            <button type="button" class="btn btn-sm btn-info"
            onClick="sel_add_book_mobile()"><i class="fa fa-comment"></i> Send Sms</button>
           </div>
          </div>
        </form>
        <table class="table table-bordered table-striped">
          <thead>
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
              <th>#
                <input type="checkbox" id="checkAll"></th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Spo</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="get_lead_addresses">
          </tbody>
        </table>
      </div>
    </div>
    <!--panel panel-default--> 
  </div>
  <!--panel-body--> 
</div>
<!-- container-->
<?php 
//$cm->get_footer("")
?>
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
<script>
$("#checkAll").click(function () {
	if($('input:checkbox').not(this).prop('input:unchecked', this.checked).length<6000)
	{
     	$('input:checkbox').not(this).prop('checked', this.checked);
	}
	else
	{
		alert("You Are Exceeding The Limit 400");
	}
 });
 
 var el_t = document.getElementById('msgarea');
//var length = el_t.getAttribute("maxlength");
var el_c = document.getElementById('count');
//el_c.innerHTML = length;
el_t.onkeyup = function () {
  document.getElementById('count').innerHTML =(this.value.length);
};
</script> 
