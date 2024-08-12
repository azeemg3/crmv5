<div class="modal fade" id="edit_tour_hotel" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Hotel</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
      <form id="edit_tourHotel">
      <input type="hidden" name="id" id="tHotelId" />
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="col-lg-6">
            	<div class="form-group">
                	<label>Passanger Name</label>
                    <input type="text" name="hotelPassName" id="ehotelPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-6">
            	<div class="form-group">
                	<label>Room Type</label>
                    <select class="form-control input-sm" name="hotelRoomType" id="ehotelRoomType" >
                    	<option value="">Select...</option>
                        <?php echo $cm->room_types(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Hotel Name</label>
                    <input list="hotelName" name="hotelName" id="ehotelName" value="" class="form-control input-sm">
                    <datalist>
                    	<option value="Al fairs"></option>
                    </datalist>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Vendor</label>
                   <select name="vendor" class="form-control input-sm">
                   		<option value="">Select</option>
                    	<?php echo $cm->vendors(); ?>
                   </select>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="hotelQty" id="ehotelQty" class="form-control input-sm hotelQty" 
                    onchange="cnightTourhotel('edit_tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Checkin Date</label>
                    <input type="text" name="hotelCheckin" id="" value="" class="form-control input-sm date hotelCheckin">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Checkout Date</label>
                    <input type="text" name="hotelCheckout" id="" value="" class="form-control input-sm date hotelCheckout" onchange="cnightTourhotel('edit_tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-6">
            	<div class="form-group">
                	<label>Nights</label>
                    <input type="text" name="hotelNights" id="ehotelNights" value="" class="form-control input-sm hotelNights" 
                    onchange="hTsCal('edit_tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-6">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input type="text" name="hotelPp" value="" id="ehotelPp" class="form-control input-sm hotelPp" 
                    onchange="cnightTourhotel('edit_tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="hotelSp" value="" id="ehotelSp" class="form-control input-sm hotelSp" onchange="hTsCal('edit_tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_hotelPp" value="" class="form-control input-sm tHotelPp" id="etHotelPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_hotelSp" value="" class="form-control input-sm tHotelSp " id="etHotelSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-12">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Hotel Description Here" name="hotel_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-12-->
            <div class="col-lg-12">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="Update" class="btn btn-info form-control" 
                    onclick="tour_add('edit_tourHotel', 'tourHotel', 'tourSale/ajax_call/getTour', 'tourHotelId')">
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