<div class="modal fade" id="view_tour_sale_edit" role="dialog" style="overflow:auto;">
<input type="hidden" name="uniqueId" />
    <div class="modal-dialog" style="width:80%;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tour Sale</h4>
          <div class="clearfix"></div>
        </div>
        <div class="modal-body">
          <p>
          	<div class="panel panel-default">
                <div class="panel-body">
                <div class="col-lg-2">
                 <div class="form-group">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary">Email Format</button>
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                            <a onclick="tour_e_frmt('tour_email_det')">
                        <span class="glyphicon glyphicon-envelope"></span> Detail Email 
                     </a>
                        </li>
                        <li>
                          <a onclick="tour_e_frmt('tour_email_summery')">
                                <span class="glyphicon glyphicon-envelope"></span> Summery Email 
                          </a>
                        </li>
                      </ul>
                    </div>
             </div>
        	</div>
            <!--col-lg-6-->
            <div class="col-lg-2">
             <div class="form-group">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary">Print Format</button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                  	<li>
                    	<a class="print_det" target="_blank">
          			<span class="glyphicon glyphicon-print"></span> Print in Detail 
        		 </a>
                    </li>
                    <li>
                      <a class="print_summ" target="_blank">
                            <span class="glyphicon glyphicon-print"></span> Print Summery 
                      </a>
                    </li>
                  </ul>
				</div>
             </div>
        	</div>
            <!--col-lg-6-->
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                    <h4>Visa:</h4>
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
              			<thead>
                  			<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
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
                  		</thead>
                  		<tbody id="VtourVisaId"></tbody>
                        </table>
                        </div>
                        <h4>Hotel:</h4>
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped tourHotelId">
                          <thead>
                              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
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
                              <tbody id="VtourHotelId">
                              
                             </tbody>
                         </thead>
            		</table>
                    </div>
                    <h4>Transport:</h4>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                          <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
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
                          <tbody id="VtourTransId">
                         </tbody>
                     </thead>
                    </table>
                    </div>
                    <h4>Tour:</h4>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                          <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
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
                          <tbody id="VtourTourId">
                         </tbody>
                     </thead>
                    </table>
                    </div>
                    <h4>Other Services</h4>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                          <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
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
                          <tbody id="VtourOtherId">
                         </tbody>
                     </thead>
                    </table>
                   </div>
                   <!--table-responsive-->
                   <div class="form-group">
                   	<input type="button" class="form-control btn btn-info view_done_btn" value="Done" />
                   </div>
                    </div>
                    <!-- col-lg-12-->
                </div>
            	<!-- panel-body-->
          	</div>
          	<!--panel-default-->
          </p>

        </div>
      </div>
      
    </div>
  </div>
  <!--End--->