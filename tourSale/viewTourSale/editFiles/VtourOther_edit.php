<div class="modal fade" id="Vedit_tour_other" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Services</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form id="Ve_tourOther">
      <input type="hidden" name="id" />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
                 <div class="col-lg-6">
                <div class="form-group">
                    <label>Passanger Name</label>
                    <input type="text" name="otherPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Service Name</label>
                    <input list="serviceName" id="" name="serviceName" value="" class="form-control input-sm">
                    <datalist id="serviceName">
                    	<?php echo $tour->tour_os(); ?>
                    </datalist>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="serQty" class="form-control input-sm serQty" onchange="othSerCal('Ve_tourOther')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Date</label>
                    <input type="text" name="serDate" value="" class="form-control input-sm date">
                </div>
            </div>
            <!--col-lg-2-->
           <?php //echo $c_m->setTime(); ?>
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select  name="vendor" class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                        <?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-6">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input type="text" name="serPp" value="" class="form-control input-sm serPp" onchange="othSerCal('Ve_tourOther')"> 
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="serSp" value="" class="form-control input-sm serSp" onchange="othSerCal('Ve_tourOther')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_serPp" value="" class="form-control input-sm tSerPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_serSp" value="" class="form-control input-sm tSerSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-12">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Service Description Here" name="other_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-12-->
                <div col-lg-12>
                    <div class="form-group">
                    <label>&nbsp;</label>
                        <input type="button" value="Update" class="btn btn-info form-control" 
                        onclick="update_tour('Ve_tourOther','tourOther', 'VtourOtherId', 'tourSale/ajax_call/view_getTour',
                         'Vedit_tour_other')">
                    </div>
                </div>
                <!--col-lg--12-->          
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