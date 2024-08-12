<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<script>
document.title='Sale Report';
</script>
<body onLoad="call_ajax('ajax_call/get_daily_sale_rep', 'form', 'get_spo_d_sr')">
<div class="content-wrapper" id="loadpage">

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
<h2 class="bg-green-gradient text-center" style="margin:0px;padding:10px 0px;">
<span class="main-heading">Daily Sale Reports</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <form id="form" target="_blank" action="print_dsr.php" method="post">
  <div class="col-md-2">
  	<div class="form-group">
    	<input type="text" class="form-control input-sm date" name="dt_frm" placeholder="Date From">
    </div>
  </div>
   <div class="col-md-2">
  	<div class="form-group">
    	<input type="text" class="form-control input-sm date" name="dt_to" placeholder="Date To">
    </div>
  </div>
   <div class="col-md-2">
  	<div class="form-group">
    	<button type="button" class="btn btn-sm btn-primary" onClick="call_ajax('ajax_call/get_daily_sale_rep', 'form', 'get_spo_d_sr')"><i class="fa fa-search"></i> Search</button>
        <button type="submit" class="btn btn-default btn-sm">
          	<span class="glyphicon glyphicon-print"></span> Print
        </button>
    </div>
  </div>
  </form>
  <table class="table table-bordered table-striped">
    <thead>
      <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th title="Lead Id">L.Id</th>
                <th>Issue Date</th>
                <th>Time</th>
                <th title="Ticket No">T.N</th>
                <th title="Receipt No">R.N</th>
                <th title="Supplier Name">S.Name</th>
                <th>Passenger</th>
                <th>Sector</th>
                <th>A/c Details</th>
                <th>Spo</th>
                <th>Received</th>
                <th>Net</th>
                <th>PSF</th>
            </tr>
    </thead>
    <tbody class="get_spo_d_sr">
    	
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
<?php
 $cm->get_footer("")
  ?>