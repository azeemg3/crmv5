<?php 
require_once'inc.func.php';
$cm->get_header();
?>
<script>
document.title='Account Statement';
</script>
<bodyx>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 class="text-center bg-green-gradient" style="margin:0px;padding:10px 0px;"><span class="main-heading">
    	Account Statement
    </span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
      <form id="form" action="print_client_stat" target="_blank" method="post" >
      	<div class="col-md-2">
        	<input type="text" class="form-control input-sm date" name="dt_frm" placeholder="Date From">
        </div>
        <div class="col-md-2">
        	<input type="text" class="form-control input-sm date" name="dt_to" placeholder="Date To">
        </div>
      	<div class="col-md-2">
            	<input type="text" name="leadId" class="form-control input-sm" placeholder="Lead Number">
        </div>
        <!--col-md-2-->
        <div class="col-md-2">
        	<button type="button" class="btn btn-sm btn-primary" onClick="client_acc_satatment()"><i class="fa fa-search"></i> Search</button>
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button>
        </div>
        </form>
        <div class="clearfix"></div>
        <div class="table-responsive">
        	<h4 align="center" id="client_name"></h4>
          <table class="table table-bordered table-striped" style="font-size:12px;">
            <thead>
            	<tr>
                	<td colspan="8" align="center" style="padding:0px;"><h4>Invoices</h4></td>
                </tr>
                <tr class="bg-green-gradient" style=" box-shadow:0px 0 1px #777 inset;">
                 <th>Date</th>
                 <th>Invoice Number</th>
                 <th>Passenger Name</th>
                 <th>Ticket Number</th>
                 <th>Sector</th>
                 <th>Fare</th>
                 <th>Taxes</th>
                 <th>Net Amount</th>
                </tr>
            </thead>
            <tbody class="ticket_sale">
            </tbody>
          </table>
          <table class="table table-bordered table-striped" style="font-size:12px;">
            <thead>
            	<tr>
                	<td colspan="8" align="center" style="padding:0px;"><h4>Debit Notes</h4></td>
                </tr>
              <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;">
                <th>Date</th>
                <th>Debit Number</th>
                <th>Remarks</th>
                <th>Net Amount</th>
              </tr>
            </thead>
            <tbody class="other_sale"></tbody>
          </table>
          <table class="table table-bordered table-striped" style="font-size:12px;">
            <thead>
            	<tr>
                	<td colspan="8" align="center" style="padding:0px;"><h4>Void/Refund</h4></td>
                </tr>
              <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;">
                <th>Date</th>
                <th>Cr. Note No.</th>
                <th>Invoice Number</th>
                <th>Passenger Name</th>
                <th>Ticket No</th>
                <th>Sector</th>
                <!--<th>Fare</th>
                <th>Taxes</th>-->
                <th>Net Amount</th>
              </tr>
            </thead>
            <tbody class="rfnd"></tbody>
          </table>
          <table class="table table-bordered table-striped" style="font-size:12px;">
            <thead>
            	<tr>
                	<td colspan="8" align="center" style="padding:0px;"><h4>Receipts/Payments</h4></td>
                </tr>
              <tr class="bg-green-gradient" style=" box-shadow:0px 0 1px #777 inset;">
                <th>Date</th>
                <th>Voucher N0.</th>
                <th>Invoice Number</th>
                <th>Remarks</th>
                <th>Receipts(Cr)</th>
                <th>Payments(Dr)</th>
              </tr>
            </thead>
            <tbody class="receipt-payment"></tbody>
          </table>
          <table class="table table-bordered table-striped" style="font-size:12px; width:40%;" align="center">
            <thead>
            	<tr>
                	<td colspan="2" align="center" style="padding:0px;"><h4>Summary</h4></td>
                </tr>
                <tr>
                	<td>Opening Balance:</td>
                    <td><span id="opening_balance">0.00</span></td>
                </tr>
                <tr>
                	<td>(+)Sales:</td>
                    <td><span id="total_sales">0.00</span></td>
                </tr>
                <tr>
                	<td>(+)Debit Notes:</td>
                    <td><span id="debit_note">0.00</span></td>
                </tr>
                <tr>
                	<td><b>Gross Sale</b>:</td>
                    <td><b><span id="gross_sale">0.00</span></b></td>
                </tr>
                <tr>
                	<td>(-)Void/Refund:</td>
                    <td><span id="void-refund">0.00</span></td>
                </tr>
                <tr>
                	<td>Net Sale:</td>
                    <td><span id="net_sale">0.00</span></td>
                </tr>
                <tr>
                	<td>(-)Receipt:</td>
                    <td><span id="payment_receipt">0.00</span></td>
                </tr>
                <tr>
                	<td>(+)Payments:</td>
                    <td><span id="payments">0.00</span></td>
                </tr>
                <tr>
                	<td>Net Receiveable/Payable:</td>
                    <td><span id="net_rec_pay">0.00</span></td>
                </tr>
            </thead>
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
$cm->get_footer();
?>
