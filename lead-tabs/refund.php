<div id="refund" class="tab-pane fade">
  <h3>Issue Refund Voucher</h3>
  Branch: <?php echo $cm->u_value("branches", "branch_name","branch_id=".$_SESSION['branch_id'].""); ?> <span style="margin-left:10%;">Issue Date: <?php echo $cm->today() ?> </span>
  <p>
  <div class="panel panel-default">
    <form id="refund_form">
      <input type="hidden" name="branch" value=""  />
      <div class="panel-body">
        <div class="col-lg-12 col-sm-12 col-xs-12 row">
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Refund Against *</label>
              	<select class="form-control input-sm" name="refund_against" onchange="sel_refund_type(this.value, 'rfnd')">
                	<option value="ticket">Ticket</option>
                    <option value="other_sale">Other Sale</option>
                    <option value="tour">Tour Sale</option>
                </select>
            </div>
            <!-- form--group--> 
          </div>
          <!--co-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <div class="col-xs-6 row">
                <label>Ticket No*</label>
                <input class="form-control airline_code input-sm" maxlength="3"  name="airline_code"  type="text" id="rfndrefund_ac" placeholder="Airline Code"
                value="" />
              </div>
              <div class="col-xs-8 row">
                <label>&nbsp;&nbsp;</label>
                <input class="form-control ticket_no input-sm" maxlength="10" id="rfndrefund_tn" type="text" name="ticket_no"
                                placeholder="Ticket No*" onchange="fetch_ticket_det()">
              </div>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Invoice Number *</label>
              	<input type="text" name="invoice_number" placeholder="Invoice Number" class="form-control input-sm" />
            </div>
            <!-- form--group--> 
          </div>
          <!--co-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Account Title</label>
              <input type="text" name="recFrm" value="<?php echo $row['contact_name'] ?>" class="form-control input-sm" placeholder="Account Title">
            </div>
            <!-- form--group--> 
          </div>
          <!--co-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Phone </label>
              <input type="text" name="phone" class="form-control input-sm" value="" placeholder="Phone">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Passenger Name : </label>
              <input type="text" name="passName" id="" class="form-control input-sm" placeholder="Passenger Name">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Sectors: </label>
              <input type="text" name="sector" class="form-control input-sm" placeholder="Sectors" id="rfndrfnd_sector">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Refund Sector:</label>
              <br>
              <input type="text" name="refund_sec" class="form-control input-sm" placeholder="Refund Sector" id="rfndrefund_sector">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-md-3">
            <div class="form-group">
              <label>Vendors</label>
              <select  class="form-control input-sm" name="airline_id">
                <option value="">Select Vendor</option>
                <?php echo $cm->vendors(); ?>
              </select>
            </div>
          </div>
          <!--col-md-3-->
          <div class="col-lg-3 col-sm-4">
            <div class="form-group">
              <label>Refund Type:</label>
              <br>
              <label class="radio-inline">
                <input type="radio" name="ref_type" value="full" checked>
                Full Refund</label>
              <label class="radio-inline">
                <input type="radio" name="ref_type" value="half">
                Partial Refund</label>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <!--<div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Refund Amount:</label>
              <br>
              <input type="text" name="refund_amount" class="form-control input-sm" placeholder="Refund Amount">
            </div>-->
            <!-- form--group--> 
          <!--</div>-->
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Service Charges:</label>
              <br>
              <input type="text" name="services_charges" class="form-control input-sm" placeholder="Service Charges">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-12 col-sm-12">
            <div class="form-group">
              <label>Remarks:</label>
              <textarea rows="3" class="form-control input-sm" name="remark"></textarea>
            </div>
            <!-- form--group--> 
          </div>
          <!--12-->
          <div class="col-lg-3 col-xs-12 col-sm-3 pull-right">
            <input type="button" class="btn btn-success col-xs-12 col-sm-12" value="Issue Refund Voucher" 
                    onClick="add_leadDetail('refund', 'refund_form', 'get_refund')"">
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
