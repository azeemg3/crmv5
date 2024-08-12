<div id="ticket" class="tab-pane fade">
      <h3>Add Ticket</h3>
      <p><div class="panel panel-default">
      <form id="ticket_form">
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
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
                          <label>Date of issue*</label>
                          <input class="form-control date input-sm" name="issue_date" value="<?php echo $cm->today(); ?>" type="text" readonly placeholder="Date of issue*">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>GDS </label>
                          <select class="form-control input-sm" name="gds" id="gds">
                				<option value="">Select...</option>
                                <?php echo $cm->gds(); ?>
			                 </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Airlines </label>
                          <select class="form-control input-sm" name="airline_id">
                				<option value="">Select Airline</option>
                                <?php echo $administrator->airlineList(); ?>
			                 </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Stock Used: </label>
                          <select class="form-control input-sm" name="stock_used" id="stock_used" 
                          onchange="other_stock(this.value,'other_stock-t')">
                              <option value="own">Own</option>
                              <option value="other">Other</option>
                		  </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div id="other_stock-t" class="col-md-3" style="display:none;"></div>
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Other Stock Details </label>
                          <input type="text" class="form-control input-sm" name="other_stack" placeholder="Other Stock Details">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                           <div class="col-xs-6 row">
        						<label>Ticket No*</label>
	                            <input class="form-control input-sm" name="airline_code" id="airline_code" maxlength="3" type="text" placeholder="Ticket No*">
                          </div>
                          <div class="col-xs-8 row">
                          		<label>&nbsp;&nbsp;</label>
	                            <input class="form-control input-sm" name="ticket_no" id="ticket_no" maxlength="10" type="text">
                          </div>
                       </div>
                    <!-- form--group-->
                    </div>

                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Sector </label>
                          <input type="text" class="form-control input-sm" name="sector"  placeholder="From To" value="">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    
                    <div class="clearfix"></div>
                    <h3 style="border-top: 1px solid #d2d6de;padding-top: 25px;">Passenger Details:</h3>
                    <div class="col-lg-4 col-sm-3">
                    	<div class="form-group">
                          <label>Passenger Name *</label>
                          <input type="text" class="form-control input-sm" name="passName"  value="" placeholder="Passenger Name*">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-4 col-sm-3">
                    	<div class="form-group">
                          <label>Phone Number </label>
                          <input type="text" name="phone" id="phone" value="<?php echo $row['mobile'] ?>" class="form-control input-sm" placeholder="Phone Number">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-4 col-sm-3">
                    	<div class="form-group">
                          <label>Passenger Type </label>
                          <select class="form-control input-sm" name="passType" id="passType">
                              <option value="adult">Adult</option>
                              <option value="child">Child</option>
                              <option value="infant"> Infant</option>
                         </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <h3 style="border-top: 1px solid #d2d6de;padding-top: 25px;">Amount:</h3>
                     <div class="col-lg-2 col-sm-3">
                    	<div class="form-group">
                          <label>Received </label>
                          <input type="text" name="recieved" id="recieved" class="form-control input-sm" placeholder="Received">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                      <div class="form-group">
                          <label>Basic Fare </label>
                          <input type="text" name="base_fare" id="" class="form-control input-sm basic_fare" 
                          placeholder="Basic Fare" onkeyup="net_cost('ticket_form')">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-2-->
                    <div class="col-md-1 row">
                    	<div class="form-group">
                       <button class="btn btn-sm btn-primary btn-plus" type="button">+</button> 
                      </div>
                    </div>
                    <!-- col-md-1-->
                    <div class="col-lg-2 col-sm-3 row">
                      <div class="form-group">
                          <label>Taxes </label>
                          <input type="text" name="airline_taxes" id="" class="form-control input-sm airline_taxes" placeholder="Taxes" 
                          onkeyup="net_cost('ticket_form')">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-2-->
                    <div class="col-md-1">
                    	<div class="form-group">
                       <button class="btn btn-sm btn-primary btn-plus" type="button">-</button> 
                      </div>
                    </div>
                    <!-- col-md-1-->
                    <div class="col-md-1 col-sm-3 row">
                      <div class="form-group row">
                          <label>COM% </label>
                          <input type="text" class="form-control input-sm acomission_per" placeholder="%" 
                          onkeyup="net_cost('ticket_form')">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-1-->
                    <div class="col-md-1 col-sm-3">
                      <div class="form-group row">
                          <label>Amount </label>
                          <input type="text" name="acomission" id="" class="form-control input-sm acomission" placeholder="Commision" 
                          onkeyup="comm_per('ticket_form')">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-1-->
                    <div class="col-md-1">
                      <div class="form-group">
                       <button class="btn btn-sm btn-primary btn-equal" type="button">=</button> 
                      </div>
                    </div>
                    <!-- col-md-1-->
                     <div class="col-lg-2 col-sm-3">
                    	<div class="form-group">
                          <label>Other Charges </label>
                          <input type="text" name="other_charges" id="" class="form-control input-sm tkt_other_char" 
                          placeholder="Other Charges" onkeyup="net_cost('ticket_form')">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <!-- col-md-1-->
                     <div class="col-lg-2 col-sm-3">
                    	<div class="form-group">
                          <label>Net Cost </label>
                          <input type="text" name="netCost" id="" class="form-control input-sm netCost" placeholder="Net Cost">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <!--<h3 style="border-top: 1px solid #d2d6de;padding-top: 25px;">Payment Method:</h3>-->
                    <!--<div class="col-lg-3 col-sm-3">-->
                    	<!--<div class="form-group">
                          <label>Invoice Number</label>
                          <input type="text" name="invoice_no" id="invoice_no" class="form-control input-sm" placeholder="Invoice Number">
                       </div>-->
                    <!-- form-group-->
                   <!-- </div>-->
                    <!-- col-lg-3-->
                   <!-- <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Form of Payment: </label>
                          <select class="form-control input-sm" name="payment_type" id="payment_type">
                              <option value="cash">Cash</option>
                              <option value="cheque">Cheque</option>
                              <option value="credit">Credit Card</option>
               			 </select>
                       </div>-->
                    <!-- form--group-->
                   <!-- </div>-->
                    <!-- col-lg-3-->
                    <div class="col-lg-12 col-sm-12">
                    	<div class="form-group">
                         <label>A/c Or Cheque Details:</label>
                          <textarea rows="3" name="accDetails" class="form-control input-sm"><?php echo $row['contact_name'] ?></textarea>
                       </div>
                     <!--form--group-->
                    </div>
                    <!--12-->
                    
                    <div class="col-lg-2 col-xs-12 col-sm-3 pull-right">
                    <input type="reset" class="btn btn-danger col-xs-12 col-sm-12"  value="Reset">
                    </div>
                    <div class="col-lg-2 col-xs-12 col-sm-3 pull-right">
                    <input type="button" class="btn btn-success col-xs-12 col-sm-12" 
                    onClick="add_leadDetail('ticket', 'ticket_form', 'get_ticket')" value="Add Sale">
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