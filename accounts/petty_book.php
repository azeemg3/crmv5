<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Petty Book';
</script>
<body onLoad="loadpage()">
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Petty Cash Book</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
            	<thead>
                	<tr>
                    	<td colspan="6"><strong>Petty Cash Book Date:</strong></td>
                    </tr>
                </thead>
                <thead>
                	<tr>
                    	<td colspan="7"><h4 class="main-heading">Amounts In</h4></td>
                    </tr>
                </thead>
            	<thead>
                	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                        <th>User</th>
                        <th>Time</th>
                        <th>Type</th>
                        <th>Payment Details</th>
                        <th>Amount Out</th>
                        <th>Amount In</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <form id="form">
                <tr>
                	<td style="width:20%;">
                    	<select class="form-control input-sm" name="payment_type">
                        	<option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="credit">Credit</option>
                        </select>
                    </td>
                    <td colspan="3"><input type="text" name="details" class="form-control input-sm" placeholder="Enter Payment Details Here" /></td>
                    <td style="width:10%"></td>
                    <td><input type="text" name="amount_in" class="form-control input-sm" placeholder="0.00" /></td>
                    <td style="width:10%;"><input type="reset" value="Amount In" class="btn btn-success" /></td>
                </tr>
                </form>
                <tbody id="amount_in">
                </tbody>
                <thead>
                	<tr>
                    	<td colspan="7"><h4 class="main-heading">Amounts Out</h4></td>
                    </tr>
                </thead>
                <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                       	<th>User</th>
                        <th>Time</th>
                        <th>Type</th>
                        <th>Payment Details</th>
                        <th>Amount Out</th>
                        <th>Amount In</th>
                        <th>Action</th>
                    </tr>
                    <form id="form_o">
                    <tr>
                	<td style="width:20%;">
                    	<select class="form-control" name="payment_type">
                        	<option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="credit">Credit</option>
                        </select>
                    </td>
                    <td colspan="3"><input type="text" name="details" class="form-control input-sm" placeholder="Enter Payment Details Here" /></td>
                    <td width="15%"><input type="text" class="form-control input-sm" name="amount_out" placeholder="0.00" /></td>
                    <td width="10%"></td>
                    <td> 
                    <input type="button" value="Amount Out" class="btn btn-danger" />
                    </td>					
                </tr>
                </form>
                    <tbody id="amount_out">
                    </tbody>
                 <thead>
                	<tr>
                    	<td colspan="7"><h4 class="main-heading">Pending Cheque</h4></td>
                    </tr>
                </thead>
                <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                        <th>User</th>
                        <th>Time</th>
                        <th>Type</th>
                        <th>Payment Details</th>
                        <th>Amount Out</th>
                        <th>Amount In</th>
                        <th>Action</th>
                    </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                <thead>
                	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;">
                        <th>Brought Forward</td>
                        <th>Cash Amount In</td>
                        <th>Cash Amount Out</td>
                        <th>Closing Amount</td>
                    </tr>
                    <tr>
                    	<td><strong><span id="b_f"></span></strong></td>
                        <td><strong><span id="c_in"></span></strong></td>
                        <td><strong><span id="c_out"></span></strong></td>
                        <td><strong><span id="c_a"></span></strong></td>
                    </tr>
                </thead>
                
            </table>
          </div>
          <!-- responsive-->  
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
