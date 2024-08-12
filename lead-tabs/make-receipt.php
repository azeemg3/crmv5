<div id="make_receipt" class="tab-pane fade in">
      <h3>Make Receipt</h3>
      Branch:
      <span style="margin-left:10%;">Issue Date: </span>
      <p><div class="panel panel-default">
      		<form id="receipt_form">
            <input type="hidden" name="branch" value="<?php echo $_SESSION['branch_id'] ?>"  />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
            		<div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Received From *</label>
                          <input class="form-control input-sm" name="recieve"   type="text" placeholder="Received From *" value="<?php echo $row['contact_name']?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                     <div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Sector</label>
                          <input class="form-control input-sm" name="sector"   type="text" placeholder="Sector">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Form Of Payment</label>
                          <select class="form-control input-sm" name="payment_type" onChange="fop(this.value, 'fop-rec')">
                          	<?php echo $cm->fop(); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                     <div class="col-lg-3 col-sm-4 rec-cash">
                    	<div class="form-group">
                          <label>Trans Account</label>
                          <select class="form-control input-sm" name="bank_id">
                          	<?php echo $administrator->cash_acc() ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-3 col-sm-4 rec-banks" style="display:none;">
                    	<div class="form-group">
                          <label>Receiveable Bank</label>
                          <select class="form-control input-sm" name="bank_id" disabled="disabled">
                          	<option value="">Select Bank</option>
                          	<?php echo $cm->banks(); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="clearfix"></div>
                     <div class="multiple_rec">
                    <div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Invoice Number / Ref No. </label>
                          <input class="form-control input-sm fetch_sale_inv" name="refrence[]" type="text" placeholder="Invoice Number">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-4">
                    	<div class="form-group">
                          <label>Amount *</label>
                          <input class="form-control input-sm get_inv_amount" name="amount[]"  id="rec_amount"  type="text" placeholder="Amount *">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-md-1">
                    	<label style="visibility:hidden">Tourvision</label>
                        <button type="button" class="btn btn-sm btn-primary multiple_rec_app"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                   </div>
                   <!--multiple record-->
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label>Total Amount</label>
                      <input type="text" name="total_inv_amount" class="form-control input-sm" id="inv_total_amount" />
                     </div>
                    </div>
                    <div class="clearfix"></div>
                    <h5 style="border-top: 1px solid #d2d6de;padding-top: 25px;">Payment Details:</h5>
                    <div class="clearfix"></div>
                    <div id="fop-rec"></div>
                    <div class="col-lg-12 col-sm-12">
                    	<div class="form-group">
                         <label>Remarks</label>
                          <textarea rows="3" class="form-control input-sm" name="remarks"></textarea>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--12-->
                    <div class="col-lg-2 col-xs-12 col-sm-2 pull-right">
                    <input type="button" class="btn btn-success col-xs-12 col-sm-12" value="Issue Receipt" 
                    onclick="add_leadDetail('receipt', 'receipt_form', 'get_receipt')">
                    </div>
                    </div>
                    <!-- col-lg-12-->
            </div>
            <!-- panel-body-->
            </form>
          </div>
          <!--panel-default--></p>
    </div>