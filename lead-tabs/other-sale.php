<div id="otherSale" class="tab-pane fade">
      <h3>Add Other Sale</h3>
      <p><div class="panel panel-default">
      <form id="other_sale_form">
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
                          <select class="form-control input-sm" name="salesStaff">
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
                          <label>Stock Used: </label>
                          <select class="form-control input-sm" name="stock_used" onchange="other_stock(this.value, 'other_stock-s')">
                              <option value="own">Own</option>
                              <option value="other">Other</option>
                		  </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div id="other_stock-s" class="col-md-3" style="display:none;"></div>
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Service Type</label>
                          <select class="form-control input-sm" name="ser_type">
                            <option value="">Select...</option>
                            <?php echo $cm->services(); ?>
			            </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Passport Number</label>
                          <input type="text" name="passport_num" class="form-control input-sm" placeholder="Passport Number" />
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-12 col-sm-12">
                    	<div class="form-group">
                         <label>Sales Details :</label>
                          <textarea rows="3" name="sales_detail" class="form-control input-sm"></textarea>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--12-->
                    <div class="clearfix"></div>
                    <h3 class="">Passenger Details:</h3>
                    <div class="col-lg-4 col-sm-3">
                    	<div class="form-group">
                          <label>Passenger Name *</label>
                          <input type="text" class="form-control input-sm" name="passName" id="passName"  value="" placeholder="Passenger Name*">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-4 col-sm-3">
                    	<div class="form-group">
                          <label>Phone Number </label>
                          <input type="text" name="phone"  value="<?php echo $row['mobile'] ?>" class="form-control input-sm" placeholder="Phone Number">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-4 col-sm-3">
                    	<div class="form-group">
                          <label>Passenger Type </label>
                          <select class="form-control" name="passType" >
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
                     <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Received </label>
                          <input type="text" name="recieved"  class="form-control input-sm" placeholder="Received">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Net Cost </label>
                          <input type="text" name="netCost"  class="form-control input-sm" placeholder="Net Cost">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <!--<!--<h3>Payment Method:</h3>
                   <!-- <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Invoice Number</label>
                          <input type="text" name="invoice_no"  class="form-control input-sm" placeholder="Invoice Number">
                       </div>-->
                    <!-- form--group-->
                    <!--</div>-->
                    <!-- col-lg-3-->
                   <!-- <div class="col-lg-3 col-sm-3">
                    	<div class="form-group">
                          <label>Form of Payment: </label>
                          <select class="form-control input-sm" name="payment_type" >
                              <option value="cash">Cash</option>
                              <option value="cheque">Cheque</option>
                              <option value="credit">Credit Card</option>
               			 </select>
                       </div>-->
                    <!-- form--group-->
                    <!--</div>-->
                    <!-- col-lg-3-->
                    <div class="col-lg-12 col-sm-12">
                    	<div class="form-group">
                         <label>A/c Or Cheque Details:</label>
                          <textarea rows="3" name="accDetails" class="form-control input-sm"><?php echo $row['contact_name'] ?></textarea>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--12-->
                    <div class="col-lg-2 col-xs-12 col-sm-3 pull-right">
                    <input type="reset" class="btn btn-success col-xs-12 col-sm-12" value="Add Other Sale" 
                    onClick="add_leadDetail('other_sale', 'other_sale_form', 'get_other_sale')">
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