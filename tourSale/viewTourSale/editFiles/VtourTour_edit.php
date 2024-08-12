<div class="modal fade" id="Vedit_tour_tour" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Tour</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form id="Ve_tour_tour">
      <input type="hidden" name="id" id="" />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="col-lg-6">
                <div class="form-group">
                    <label>Passanger Name</label>
                    <input type="text" name="tourPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Tour Name</label>
                    <input list="tourName" name="tourName" value="" class="form-control input-sm">
                    <datalist id="tourName">
						<?php echo $tour->tour_tn() ?>
                    </datalist>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="tourQty" class="form-control input-sm tourQty" onchange="tTourCal('Ve_tour_tour')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Date</label>
                    <input type="text" name="tourDate" value="" class="form-control input-sm date">
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
                    <input type="text" name="tourPp" value="" class="form-control input-sm tourPp" onchange="tTourCal('Ve_tour_tour')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="tourSp" value="" class="form-control input-sm tourSp" onchange="tTourCal('Ve_tour_tour')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_tourPp" value="" class="form-control input-sm tTourPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_tourSp" value="" class="form-control input-sm tTourSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-12">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Tour Description Here" name="tour_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-12-->
                <div col-lg-12>
                    <div class="form-group">
                    <label>&nbsp;</label>
                        <input type="button" value="Update" class="btn btn-info form-control" 
                        onclick="update_tour('Ve_tour_tour','tourTour','VtourTourId' ,'tourSale/ajax_call/getTour', 'Vedit_tour_tour' )">
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