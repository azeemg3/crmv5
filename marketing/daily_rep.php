<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
    document.title = 'Address Book';
</script>
<body onLoad="call_ajax('ajax_call/get_bde_spo_reports', 'form', 'get_bde_spo_reports')">
<?php echo $cm->loader('../'); ?>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">
  	BDE Reports (<?php echo $cm->u_value("user", "name", "id=".$_SESSION['sessionId'].""); ?>)
  </span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="form">
      <input type="hidden" name="spo" value="<?php echo $_SESSION['sessionId'] ?>">
        <div class="col-md-2">
         <div class="form-group">
         	<input type="text" name="date_frm" class="date form-control input-sm" placeholder="Date From">
         </div>
        </div>
        <!--col-md-3-->
        <div class="col-md-2">
         <div class="form-group">
         	<input type="text" name="date_to" class="date form-control input-sm" placeholder="Date To">
         </div>
        </div>
        <!--col-md-3-->
        <div class="col-md-2">
       	 <div class="form-group">
         	<select class="form-control input-sm" name="per_page">
            	<option value="">--Show Rec--</option>
            	<?php echo $cm->show_rec(); ?>
            </select>
         </div>
        </div>
        <div class="col-lg-2 row">
          <div class="form-group">
            <button type="button"  class="btn btn-primary btn-sm" 
            onClick="call_ajax('ajax_call/get_bde_spo_reports', 'form', 'get_bde_spo_reports')"><i class="fa fa-search"></i> search</button>
            <button type="reset"  class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</button>
          </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
          <button type="submit" class="btn btn-sm btn-default" formaction="bde_spoRep_print" formmethod="post" formtarget="_blank" data-toggle="tooltip" title="Print"> 
          <i class="glyphicon glyphicon-print"></i></button>
        </div>
      </form>
      <span class="clearfix"></span>
      <div class="table-responsive">
        <div class="col-lg-2">
          <div class="form-group"> </div>
        </div>
        <!-- col-lg-2-->
        <table class="table table-bordered table-striped" style="font-size:13px;">
          <thead>
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
              <th>#</th>
              <th>Date</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Tech</th>
              <th>Gender</th>
              <th>Customer Type</th>
              <th>Area</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="get_bde_spo_reports">
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
