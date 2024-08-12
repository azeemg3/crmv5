<div class="modal fade" id="Vedit_tour_visa" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Visa</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form id="Ve_tour_visa">
      <input type="hidden" name="id" id="tVisaId" />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Passanger Name</label>
                            <input type="text" name="visaPassName" value="" id="eVisaPassName" class="form-control input-sm">
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Visa Type</label>
                    		<input name="visaType" class="form-control input-sm" list="visaType" autocomplete="off" />
                    		<datalist id="visaType">
                    			<?php echo $tour->tour_vt() ?>
                    		</datalist>
                        </div>
                   </div>
                    <!--col-lg-2-->
                    <div class="col-lg-6">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select name="vendor" class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                        <?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="visaQty" id="eVisaQty" class="form-control input-sm visaQty" 
                    onchange="visaTCal('Vedit_tour_visa')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Passport Number:</label>
                  <input type="text" name="visa_passportNo" placeholder="Passport Number" class="form-control input-sm" />
               </div>
            <!-- form--group-->
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input type="text" name="visaPp" id="eVisaPp" value="" class="form-control input-sm visaPp" onchange="visaTCal('Vedit_tour_visa')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="visaSp" id="eVisaSp" value="" class="form-control input-sm visaSp" 
                    onchange="visaTCal('Vedit_tour_visa')">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_visaPp" value="" id="etVisaPp" class="form-control input-sm tVisaPp" readonly  />
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_visaSp" value="" id="t_visaSp" class="form-control input-sm tVisaSp" readonly />
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-10">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Visa Description Here" name="visa_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-6-->
            <div col-lg-12>
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="Update" class="btn btn-info form-control" 
                    onclick="update_tour('Ve_tour_visa','tourVisa', 'VtourVisaId', 'tourSale/ajax_call/view_getTour', 'Vedit_tour_visa')">
                </div>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>