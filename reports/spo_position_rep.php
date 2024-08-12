<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Lead Reports';
</script>
<?php $cm->loader("../"); ?>
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 class="bg-green-gradient text-center" style="margin:0px;padding:10px 0px;"><span class="main-heading">Spo Position Reports</span></h2>
    <div class="panel panel-default">
    <form id="form" action="print" target="_blank" method="post">
    <input type="hidden" name="file" value="spo_position" /> 
      <div class="panel-body"> <?php echo $cm->go_back(); ?>
        <div class="clearfix"></div>
        <div class="col-lg-2">
          <div class="form-group">
            <input type="text" name="df" class="form-control date input-sm" placeholder="Date From">
          </div>
          <!-- form-group--> 
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <input type="text" name="dt" class="form-control date input-sm" placeholder="Date To" >
          </div>
          <!-- form-group--> 
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control input-sm selected_branch_rep" name="branch" >
                    <option value="0">Select Branch</option>
                    <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                </select>
            </div>
            <!-- form-group-->
        </div>
        <!-- col-md-2-->
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control input-sm fetch_spo_rep" name="spo" id="spo" >
             <option value="">Select Spo</option>
             <?php echo $cm->spo('', $_SESSION['branch_id']); ?>
            </select>
          </div>
          <!-- form-group--> 
        </div>
        <!-- col-md-2-->
        <div class="col-lg-2">
          <div class="form-group">
            <button type="button" class="btn btn-primary btn-sm" onClick="get_spo_position_rep()">
            <i class="fa fa-search"></i> Search</button>
            <button type="reset" class="btn btn-default btn-sm">Cancel</button>
          </div>
          <!-- form-group--> 
        </div>
        <!-- col-lg-2-->
        <div class="col-md-1 row">
          <div class="form-group">
            <button type="submit" class="btn btn-default btn-sm" > <span class="glyphicon glyphicon-print"></span> Print </button>
          </div>
          <!-- form-group--> 
        </div>
        <!-- col-lg-2-->
        <div class="clearfix"></div>
        <div class="table-responsive" id="dvData">
          <table class="table table-bordered table-striped" id="lead_print">
            <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset; margin-top:20px;">
              <th>Lead Id</th>
              <th>Client Name</th>
              <th>Opening Balance On</th>
              <th>Invoice</th>
              <th>Void Refund</th>
              <th>Debit Note</th>
              <th>Receipts</th>
              <th>Payments</th>
              <th>Closing Balance On</th>
            </tr>
            <tbody id="get_spo_position_rep">
            </tbody>
          </table>
        </div>
        <!-- table-responsive--> 
      </div>
      <!--panel panel-default-->
      </form>
    </div>
    <!--panel-body--> 
  </section>
</div>
<!-- container-->
<?php 
$cm->get_footer("../");
?>
