<?php 
require_once'inc.func.php';
$cm->get_header("");
	  	$type = "xml";
		$id = "tourvision";
		$pass = "multan381";
		// Data for text message
		$message = "Test with an ampersand (&) and a 5 note";
		$message = urlencode($message);
		// Prepare data for POST request
		$data = "id=".$id."&pass=".$pass."&type=".$type;
		// Send the POST request with cURL
		$ch = curl_init('http://sms4connect.com/api/sendsms.php/balance/status');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); //This is the result from SMS4CONNECT
		$xml=simplexml_load_string($result) or die("Error: Cannot create object");
		curl_close($ch);
?>
<body onLoad="call_ajax('marketing/ajax_call/get_mobile_address', '', 'get_mobile_address')">
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
              <textarea name="message" id="textarea" class="form-control" rows="6" maxlength="500"></textarea>
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
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">
  Mobile Contacts</h2>
  <div class="col-md-2 pull-right">Sms Balance:<?php echo ($xml->response); ?></div>
  <div class="clearfix"></div>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="form">
        <div class="col-sm-2">
          <div class="form-group">
            <select class="form-control input-sm selected_branch" name="branch" title="Select Branch">
              <option value="0">Select...</option>
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
        <div class="col-sm-2">
          <div class="form-group">
            <input type="text" name="name" class="form-control input-sm" placeholder="Search With Name" />
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-sm-2">
          <div class="form-group">
            <input type="text" class="form-control input-sm" name="phone" placeholder="Search With Phone" />
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-sm-2">
          <div class="form-group">
            <select class="form-control input-sm" name="group_id">
             <option value="">Select Group</option>
             <?php echo $marketing->e_mar_group(); ?>
            </select>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-sm-1">
          <div class="form-group">
            <button type="button" class="btn btn-sm btn-primary" onClick="call_ajax('marketing/ajax_call/get_mobile_address', 'form', 'get_mobile_address')"><i class="fa fa-search"></i> Search</button>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-sm-1">
          <div class="form-group">
            <button type="button" class="btn btn-sm btn-success" onClick="sel_add_book_mobile()"> <i class="fa fa-envelope" aria-hidden="true"></i> Send SmS</button>
          </div>
        </div>
      </form>
      <div class="clearfix"></div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
              <th><input id="checkAll" type="checkbox" name="checkAll[]" value=""></th>
              <th>#</th>
              <td>Name</td>
              <td>Phone</td>
              <td>Gender</td>
              <td>Area</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody class="get_mobile_address">
          </tbody>
        </table>
      </div>
    </div>
    <!--panel panel-default--> 
  </div>
  <!--panel-body--> 
</div>
<!-- container-->
<?php $cm->get_footer("") ?>
<script>
$("#checkAll").click(function () {
	if($('input:checkbox').not(this).prop('input:unchecked', this.checked).length<4500)
	{
     	$('input:checkbox').not(this).prop('checked', this.checked);
	}
	else
	{
		alert("You Are Exceeding The Limit 400");
	}
 });
 
 var el_t = document.getElementById('textarea');
//var length = el_t.getAttribute("maxlength");
var el_c = document.getElementById('count');
//el_c.innerHTML = length;
el_t.onkeyup = function () {
  document.getElementById('count').innerHTML =(this.value.length);
};
</script> 