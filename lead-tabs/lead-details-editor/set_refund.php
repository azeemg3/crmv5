<div class="modal fade" id="edit_refund" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Refund Voucher</h4>
          <p><div class="panel panel-default">
      <form id="e_refund_form">
          <input type="hidden" name="id" id="id" />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12 row">
                	<div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                          <label>Refund Against *</label>
                            <select class="form-control input-sm" name="refund_against" onchange="sel_refund_type(this.value, 'edit_rfnd')">
                                <option value="ticket">Ticket</option>
                                <option value="other_sale">Other Sale</option>
                                <option value="tour">Tour Sale</option>
                            </select>
                        </div>
                        <!-- form--group--> 
                      </div>
                      <!--co-lg-3-->
                      <div class="col-lg-6 col-sm-3">
                        <div class="form-group">
                          <label>Invoice Number *</label>
                            <input type="text" name="invoice_number" placeholder="Invoice Number" class="form-control input-sm" />
                        </div>
                        <!-- form--group--> 
                      </div>
                      <!--co-lg-3-->
            		<div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Recieved From *</label>
                         <input type="text" name="recFrm" value="" class="form-control input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Phone  </label>
                          <input type="text" name="phone" class="form-control phone input-sm" value="923218499422">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                           <div class="col-xs-6 row">
        						<label>Ticket No*</label>
	                            <input class="form-control airline_code input-sm" id="edit_rfndrefund_ac" maxlength="3" name="airline_code"  type="text">
                          </div>
                          <div class="col-xs-8 row">
                          		<label>&nbsp;&nbsp;</label>
	                            <input class="form-control ticket_no input-sm" maxlength="10" id="edit_rfndrefund_tn" name="ticket_no"  type="text">
                          </div>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
        						<label>Passenger Name : </label>
	                            <input type="text" name="passName" class="form-control passName input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
        						<label>Sectors: </label>
	                            <input type="text" name="sector" class="form-control sector input-sm" id="edit_rfndrfnd_sector">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Refund Type:</label><br>
                          <label class="radio-inline"><input class="full" type="radio" name="ref_type" value="full" checked="checked">Full Refund</label>
                       <label class="radio-inline"><input class="half" type="radio" name="ref_type" value="half">Partial Refund</label>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Refund Sector:</label><br>
                          <input type="text" name="refund_sec" class="form-control refund_sec input-sm" id="edit_rfndrefund_sector">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Services Charges</label><br>
                          <input type="text" name="services_charges" class="form-control input-sm" placeholder="services charges">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <!--<div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Refund Amount:</label><br>
                          <input type="text" name="refund_amount" class="form-control input-sm">
                       </div>-->
                    <!-- form--group-->
                    <!--</div>-->
                    <!-- col-lg-3-->
                    <div class="col-lg-12 col-sm-6">
                    	<div class="form-group">
                         <label>Remarks:</label>
                          <textarea rows="3" class="form-control remark input-sm" name="remark"></textarea>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--12-->
                    <div class="col-lg-6 col-xs-12 col-sm-6 pull-right">
                    <input type="button" class="btn btn-primary col-xs-12 col-sm-12" value="Update" data-dismiss="modal" 
                    onClick="add_leadDetail('refund', 'e_refund_form', 'get_refund')">
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
  <!-- Edit refund-->