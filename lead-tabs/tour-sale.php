<?php
require_once'tourSale/editFiles/tourVisa_edit.php';
require_once'tourSale/editFiles/tourHotel_edit.php';
require_once'tourSale/editFiles/tourTrans_edit.php';
require_once'tourSale/editFiles/tourTour_edit.php';
require_once'tourSale/editFiles/tourOther_edit.php';
require_once'tourSale/viewTourSale/editFiles/VtourVisa_edit.php';
require_once'tourSale/viewTourSale/editFiles/VtourHotel_edit.php';
require_once'tourSale/viewTourSale/editFiles/VtourTrans_edit.php';
require_once'tourSale/viewTourSale/editFiles/VtourTour_edit.php';
require_once'tourSale/viewTourSale/editFiles/VtourOther_edit.php';
 ?>
<div id="tourSale" class="tab-pane fade">
      <h3>Tour Sale Invoice</h3>
      <p>
      <input type="hidden" name="uniqueId" id="uniqueId" value="<?php  echo $cm->uniqueId(); ?>" />
          <div class="panel panel-default">
          <div class="panel-body">
			<div class="col-lg-2 col-sm-2">
            	<div class="form-group">
              		<label>Branch:</label>
              		<select class="form-control input-sm" name="branch" id="tourBranch">
                    	<?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
					</select>
           	</div>
            </div>
            <!--col-lg-4--> 
            <div class="col-lg-2 col-sm-2">
                <div class="form-group">
                  <label>Select Spo:</label>
                  <select class="form-control input-sm" name="spo" id="tourSpo">
                  <?php echo $cm->spo($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                  </select>
               </div>
            <!-- form--group-->
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2 col-sm-2">
                <div class="form-group">
                  <label>Issue Date:</label>
                  <input type="text" id="tsinv_issue_date" readonly value="<?php echo $cm->today(); ?>" class="form-control input-sm date" />
               </div>
            <!-- form--group-->
            </div>
            <!--col-lg-2-->
            <!--<div class="col-lg-2 col-sm-2">
                <div class="form-group">
                  <label>Passport Number:</label>
                  <input type="text" id="ts_passportNo" placeholder="Passport Number" class="form-control input-sm" />
               </div>-->
            <!-- form--group-->
            <!--</div>-->
            <!--col-lg-2-->
            <div class="col-lg-2 col-sm-2">
                <div class="form-group">
                  <label>Family Head:</label>
                  <input type="text" id="tsinv_famlyHead_name" placeholder="Family Head Name" class="form-control input-sm" />
               </div>
            <!-- form--group-->
            </div>
            <!--col-lg-2-->
            
            
            
              <div class="box box-solid collapsed-box" style="margin-top:80px;border-top:2px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Visa</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                
         <form id="tour_visa">
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Passanger Name</label>
                    <input type="text" name="visaPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Visa Type</label>
                    <input name="visaType" class="form-control input-sm" list="visaType2" autocomplete="off" />
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select name="vendor" class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                    	<?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-1">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="visaQty" class="form-control input-sm visaQty" onchange="visaTCal('tour_visa')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2 col-sm-2">
                <div class="form-group">
                  <label>Passport Number:</label>
                  <input type="text" name="visa_passportNo" placeholder="Passport Number" class="form-control input-sm" />
               </div>
            <!-- form--group-->
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input type="text" name="visaPp" value="" class="form-control input-sm visaPp" onchange="visaTCal('tour_visa')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="visaSp" value="" class="form-control input-sm visaSp" onchange="visaTCal('tour_visa')">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_visaPp" value="" class="form-control input-sm tVisaPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_visaSp" value="" class="form-control input-sm tVisaSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="clearfix"></div>
            <div class="col-lg-10">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Visa Description Here" name="visa_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-6-->
            <div class="col-lg-1">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="+" class="btn btn-success form-control" 
                    onclick="tour_add('tour_visa','tourVisa', 'tourSale/ajax_call/getTour', 'tourVisaId')">
                </div>
            </div>
            <!--col-lg-1-->
            
            <div class="table-responsive" style="overflow-x: inherit;">
           	<table class="table table-bordered table-striped tourVisaId" style="display:none;">
              <thead>
                  <tr style="background:lightgray; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                  	<th>#</th>
                    <th>Lead Id</th>
                    <th>Passanger Name</th>
                    <th>Visa Type</th>
                    <th>Supplier</th>
                    <th title="Quantity">Qty</th>
                    <th title="Purchae Price">P.P</th>
                    <th title="Sale Price">S.P</th>
                    <th title="Total Purchase Price">T.P.P</th>
                    <th title="Total Sale Price">T.S.P</th>
                    <th>Action</th>
                  </tr>
                  <tbody id="tourVisaId">
                 </tbody>
  			 </thead>
            </table>
            </div>
            
            
            </form>      
              </div><!-- /.box-body -->
              </div>            
            <div class="box box-solid collapsed-box" style="border-top:2px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Hotel</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                
         <form id="tourHotel">
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Passanger Name</label>
                    <input type="text" name="hotelPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Room Type</label>
                    <select class="form-control input-sm" name="hotelRoomType" >
                    	<option value="">Select...</option>
                        <?php echo $cm->room_types(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Hotel Name</label>
                    <input list="hotelName" name="hotelName" autocomplete="off" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select name="vendor"  class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                        <?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-1">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="hotelQty" class="form-control input-sm hotelQty" onchange="hTsCal('tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Checkin Date</label>
                    <input type="text" name="hotelCheckin" id="" value="" class="form-control input-sm date hotelCheckin">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Checkout Date</label>
                    <input type="text" name="hotelCheckout" id="" value="" class="form-control input-sm date hotelCheckout" 
                    onchange="cnightTourhotel('tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-1">
            	<div class="form-group">
                	<label>Nights</label>
                    <input type="text" name="hotelNights" id="" value="" class="form-control input-sm hotelNights" >
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input type="text" name="hotelPp" value="" class="form-control input-sm hotelPp" onchange="hTsCal('tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="hotelSp" value="" class="form-control input-sm hotelSp" onchange="hTsCal('tourHotel')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_hotelPp" value="" class="form-control input-sm tHotelPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_hotelSp" value="" class="form-control input-sm tHotelSp " readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="clearfix"></div>
            <div class="col-lg-10">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Hotel Description Here" name="hotel_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-6-->
            <div class="col-lg-1">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="+" class="btn btn-success form-control" onclick="tour_add('tourHotel', 'tourHotel', 'tourSale/ajax_call/getTour', 'tourHotelId')">
                </div>
            </div>
            <!--col-lg-1-->
            
            <div class="table-responsive" style="overflow-x: inherit;">
           	<table class="table table-bordered table-striped tourHotelId" style="display:none;">
              <thead>
                  <tr style="background:lightgray; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                  	<th>#</th>
                    <th>Lead Id</th>
                    <th>Passanger Name</th>
                    <th>Room Type</th>
                    <th>Hotel Name	</th>
                    <th>Supplier</th>
                    <th title="Quantity">Qty</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                    <th>Nights</th>
                    <th title="Purchae Price">P.P</th>
                    <th title="Sale Price">S.P</th>
                    <th title="Total Purchase Price">T.P.P</th>
                    <th title="Total Sale Price">T.S.P</th>
                    <th>Action</th>
                  </tr>
                  <tbody id="tourHotelId">
                  
                 </tbody>
  			 </thead>
            </table>
            </div>
            
            
            </form>       
         
              </div><!-- /.box-body -->
              </div>
              
            
             
             <div class="box box-solid collapsed-box" style="border-top:2px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Transport</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                
         <form id="tourTransport">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Passanger Name</label>
                    <input type="text" name="transPassName" value="" class="form-control input-sm ">
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Vehicle Type</label>
                    <input list="transVehType2" name="transVehType" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Sector</label>
                    <input type="text" name="transSector" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-1">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="transQty" class="form-control input-sm transQty" onchange="tTransportCal('tourTransport')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Date</label>
                    <input type="text" name="trans_date" value="" class="form-control input-sm date">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select name="vendor" class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                        <?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input name="transPp" type="text" class="form-control input-sm transPp" onchange="tTransportCal('tourTransport')" value="" />
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input name="transSp" type="text" class="form-control input-sm transSp" onchange="tTransportCal('tourTransport')" value="" />
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_transPp" value="" class="form-control input-sm tTransPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_transSp" value="" class="form-control input-sm tTransSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="clearfix"></div>
            <div class="col-lg-10">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Transport Description Here" name="trans_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-6-->
            <div class="col-lg-1">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="+" class="btn btn-success form-control" 
                    onclick="tour_add('tourTransport', 'tourTrans', 'tourSale/ajax_call/getTour', 'tourTransId')">
                </div>
            </div>
            <!--col-lg-1-->
            <div class="table-responsive" style="overflow-x: inherit;">
           	<table class="table table-bordered table-striped tourTransId" style="display:none;">
              <thead>
                  <tr style="background:lightgray; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                  	<th>#</th>
                    <th>Lead Id</th>
                    <th>Passanger Name</th>
                    <th>Vehicle Type</th>
                    <th>Sector</th>
                    <th title="Quantity">Qty</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th title="Purchae Price">P.P</th>
                    <th title="Sale Price">S.P</th>
                    <th title="Total Purchase Price">T.P.P</th>
                    <th title="Total Sale Price">T.S.P</th>
                    <th>Action</th>
                  </tr>
                  <tbody id="tourTransId">
                 </tbody>
  			 </thead>
            </table>
            </div>
            
            
            </form>       
          
              </div><!-- /.box-body -->
              </div>



             <div class="box box-solid collapsed-box" style="border-top:2px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Tour</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                
         <form id="tourTour">
             	<div class="col-lg-2">
                <div class="form-group">
                    <label>Passanger Name</label>
                    <input type="text" name="tourPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Tour Name</label>
                    <input list="tourName2" name="tourName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-1">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="tourQty" class="form-control input-sm tourQty" onchange="tTourCal('tourTour')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Date</label>
                    <input type="text" name="tourDate" value="" class="form-control input-sm date">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select name="vendor"  class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                        <?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Purchase </label>
                    <input type="text" name="tourPp" value="" class="form-control input-sm tourPp" onchange="tTourCal('tourTour')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="tourSp" value="" class="form-control input-sm tourSp" onchange="tTourCal('tourTour')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_tourPp" value="" class="form-control input-sm tTourPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_tourSp" value="" class="form-control input-sm tTourSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="clearfix"></div>
            <div class="col-lg-10">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Tour Description Here" name="tour_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-6-->
            <div class="col-lg-1">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="+" class="btn btn-success form-control" 
                    onclick="tour_add('tourTour', 'tourTour', 'tourSale/ajax_call/getTour', 'tourTourId')">
                </div>
            </div>
            <!--col-lg-1-->
            <div class="table-responsive" style="overflow-x: inherit;">
           	<table class="table table-bordered table-striped">
              <thead>
                  <tr style="background:lightgray; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                  	<th>#</th>
                    <th>Lead Id</th>
                    <th>Passanger Name</th>
                    <th>Tour Name</th>
                    <th title="Quantity">Qty</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th title="Purchae Price">P.P</th>
                    <th title="Sale Price">S.P</th>
                    <th title="Total Purchase Price">T.P.P</th>
                    <th title="Total Sale Price">T.S.P</th>
                    <th>Action</th>
                  </tr>
                  <tbody id="tourTourId">
                 </tbody>
  			 </thead>
            </table>
            </div>
            
            
            </form>       
         
              </div><!-- /.box-body -->
              </div>

             
             <div class="box box-solid collapsed-box" style="border-top:2px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Other Services</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                
         <form id="tourOther">
             <div class="col-lg-2">
                <div class="form-group">
                    <label>Passanger Name</label>
                    <input type="text" name="otherPassName" value="" class="form-control input-sm">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Service Name</label>
                    <input list="serviceName2" id="" name="serviceName" value="" class="form-control input-sm" autocomplete="off">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-1">
            	<div class="form-group">
                	<label>Qty</label>
                    <input type="text" name="serQty" class="form-control input-sm serQty" onchange="othSerCal('tourOther')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Date</label>
                    <input type="text" name="serDate" value="" class="form-control input-sm date">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Vendor</label>
                    <select  name="vendor" class="form-control input-sm">
                    	<option value="">Select Vendor</option>
                        <?php echo $cm->vendors(); ?>
                    </select>
                </div>
            </div>
            <!--col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                	<label>Purchase Price</label>
                    <input type="text" name="serPp" value="" class="form-control input-sm serPp" onchange="othSerCal('tourOther')"> 
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Sale Price</label>
                    <input type="text" name="serSp" value="" class="form-control input-sm serSp" onchange="othSerCal('tourOther')">
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Purchase Price</label>
                    <input type="text" name="t_serPp" value="" class="form-control input-sm tSerPp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<label>Total Sale Price</label>
                    <input type="text" name="t_serSp" value="" class="form-control input-sm tSerSp" readonly>
                </div>
            </div>
            <!--col-lg-2-->
            <div class="clearfix"></div>
            <div class="col-lg-10">
            	<div class="form-group">
                	<label>Description</label>
                    <input type="text" placeholder="Add Service Description Here" name="other_desc" class="form-control input-sm" />
                </div>
            </div>
            <!--col-lg-6-->
            <div class="col-lg-1">
            	<div class="form-group">
                <label>&nbsp;</label>
                	<input type="button" value="+" class="btn btn-success form-control" 
                    onclick="tour_add('tourOther', 'tourOther', 'tourSale/ajax_call/getTour', 'tourOtherId')">
                </div>
            </div>
            <!--col-lg-1-->
            
       <div class="table-responsive" style="overflow-x: inherit;">
           	<table class="table table-bordered table-striped">
              <thead>
                  <tr style="background:lightgray; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                  	<th>#</th>
                    <th>Lead Id</th>
                    <th>Passanger Name</th>
                    <th>Service Name</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th title="Quantity">Qty</th>
                    <th title="Purchae Price">P.P</th>
                    <th title="Sale Price">S.P</th>
                    <th title="Total Purchase Price">T.P.P</th>
                    <th title="Total Sale Price">T.S.P</th>
                    <th>Action</th>
                  </tr>
                  <tbody id="tourOtherId">
                 </tbody>
  			 </thead>
            </table>
            </div>     
            </form>       
              </div><!-- /.box-body -->
              </div>
			<input type="button" value="Done" class="btn btn-success pull-right done_tour_inv"  />
          </div>
          <!--panel-body-->
          </div>
          <!--panel-default-->
      </p>
    </div>