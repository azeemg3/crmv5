<div class="modal fade" id="Vedit_tour_trans" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Transport</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form id="Vedit_tourTransport">
      <input type="hidden" name="id" id="tTransId" />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
            	<div class="col-lg-6">
                <div class="form-group">
                    <label>Passanger Name</label>
                    <input type="text" name="transPassName" value="" class="form-control input-sm ">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-6">
            	<div class="form-group">
                	<label>Vehicle Type</label>
                    <input list="transVehType" id="" name="transVehType" class="form-control input-sm" />
                    <datalist id="transVehType">
                    	<?php echo $tour->tour_veht(); ?>	
                    </datalist>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Sector</label>
                    <input type="text" name="transSector" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="transQty" class="form-control input-sm transQty" onchange="tTransportCal('Vedit_tourTransport')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Date</label>
                    <input type="text" name="trans_date" value="" class="form-control input-sm date">
                </div>
            </div>
            <!--col-lg-2-->
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
                    <input name="transPp" type="text" class="form-control input-sm transPp" onchange="tTransportCal('Vedit_tourTransport')" value="" />
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input name="transSp" type="text" class="form-control input-sm transSp" onchange="tTransportCal('Vedit_tourTransport')" value="" />
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_transPp" value="" class="form-control input-sm tTransPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_transSp" value="" class="form-control input-sm tTransSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->  
            <div class="col-lg-12">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Transport Description Here" name="trans_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-12-->              
               <div class="col-lg-12">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="Update" class="btn btn-info form-control" 
                    onclick="update_tour('Vedit_tourTransport', 'tourTrans', 'VtourTransId', 'tourSale/ajax_call/view_getTour',
                     'Vedit_tour_trans' )">
                </div>
            </div>
            <!--col-lg-12-->          
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