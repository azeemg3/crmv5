<div class="modal fade" id="edit_ticket" role="dialog" style="overflow:scroll;">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onClick="empty_fields('e_ticket_form')">&times;</button>
        <h4 class="modal-title">Update Ticket Sale</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="panel panel-default">
          <form id="e_ticket_form">
            <input type="hidden" name="id" />
            <div class="panel-body">
              <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Branch</label>
                    <select class="form-control branch input-sm" name="branch">
                      <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                    </select>
                  </div>
                  <!-- form--group--> 
                </div>
                <!--co-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Sales Staff </label>
                    <select class="form-control salesStaff input-sm" name="salesStaff">
                      <?php echo $cm->spo('', $_SESSION['branch_id']); ?>
                    </select>
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Date of issue*</label>
                    <input class="form-control issue_date date input-sm" readonly name="issue_date" value="" type="text">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Airlines</label>
                    <select class="form-control input-sm" name="airline_id">
                      <option value="">Select Airline</option>
                      <?php echo $administrator->airlineList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Stock Used: </label>
                    <select class="form-control stock_used input-sm" name="stock_used" onchange="other_stock(this.value,'e-other_stock-t')">
                      <option value="own">Own</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                  <!-- form--group--> 
                </div>
                <div id="e-other_stock-t" class="col-sm-6" style="display:none;">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Select Vendor</label>
                      <select class="form-control input-sm" onChange="s_term_c(this.value)" name="vendor_id">
                        <option value="">Select...</option>
                        <?php echo $cm->vendors(); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Other Stock Details </label>
                    <input type="text" class="form-control other_stack input-sm" name="other_stack">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <div class="col-xs-6 row">
                      <label>Ticket No*</label>
                      <input class="form-control airline_code input-sm" name="airline_code" id="" maxlength="3" type="text">
                    </div>
                    <div class="col-xs-8 row">
                      <label>&nbsp;&nbsp;</label>
                      <input class="form-control ticket_no input-sm" name="ticket_no" id="" maxlength="10" type="text">
                    </div>
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Sector </label>
                    <input type="text" class="form-control sector input-sm" name="sector"  placeholder="From To" value="">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                
                <div class="clearfix"></div>
                <h3>Passenger Details:</h3>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Passenger Name </label>
                    <input type="text" class="form-control passName input-sm" name="passName"  value="">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Phone Number </label>
                    <input type="text" name="phone" id="" value="" class="form-control phone input-sm">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Passenger Type </label>
                    <select class="form-control passType input-sm" name="passType" id="">
                      <option value="adult">Adult</option>
                      <option value="child">Child</option>
                      <option value="infant"> Infant</option>
                    </select>
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="clearfix"></div>
                <h3>Amount:</h3>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group">
                    <label>Received </label>
                    <input type="text" name="recieved" id="" class="form-control recieved input-sm">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-md-3">
                  <div class="from-group">
                    <label>Base Fare</label>
                    <input type="text" name="base_fare" onkeyup="net_cost('e_ticket_form')"  class="form-control input-sm basic_fare"  />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="from-group">
                    <label>Taxes</label>
                    <input type="text" name="airline_taxes" class="form-control input-sm airline_taxes" onkeyup="net_cost('e_ticket_form')" />
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-6">
                  <div class="from-group">
                    <label>COM%</label>
                    <input type="text" class="form-control input-sm acomission_per" onkeyup="net_cost('e_ticket_form')" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="from-group">
                    <label>COM Amount</label>
                    <input type="text" name="acomission" class="form-control input-sm acomission" onkeyup="comm_per('e_ticket_form')" />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-3">
                  <div class="form-group">
                    <label>Other Charges </label>
                    <input type="text" name="other_charges" id="" class="form-control input-sm tkt_other_char" 
                          placeholder="Other Charges" onkeyup="net_cost('e_ticket_form')">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="col-sm-6 col-sm-6">
                  <div class="form-group">
                    <label>Net Cost </label>
                    <input type="text" name="netCost" id="" class="form-control netCost input-sm netCost">
                  </div>
                  <!-- form--group--> 
                </div>
                <!-- col-lg-3-->
                <div class="clearfix"></div>
                <!--<h3>Payment Method:</h3>
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Invoice Number</label>
                          <input type="text" name="invoice_no" id="" class="form-control invoice_no input-sm">
                       </div>--> 
                <!-- form--group--> 
                <!--</div>--> 
                <!-- col-lg-3--> 
                <!--<div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Form of Payment: </label>
                          <select class="form-control payment_type input-sm" name="payment_type" id=" ">
                              <option value="cash">Cash</option>
                              <option value="cheque">Cheque</option>
                              <option value="credit">Credit Card</option>
               			 </select>
                       </div>--> 
                <!-- form--group--> 
                <!--</div>--> 
                <!-- col-lg-3-->
                <div class="col-lg-12 col-sm-6">
                  <div class="form-group">
                    <label>A/c Or Cheque Details:</label>
                    <textarea rows="3" name="accDetails" class="form-control accDetails input-sm"></textarea>
                  </div>
                  <!-- form--group--> 
                </div>
                <!--12-->
                <div class="col-lg-3 col-xs-12 col-sm-6 pull-right">
                  <input type="button" class="btn btn-primary col-xs-12 col-sm-12 input-sm" data-dismiss="modal"  
                  onClick="add_leadDetail('ticket', 'e_ticket_form', 'get_ticket')" value="Update">
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
    </div>
  </div>
</div>
