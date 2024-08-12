<?php 
require_once'../inc.func.php';
$cm->get_header("../");
require_once'modal_inv_no.php';
require_once'../tourSale/acc_tour_inv_det.php';
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
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
</style>
<script>
document.title='Ledger A/C';
</script>
<body onLoad="get_acc_ledger()">
<!--============================Success modal===========================-->
    <div class="modal fade" id="success-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="col-sm-12">
              <div class="alert alert-success alert-dismissable">
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    Opration Successfull..............<a href="" class="btn btn-link">Add New</a>
                  </div>
            </div>
      </div>
    </div>
    <!--============================Success modal===========================-->
    <!--============================Error modal===========================-->
    <div class="modal fade" id="error-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="alert alert-danger alert-dismissable">
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    Aging Amount Exceeding The Receipt Amount...
                  </div>
      </div>
    </div>
    <!--============================Error modal===========================-->
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">
    Sale Invoice Aging
    </span></h2>
<div class="panel panel-default">
  <div class="panel-body">
   <form id="form">
        <div class="col-md-2">
            <div class="form-group">
             <input type="text" name="tp_rv" class="form-control input-sm" placeholder="TP-RV-NUMBER" onChange="acc_fetch_rec_amount(this.value)">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-md-2">
            <div class="form-group">
             <input type="text" name="rec_amount" class="form-control input-sm" placeholder="Receipt Amount" id="acc_rec_amount">
            </div>
        </div>
        <!-- col-lg-2-->
   <div class="clearfix"></div>
   <div class="acc_multiple_rec">
                    <div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Invoice Number / Ref No. </label>
                          <input class="form-control input-sm acc_fetch_sale_inv" name="refrence[]" type="text" placeholder="Invoice Number">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Amount *</label>
                          <input class="form-control input-sm get_inv_amount" name="amount[]"  id="rec_amount"  type="text" placeholder="Amount *">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-md-1">
                    	<label style="visibility:hidden">Tourvision</label>
                        <button type="button" class="btn btn-sm btn-primary multiple_rec_app"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                   </div>
                   <!--multiple record-->
                   <div class="clearfix"></div>
                   <div class="col-md-8">
                    <button class="btn btn-sm btn-info pull-right" onClick="save_aging_inv()" type="button">Submit</button>
                   </div>
     </form>
</div>
<!--panel panel-default-->

	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
     $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
	  function get_services()
	  {
		services=$(".select2-selection__choice").text();
		service=services.replace(/×/g, ",");
		cus_ser=service.substring(1);
		$("#services").val(cus_ser);
	  }
    </script>
 <?php 
$cm->get_footer("../");
?>
