<div class="modal fade" id="edit_other_sale" role="dialog" style="overflow:scroll">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="empty_fields('e_other_sale_form')">&times;</button>
          <h4 class="modal-title">Update Other Sale</h4>
          <p><div class="panel panel-default">
      <form id="e_other_sale_form">
      <input type="hidden" name="id"  />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12 row">
            		<div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Branch</label>
                         <select class="form-control branch input-sm" name="branch" id="">
                         	 <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                		</select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Sales Staff </label>
                          <select class="form-control input-sm salesStaff" name="salesStaff">
                          	 <?php echo $cm->spo('', $_SESSION['branch_id']); ?>
                         </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Date of issue*</label>
                          <input class="form-control date issue_date input-sm" readonly name="issue_date" value="" type="text">
                       </div>
                    <!-- form--group-->
                    </div>
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Stock Used: </label>
                          <select class="form-control stock_used input-sm" name="stock_used" onchange="other_stock(this.value, 'other_stock-es')">
                              <option value="own">Own</option>
                              <option value="other">Other</option>
                		  </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div id="other_stock-es" class="col-md-6" style="display: none;">
                    	<div class="form-group">
						<label>Select Vendor</label>
                        <select class="form-control input-sm" onChange="s_term_c(this.value)" name="vendor_id">
                            <option value="">Select...</option>
                            <?php echo $cm->vendors(); ?>
						</select>
                    	</div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Service Type</label>
                          <select class="form-control ser_type input-sm" name="ser_type">
                            <option value="">Select...</option>
                            <?php echo $cm->services(); ?>
			            </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Passport Number</label>
                          <input type="text" name="passport_num" class="form-control passport_num input-sm" />
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-12 col-sm-6">
                    	<div class="form-group">
                         <label>Sales Details :</label>
                          <textarea rows="3" name="sales_detail" class="form-control sales_detail input-sm"></textarea>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--12-->
                    <div class="clearfix"></div>
                    <h3 class="">Passenger Details:</h3>
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Passenger Name  </label>
                          <input type="text" class="form-control passName input-sm" name="passName" id=""  value="">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Phone Number </label>
                          <input type="text" name="phone"  value="" class="form-control phone input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Passenger Type </label>
                          <select class="form-control passType input-sm" name="passType" >
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
                          <input type="text" name="recieved"  class="form-control recieved input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                     <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Net Cost </label>
                          <input type="text" name="netCost"  class="form-control netCost input-sm">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-3-->
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12">
                    	<div class="form-group">
                         <label>A/c Or Cheque Details:</label>
                          <textarea rows="3" name="accDetails" class="form-control input-sm"><?php echo $row['contact_name'] ?></textarea>
                       </div>
                     <!--form--group-->
                    </div>
                    <!--12-->
                   <!-- <h3>Payment Method:</h3>
                    <div class="col-lg-6 col-sm-6">
                    	<div class="form-group">
                          <label>Invoice Number</label>
                          <input type="text" name="invoice_no"  class="form-control invoice_no input-sm">
                       </div>-->
                    <!-- form--group-->
                   <!-- </div>-->
                    <!-- col-lg-3-->
                   <!-- <div class="col-lg-6 col-sm-6">-->
                    	<!--<div class="form-group">
                          <label>Form of Payment: </label>
                          <select class="form-control payment_type input-sm" name="payment_type" >
                              <option value="cash">Cash</option>
                              <option value="cheque">Cheque</option>
                              <option value="credit">Credit Card</option>
               			 </select>
                       </div>-->
                    <!-- form--group-->
                   <!-- </div>-->
                    <!-- col-lg-3-->
                    <!--<div class="col-lg-12 col-sm-6">
                    	<div class="form-group">
                         <label>A/c Or Cheque Details:</label>
                          <textarea rows="3" name="accDetails" class="form-control accDetails input-sm"></textarea>
                       </div>-->
                    <!-- form--group-->
                    <!--</div>-->
                    <!--12-->
                    <div class="col-lg-6 col-xs-12 col-sm-6 pull-right">
                    <input type="button" class="btn btn-primary col-xs-12 col-sm-12"  value="Update" data-dismiss="modal" 
                    onClick="add_leadDetail('other_sale', 'e_other_sale_form', 'get_other_sale')">
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
  <!-- edit other sale-->