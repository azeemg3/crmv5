<?php 
require_once'../inc.func.php';
$cm->get_header("../");
require_once'modal_inv_no.php';
require_once'../tourSale/acc_tour_inv_det.php';
require_once'view_modals/ticket_view.php';
require_once'view_modals/other_sale_view.php';
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
?>
<script>
document.title='Sale Report';
</script>
<body onLoad="acc_get_sale_rep()">
<div class="content-wrapper">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Sale Reports</span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
        <form id="form" target="_blank" action="print.php" method="post">
          <input type="hidden" name="type" value="sale" >
          <input type="hidden" name="page" value="1">
          <div class="col-lg-2">
            <div class="form-group">
              <input type="tex" name="frm_dt" class="form-control date input-sm" placeholder="Date From">
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <input type="tex" name="to_dt" class="form-control date input-sm" placeholder="Date To">
            </div>
          </div>
          <!-- col-lg-2--> 
          <!-- col-lg-2-->
          <div class="col-lg-1">
            <div class="form-group row">
              <input type="tex" name="air_code" class="form-control input-sm"  placeholder="code">
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group row">
              <input type="tex" name="ticket_no" class="form-control input-sm" placeholder="Ticket No">
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <input type="text" name="passport_num" placeholder="Enter Passport" class="form-control input-sm">
            </div>
          </div>
          <!---col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <select class="form-control input-sm" name="branch"  onChange="acc_get_sale_rep()">
                <option value="0">Select...</option>
                <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
              </select>
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-2">
            <div class="form-group">
              <select class="form-control input-sm" name="spo" id="spo" >
                <option value="">Select Spo</option>
              </select>
            </div>
          </div>
          <!-- col-lg-2-->
          <div class="col-lg-4">
            <div class="form-group">
              <button type="button" class="btn btn-primary btn-sm"  onClick="acc_get_sale_rep()"><i class="fa fa-search"></i> Search</button>
              <button type="Reset" class="btn btn-default btn-sm">Cancel</button>
              <button type="submit"  class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-new-window"></span> View </button>
            </div>
          </div>
          <!-- col-lg-2-->
        </form>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped" style="font-size:12px;">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th><span data-toggle="tooltip" data-placement="top" title="Lead Id">L.Id</span></th>
                <th width="12%">Issue Date</th>
                <th width="15%">Time</th>
                <th><span data-toggle="tooltip" data-placement="top" title="Ticket No">T.N</span></th>
                <th title="Receipt No">Invoice No</th>
                <th title="Supplier Name">Gds/S.Name</th>
                <th>Passenger</th>
                <th>Sector</th>
                <th>A/c Details</th>
                <th>Spo</th>
                <th>Received</th>
                <th>Net</th>
                <th>PSF</th>
              </tr>
            </thead>
            <tbody id="acc_get_sale_report">
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
$cm->get_footer("../");
?>
