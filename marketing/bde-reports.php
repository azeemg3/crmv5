<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script> 
<script>
    document.title = 'BDE Reports';
</script>
<body onLoad="call_ajax('ajax_call/get_bde_reports', 'form', 'get_bde_reports')">
<?php echo $cm->loader('../'); ?>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">BDE Reports</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="form">
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control input-sm cselected_branch" name="branch" title="Select Branch">
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
        <div class="col-lg-2 row">
          <div class="form-group">
            <button type="button"  class="btn btn-primary btn-sm" 
            onClick="call_ajax('ajax_call/get_bde_reports', 'form', 'get_bde_reports')"><i class="fa fa-search"></i> search</button>
            <button type="reset"  class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <button type="submit" class="btn btn-sm btn-default" formaction="bde_rep_print" formmethod="post" formtarget="_blank" data-toggle="tooltip" title="Print"> 
          <i class="glyphicon glyphicon-print"></i></button>
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
              <th>#</th>
              <th>BDE</th>
              <th>Branch</th>
              <th>Total Record</th>
              <th width="12%">Action</th>
            </tr>
          </thead>
          <tbody class="get_bde_reports">
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
$cm->get_footer("../")
?>
<script>
$(".cselected_branch").on("change", function()
{
	$.ajax({
		url:"../ajax_call/search_spo?branch_id="+$(this).val(),
		success: function(data)
		{
			$(".fetch_spo").html('<option value="">--Select--</option>'+data);
		}
	});
});
 
</script> 
