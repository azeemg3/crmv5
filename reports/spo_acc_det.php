<?php
require_once'../common/acc_top.php';
require_once'rep_nav.php';
?>
<body onLoad="acc_call_ajax('get_spo_acc_det', 'form')">
<div class="clearfix"></div>
<div class="container">
<h2><span class="main-heading"><?php echo $c_m->u_value("user", "name", "id=".$_GET['spo'].""); ?> A/C Details</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <form id="form" action="print" method="post" target="_blank">
  <input type="hidden" name="type" value="spo_acc_det">
  <input type="hidden" name="spo" value="<?php echo $_GET['spo'] ?>" />
  <input type="hidden" name="page" value="1">
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Date From:</label>
            <input type="tex" name="frm_dt" class="form-control date">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Date To:</label>
            <input type="tex" name="to_dt" class="form-control date" onChange="acc_call_ajax('get_spo_acc_det', 'form')">
            </div>
        </div>
        <!-- col-lg-2-->
       <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Contact Name:</label>
            <input type="tex" name="contact_name" onkeyup= "acc_call_ajax('get_spo_acc_det', 'form')" class="form-control" >
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <label>Lead No:</label>
            <input type="tex" name="leadId" onKeyUp="acc_call_ajax('get_spo_acc_det', 'form')" class="form-control">
            </div>
        </div>
        <!-- col-lg-2-->
        <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <button type="submit" style="margin-top:27px;" class="btn btn-default btn-sm">
          		<span class="glyphicon glyphicon-new-window"></span> View
       		 </button>
            </div>
        </div>
        <!-- col-lg-2-->
  <table class="table table-bordered table-striped">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th>Lead Id</th>
                <th>Contact Name</th>
                <th>Spo Name</th>
                <th>Total</th>
                <th>Received</th>
                <th>Balance</th>
            </tr>
    </thead>
    <tbody id="get_spo_acc_det">
    </tbody>
    </table>
    </form>
  </div>
</div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
</div>
<!-- container-->
<?php require_once'../common/acc_footer.php'; ?>