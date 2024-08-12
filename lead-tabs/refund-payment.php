<div id="refund_payment" class="tab-pane fade">
  <h3>Refund Payment</h3>
  Branch: <span style="margin-left:10%;">Issue Date:</span>
  <p>
  <div class="panel panel-default">
    <form id="refund_payment_form">
      <input type="hidden" name="branch_id" value="<?php echo $_SESSION['branch_id'] ?>"  />
      <div class="panel-body">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Payment To</label>
              <input class="form-control input-sm" name="payment_to"   type="text" placeholder="Payment To">
            </div>
            <!-- form--group--> 
          </div>
          <!--co-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Detail</label>
              <input class="form-control input-sm" name="detail"   type="text" placeholder="Detail">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-3">
            <div class="form-group">
              <label>Form Of Payment</label>
              <select class="form-control input-sm" name="payment_type" onchange="fop(this.value, 'fop-ref')">
                <?php echo $cm->fop(); ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-md-3 col-sm-3 rec-cash">
            <div class="form-group">
              <label>Trans Account</label>
              <select class="form-control input-sm" name="bank_id">
                <?php echo $administrator->cash_acc() ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-md-3 col-sm-3 rec-banks" style="display:none;">
            <div class="form-group">
              <label>Payable Bank</label>
              <select class="form-control input-sm" name="bank_id" disabled="disabled">
                <option value="">Select Bank</option>
                <?php echo $cm->banks(); ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="clearfix"></div>
          <div class="ref_multiple_rec">
            <div class="col-lg-3 col-sm-3">
              <div class="form-group">
                <label>Invoice Number </label>
                <input class="form-control input-sm ref_fetch_sale_inv" name="refrence[]" type="text" placeholder="Invoice Number">
              </div>
              <!-- form--group--> 
            </div>
            <!-- col-lg-3-->
            <div class="col-lg-3 col-sm-3">
              <div class="form-group">
                <label>Amount *</label>
                <input name="amount[]" type="text" class="form-control input-sm ref_get_inv_amount" id="" placeholder="Amount" value="" />
              </div>
              <!-- form--group--> 
            </div>
            <!--co-lg-3-->
            <div class="col-md-1">
              <label style="visibility:hidden">Tourvision</label>
              <button type="button" class="btn btn-sm btn-primary ref_multiple_rec_app"><i class="fa fa-plus"></i></button>
            </div>
            <!--col-md-1--> 
            <div class="clearfix"></div>
          </div>
          <!--multiple record-->
          <div class="clearfix"></div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Total Amount</label>
              <input type="text" name="total_inv_amount" class="form-control input-sm" id="ref_inv_total_amount">
            </div>
          </div>
          <div class="clearfix"></div>
          <h5 style="border-top: 1px solid #d2d6de;padding-top: 25px;">Payment Details:</h5>
          <div class="clearfix"></div>
          <div id="fop-ref"></div>
          <!--<div class="col-lg-12 col-sm-6">
                    	<label class="radio-inline"><input type="radio" name="service" value="umrah">Umrah</label>
                       <label class="radio-inline"><input type="radio" name="service" value="other" checked="checked">Other</label>
                    </div>--> 
          <!-- col-lg-4-->
          <div class="col-lg-12 col-sm-12">
            <div class="form-group">
              <label>Remarks</label>
              <textarea rows="3" class="form-control input-sm" name="remark"></textarea>
            </div>
            <!-- form--group--> 
          </div>
          <!--12-->
          <div class="col-lg-2 col-xs-12 col-sm-3 pull-right">
            <input type="button" class="btn btn-success col-xs-12 col-sm-12" value="Add Payment" 
                    onclick="add_leadDetail('refundPayment', 'refund_payment_form', 'get_refundPayment')">
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
