<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Day Book Reports';
</script>
<body onLoad="loadpage()">
<div class="clearfix"></div>
<div class="modal fade" id="db_pc" role="dialog">
    <div class="modal-dialog" style="width:70%;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title" align="center">Day Book-><span id="db_dt"></span> </h2>
          <p>
          	<div class="col-lg-3">
            	Branch: <span id="branchName"></span>
            </div>
            <div class="col-lg-6 pull-right">
            	<button type="button" class="btn btn-success btn-sm" id="p_id" value="" onClick="quo_print()">
          			<span class="glyphicon glyphicon-print"></span> Print
        		</button>
        	</div>
            <!--col-lg-6-->
            <!--end-emai model-->          
            <div class="clearfix"></div>
              <div class="panel panel-default topmargin-five">
              <div id="visa_hide">
				<h4 class="grey-heading">Amount In
                </h4>
                <table class="table table-bordered table-striped">
                	<thead>
                    	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                        	<th>User </th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Payment Details</th>
                            <th>Amount In</th>
                        </tr>
                    </thead>
                    <tbody id="amountIN_data">
                    </tbody>
                </table>   
                </div>
                <div id="acc_hide">
                <h4 class="grey-heading">Amount out
                </h4>
                <table class="table table-bordered table-striped">
                	<thead>
                    	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                        	<th>User </th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Payment Details</th>
                            <th>Amount Out</th>
                        </tr>
                    </thead>
                    <tbody id="amountOUT_data">
                    </tbody>
                </table>    
                </div>
                    <table class="table table-bordered table-striped">
                    <tr>
                    	<thead>
                    	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                        	<th>Brought Farward </th>
                            <th>Amount In</th>
                            <th>Amount Out</th>
                            <th>Closing Amount</th>
                        </tr>
                    </thead>
                    <tbody id="closeDB">
                    </tbody>
                </table> 
                                     
              </div>
              <!--panel-default-->
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Payment day book details-->
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Day Book Reports</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php echo $cm->go_back() ?>
        	<div class="col-lg-2">
            	<div class="form-group">
                	<label for="exampleInputName2">Date From</label>
                    <input type="text" name="frm_dt" class="form-control date input-sm">
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label for="exampleInputName2">To</label>
                    <input type="text" name="to_dt" class="form-control date input-sm" >
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label for="exampleInputName2">Branch</label>
                    <select class="form-control input-sm" name="branch" >
                        <option value="0">Select...</option>
                        <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                    </select>
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group" style="margin-top:15%;">
                	<button type="button" class="btn btn-primary btn-sm" value="Search" >
                    <i class="fa fa-search"></i> Search</button>
                    <button type="reset" class="btn btn-default btn-sm" value="Reset">Reset</button>
                    
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group" style="margin-top:15%;">
                	<button type="button" class="btn btn-default btn-sm" >
          <span class="glyphicon glyphicon-print"></span> Print
        </button>
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
        	<div class="clearfix"></div>
        	<div class="table-responsive" id="dvData">
  			<table class="table table-bordered table-striped" id="lead_print">
            	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;">
                    <th>#</th>
                    <th>Date</th>
                    <th>Brought Forward</th>
                    <th>Amount In</th>
                    <th>Amount Out</th>
                    <th>Closing</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>
                <tbody id="get_payViewCB">
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
