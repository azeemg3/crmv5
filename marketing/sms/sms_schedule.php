<?php 
require_once'../../inc.func.php';
$cm->get_header("../../");
?>
<script>
document.title='Send Sms In Group';
</script>
<div class="content-wrapper">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
  <h1> Dashboard <small>Control panel</small> </h1>
  <ol class="breadcrumb">
    <li><a href="../../index"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="../../index">Dashboard</li>
    <li class="active">Sms</li>
  </ol>
</section>
<section class="content">
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"> <span class="main-heading">Send Sms In Schedule</span></h2>
  <div class="panel panel-default" style="border-radius:0px;">
  <p align="center">Your Remaining Sms Are <span style="font-weight:bold;" class="text-danger">
    <?php //echo $xml->response; ?>
    </span></p>
  <hr>
  <div class="col-md-4 col-md-offset-4" id="get_group_sms"></div>
   <?php echo $msg->return_msg() ?>
  <div class="clearfix"></div>
  <div class="panel-body">
  <form method="post" action="save_sms_schedule">
    <input type="hidden" name="type" value="group_sms">
    <div class="col-md-4">
      <div class="form-group">
      	<label>Select Marketing Group</label>
        <select class="form-control input-sm" name="gId" onChange="count_group_sms(this.value)">
          <option value="">Select Group</option>
          <?php echo $marketing->e_mar_group(); ?>
        </select>
      </div>
    </div>
    <!--col-md-2-->
    <div class="col-md-2">
      <div class="form-group">
      	<label>Schedule Date</label>
        <input type="text" class="date form-control input-sm" name="schedule_date" placeholder="Schedule Date" autocomplete="off">
      </div>
    </div>
    <!--col-md-4-->
    <div class="col-md-2"> 
      <!-- time Picker -->
      <div class="bootstrap-timepicker">
        <div class="form-group">
          <label>Time</label>
          <div class="input-group">
            <input type="text" class="form-control timepicker input-sm" name="time" autocomplete="off">
            <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
          </div>
          <!-- /.input group --> 
        </div>
        <!-- /.form group --> 
      </div>
    </div>
    <!--col-md-2-->
    <div class="col-md-2">
		<div class="form-group">
         <label>Sms Limt From</label>
         <input type="number" name="limit_frm" class="form-control input-sm">
        </div>    
    </div>
    <!--col-md-2-->
    <div class="col-md-2">
		<div class="form-group">
         <label>Total Sms</label>
         <input type="number" name="total_sms" class="form-control input-sm">
        </div>    
    </div>
    <!--col-md-2-->
    <div class="clearfix"></div>
    <div class="col-md-10">
      <div class="form-group">
        <textarea class="form-control" name="message" id="textarea" placeholder="Message Details" rows="10"></textarea>
        <span id="count"></span>/500 (One Sms Contains <b>160</b> Characters) </div>
    </div>
    <!--col-md-10-->
    <div class="clearfix"></div>
    <div class="col-md-10">
      <div class="form-group">
        <button type="submit"  class="btn btn-primary pull-right">Send Sms </button>
      </div>
    </div>
    </form>
    </div>  
  <!--panel-body-->
  </div>
  <!--panel panel-default--> 
</section>
</div>
<!-- container--> 
<?php $cm->get_footer("../../"); ?>
<script type="text/javascript">
var el_t = document.getElementById('textarea');
//var length = el_t.getAttribute("maxlength");
var el_c = document.getElementById('count');
//el_c.innerHTML = length;
el_t.onkeyup = function () {
  document.getElementById('count').innerHTML =(this.value.length);
};
function send_sms()
{
	x=confirm('Are you Sure?');
	if(!x)
	{
		return false;
	}
	$(".btn-primary").html('Sending <i class="fa fa-refresh fa-spin"></i>');
	$.ajax({
		url:"ajax_requests/send_sms",
		type:"POST",
		data:$("#form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data['code']=='201')
			{
				alert(data['message']);
				$(".btn-primary").html('Send');
			}
			else
			{
				$(".btn-primary").addClass("btn-success").html("sent");
			}
		}
	});
}
</script> 
