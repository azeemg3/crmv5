<?php 
require_once'../../inc.func.php';
$cm->get_header("../../");
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
<script>
document.title='Send Sms In Group';
</script>
<div class="content-wrapper">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;">
    <span class="main-heading">Send Sms In Groups</span></h2>
	<div class="panel panel-default" style="border-radius:0px;">
    <p align="center">Your Remaining Sms Are <span style="font-weight:bold;" class="text-danger"><?php echo $xml->response; ?></span></p>
    <hr>
  		<div class="panel-body">
        <form id="form">
        <input type="hidden" name="type" value="group_sms">
  			<div class="col-md-4">
             <div class="form-group">
              <select class="form-control input-sm" name="gId">
               <option value="">Select Group</option>
               <?php echo $marketing->e_mar_group(); ?>
              </select>
             </div>
            </div><!--col-md-2-->
            <div class="clearfix"></div>
            <div class="col-md-10">
             <div class="form-group">
             <textarea class="form-control" name="message" id="textarea" placeholder="Message Details" rows="10"></textarea>
             <span id="count"></span>/500 (One Sms Contains <b>160</b> Character)
             </div>
            </div><!--col-md-10-->
            <div class="clearfix"></div>
            <div class="col-md-10">
             <div class="form-group">
              <button type="button" onClick="send_sms()" class="btn btn-primary pull-right">Send Sms </button>
             </div>
            </div>
		</div>
        </form>
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

 