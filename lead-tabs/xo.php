<div id="xo" class="tab-pane fade">
      <h3>Add Xo Sale</h3>
      <p><div class="panel panel-default">
      <form  id="xo_form">
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12 row">
            		<div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Branch</label>
                         <select class="form-control input-sm" name="branch" id="branch">
                         <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                		</select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Sales Staff </label>
                          <select class="form-control input-sm" name="salesStaff" id="salesStaff">
                          <?php echo $cm->spo($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                         </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Date of issue:*</label>
                          <input class="form-control date input-sm" name="date_issue" value="<?php echo $cm->today(); ?>" 
                          type="text" placeholder="Date of issue">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Supplier Name:*</label>
                          <input type="text" name="suppl_name" class="form-control suppl_name input-sm" placeholder="Supplier Name">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
          <style>
		  .xo-routing {
						background-color: #cdcccc;
						text-align: center;
					}
          .ten-per {
					float: left;
					width: 10%;
					padding: 5px;
					border-right: 1px solid black;
				}
          .xo-routing-2 {
						padding: 10px;
					}
		  .ten-per-1 {
						float: left;
						width: 10%;
						padding: 5px !important;
					}
          </style>
                    <div class="clearfix"></div>
  <div class="col-lg-12 col-sm-12 row xo-routing">
      <div class="ten-per"><strong>Routing</strong></div>
      <div class="ten-per"><strong>Fare Basis</strong></div>
      <div class="ten-per">Carrier</strong></div>
  	  <div class="ten-per"><strong>Flight No</strong></div>
      <div class="ten-per"><strong>Class</strong></div>
      <div class="ten-per"><strong>Date</strong></div>
      <div class="ten-per"><strong>Dep Time</strong></div>
      <div class="ten-per"><strong>Ar Time</strong></div>
      <div class="ten-per"><strong>Status</strong></div>
      <div class="ten-per"><strong>Air Line Data</strong></div>
 </div>
 <!--col-lg-12-->
 <div class="col-lg-12 col-sm-12 row xo-routing-2" id="addFlight">
	  <div class="ten-per-1">
		<input type="text" style="width: 50%;" name="flight_frm[]"><input type="text" style="width: 50%;" name="flight_to[]">
     </div>
	<div class="ten-per-1">
		<input type="text" style="width: 100%;" name="fare_bais[]">
	</div>
	<div class="ten-per-1">
		<input type="text" style="width: 100%;" name="carrier[]">
	</div>
	<div class="ten-per-1">
		<input type="text" style="width: 100%;" name="flightNo[]">
	</div>
	<div class="ten-per-1">
		<input type="text"  style="width: 100%;" name="class[]">
	</div>
    <div class="ten-per-1">
        <input type="text" class="date" name="xo_date[]"  style="width: 100%;
    ">
    </div>
    <div class="ten-per-1">
        <input type="text" name="dep_time[]"  style="width: 100%;">
    </div>
    <div class="ten-per-1">
        <input type="text" name="ar_time[]" style="
        width: 100%;
    ">
    </div>
    <div class="ten-per-1">
        <input type="text" name="status[]" style="width: 100%;">
	</div>
	<div class="ten-per-1">
	<input type="text" style="width:68%;" name="airLine_data[]">
	<input type="button"  onClick="flight_details()" value="+">
	</div>
	<div class="clearfix"></div>
    
</div>
<!--col-lg-12-->
					<div class="clearfix"></div>
                    <div class="col-lg-6 xo-routing">
                    	<div class="col-sm-6"><strong>Name Of Passenger</strong></div>
                        <div class="col-sm-6"><strong>Passport Details</strong></div>                        
                    </div>
                    <!--col-lg-6 xo-routing-->
                    <div class="clearfix"></div>
                    <div class="col-lg-6 col-sm-6 xo-routing-2" id="addPass">
                    	<div class="col-sm-5">
                        	<input class="form-control input-sm" type="text" name="passName[]">
                        </div>
                        <div class="col-sm-5">
                        	<input type="text"  name="pass_detail[]" class="form-control input-sm">
                        </div>  
                        <input type="button" class="btn" onClick="addPass()" value="+">
                    </div>
                    <!-- col-lg-6 xo-routing-2-->
                    <div class="col-lg-4 pull-right panel panel-default">
                    	<div class="form-group">
                          <label>Basic Fare</label>
                          <input type="text" class="form-control basic_fare input-sm" name="basic_fare" onChange="xoSum()" placeholder="Basic Fare">
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control tax1 input-sm" placeholder="Tax1" name="tax1" onChange="xoSum()">
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control tax2 input-sm" placeholder="Tax2" name="tax2" onChange="xoSum()">
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control tax3 input-sm" placeholder="Tax3" name="tax3" onChange="xoSum()">
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control tax4 input-sm" placeholder="Tax4" name="tax4" onChange="xoSum()">
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control tax5 input-sm" placeholder="Tax5" name="tax5" onChange="xoSum()">
                       </div>
                       <div class="form-group">
                          <label>Total</label>
                          <input type="text" name="total" id="total" class="form-control total input-sm" onChange="xoSum()" placeholder="Total">
                       </div>
                       <div class="form-group">
                          <label>Incentive</label>
                          <input type="text" name="incentive" class="form-control incentive input-sm" onChange="xoSum()" placeholder="Incentive">
                       </div>
                       <div class="form-group">
                          <label>Commission</label>
                          <input type="text" name="commission" class="form-control commission input-sm" onChange="xoSum()" placeholder="Commission">
                       </div>
                       <div class="form-group">
                          <label>Net Payable</label>
                          <input type="text" name="net_payable" class="form-control net_payable input-sm" id="net_payable" onChange="xoSum()" placeholder="Net Payable">
                       </div><div class="form-group">
                          <label>Recieved Amount</label>
                         <input type="text" name="rec_amount" class="form-control rec_amount input-sm" placeholder="Recieved Amount">
                       </div>
                    </div>
                    <!-- col-lg-2-->
                    <div class="clearfix"></div>
                    <div class="col-lg-2 col-xs-12 col-sm-3 pull-right">
                    <input type="button" class="btn btn-success col-xs-12 col-sm-12" value="Add Xo" onClick="xo_sale()">
                    </div>
                    </div>
                    <!-- col-lg-12-->
            </div>
            <!-- panel-body-->
            </form>
          </div>
          <!--panel-default-->
          </p>
    </div>