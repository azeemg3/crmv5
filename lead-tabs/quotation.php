<div id="quotation" class="tab-pane fade">
      <h1 class="main-heading" style="border-radius: 4px; padding: 10px;font-size: 18px;color: white;">Quotation</h1>
      <p>
      	<form id="form">
          <div class="col-lg-2 col-sm-3">
            <div class="form-group">
              <label>Branch:</label>
              <select class="form-control input-sm" name="branch">
              <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
              </select>
           </div>
            <!-- form--group-->
          </div>
           <!--co-lg-2-->
           <div class="col-lg-2">
        	<div class="form-group">
            <label>Select Currency</label>
            	<select class="form-control input-sm" name="currency_type" required>
                	<option value="">Select Currency</option>
                    <option value="usd">USD</option>
                    <option value="PKR">PKR</option>
                    <option value="Sar">SAR</option>
                    <option value="euro">EURO </option>
                    <option value="aed">AED</option>
                </select>
            </div>
        </div>
        <!--col-lg-2-->
        <div class="col-lg-2 col-sm-3">
                <div class="form-group">
                  <label>Select Spo:</label>
                  <select class="form-control input-sm" name="spo" required>
                  <?php echo $cm->spo($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
               	 </select>
               </div>
            <!-- form--group-->
            </div>
            <!--co-lg-2-->
        <div class="clearfix"></div>
        
        
        
             <div class="box box-solid collapsed-box" style="border-top: 3px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Visa Information</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              <div class="box-body no-padding">
                <div class="col-md-12 topmargin-five">
        	<div class="panel-body">
                    <div class="col-lg-1 col-sm-3">
                        <div class="form-group">
                            <label>Adult</label>
                            <input type="text" name="q_adult" onChange="q_t_visa()" id="q_adult" placeholder="Qty" 
                            class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-1-->
                    <div class="col-lg-1 col-sm-3">
                        <div class="form-group row">
                            <input type="text" nchange="q_t_visa()" name="q_a_rate" id="q_a_rate" placeholder="Rate" onChange="q_t_visa()"
                            class="form-control input-sm row top-left" style="margin-top: 25px;margin-left: -6px;" />
                        </div>
                    </div>
                    <!--col-lg-1-->
                    <div class="col-lg-1 col-sm-3 row">
                        <div class="form-group">
                            <input type="button" value="+" class="btn-top25" style="margin-top: 26px;" />
                        </div>
                    </div>
                    <!--col-lg-1-->
                    <div class="col-lg-1 col-sm-3 row">
                        <div class="form-group">
                            <label>Child</label>
                            <input type="text" name="q_child" id="q_child" onChange="q_t_visa()"  placeholder="Qty" 
                            class="form-control input-sm row" />
                        </div>
                    </div>
                    <!--col-lg-1-->
                    <div class="col-lg-1 col-sm-3">
                        <div class="form-group row">
                            <input type="text" name="q_ch_rate" id="q_ch_rate" onChange="q_t_visa()" placeholder="Rate" 
                            class="form-control input-sm row top-left" style="margin-top: 25px;margin-left: -6px;" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 row">
                        <div class="form-group">
                            <input type="button" value="+" class="btn-top25" style="margin-top: 26px;" />
                        </div>
                    </div>
                    <!--col-lg-1-->
                    <div class="col-lg-1 col-sm-3 row">
                        <div class="form-group">
                            <label>Infant</label>
                            <input type="text" name="q_infant" id="q_infant" placeholder="Qty" onChange="q_t_visa()" 
                            class="form-control input-sm row" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3">
                        <div class="form-group row">
                            <input type="text" name="q_inf_rate" id="q_inf_rate" placeholder="Rate" onChange="q_t_visa()" 
                            class="form-control input-sm row top-left" style="margin-top: 25px;margin-left: -6px;" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    
                    <div class="col-lg-1 col-sm-3 row">
                        <div class="form-group">
                            <input type="button" value="=" class="btn-top25" style="margin-top: 26px;" />
                        </div>
                    </div>
                    <!--col-lg-1-->
                    <div class="col-lg-2 col-sm-3 row">
                        <div class="form-group row">
                            <label>Total</label>
                            <input type="text" name="q_total_rate" id="q_total_rate" placeholder="Total" 
                            class="form-control input-sm"/>
                        </div>
                    </div>
                    <!--col-lg-2-->
                    </div>
                    <!--panel-default-->
                    </div>

              </div><!-- /.box-body -->
              </div>
        
        
        <div class="box box-solid collapsed-box" style="border-top: 3px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Accommodation</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              <div class="box-body no-padding">
                <div class="col-md-12 topmargin-five">
        	<div class="panel-body">
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Hotel Name</label>
                            <input type="text" name="q_h_name[]" id="q_h_name_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding">
                        <div class="form-group">
                            <label>Check In</label>
                            <input type="text" name="q_h_check_in[]" id="q_h_check_in_0"  class="date form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>CheckOut</label>
                            <input type="text" name="q_h_check_out[]" id="q_h_check_out_0"   
                            class="date form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>Nights</label>
                            <input type="text" name="q_h_nights[]" id="q_h_nights_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>RoomType</label>
                            <input type="text" name="q_h_r_type[]"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="text" name="q_h_qty[]" id="q_h_qty_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>Rate</label>
                            <input type="text" name="q_h_rate[]" id="q_h_rate_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="q_h_toal[]" id="q_h_toal_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                     <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group mbtn-top">
                            <input type="button" class="btn btn-success" onClick="accommodation()" value="+" style="margin-top:23px;"/>
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="clearfix"></div>
                    <div id="add_accommodation"></div>
            	</div>
                    <!--panel-default-->
                    </div>

              </div><!-- /.box-body -->
              </div>
              
              
              
              
              
              
              <div class="box box-solid collapsed-box" style="border-top: 3px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Transportation</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              <div class="box-body no-padding">
                <div class="col-md-12 topmargin-five">
        	<div class="panel-body">
                	<div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Transport Name</label>
                            <input type="text" name="q_t_name[]" id="q_t_name_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <input type="text" name="q_t_veh_type[]" id="q_t_veh_type_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Sector</label>
                            <input type="text" name="q_t_sector[]" id="q_t_sector_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Rate</label>
                            <input type="text" name="q_t_rate[]" id="q_t_rate_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding">
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="text" name="q_t_qty[]" id="q_t_qty_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="q_t_total[]" id="q_t_total_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group mbtn-top">
                            <input type="button" class="btn btn-success" onClick="add_q_trans()" value="+" style="margin-top:23px;" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="clearfix"></div>
                    <div id="add_q_trans"></div>
                </div>
                    <!--panel-default-->
                    </div>

              </div><!-- /.box-body -->
              </div>
              
           
           
           
           
           
       <div class="box box-solid collapsed-box" style="border-top: 3px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Ticket</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              <div class="box-body no-padding">
                <div class="col-md-12 topmargin-five">
        	<div class="panel-body">
                <div class="col-lg-2 col-sm-3">
                   		 <div class="form-group">
                            <label>Passenger Type</label>
                            <select class="form-conrol input-sm" name="q_tkt_p_type[]" id="q_tkt_p_type_0">
                            	<option value="adult">Adult</option>
                                <option value="child">Child</option>
                                <option value="infant">Infant</option>
                            </select>
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding">
                        <div class="form-group row">
                            <label>Air Line</label>
                            <input type="text" name="q_airline[]" id="q_airline_0" class="row form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 marginlft-five">
                        <div class="form-group row">
                            <label>Date</label>
                            <input type="text" name="q_tkt_date[]" id="q_tkt_date_0"  class="date form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3">
                   		 <div class="form-group">
                            <label>Sector</label>
                            <input type="text" name="q_tkt_sec_frm[]" placeholder="From"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                     <div class="col-lg-1 col-sm-3">
                   		 <div class="form-group">
                            <input type="text" name="q_tkt_sec_to[]" placeholder="To"  
                            class="form-control input-sm btn-top25 row" style="margin-top: 25px;"/>
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 row">
                   		 <div class="form-group">
                            <label>Dep</label>
                            <input type="text" name="q_tkt_dep[]" placeholder="From"  class="form-control input-sm row" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                     <div class="col-lg-1 col-sm-3">
                   		 <div class="form-group">
                         	<label>Arr</label>
                            <input type="text" name="q_tkt_arr[]" placeholder="To"  
                            class="form-control input-sm row" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3">
                   		 <div class="form-group row">
                            <label>Qty</label>
                            <input type="text" name="q_tkt_qty[]" id="q_tkt_qty_0" class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 marginlft-five">
                   		 <div class="form-group row">
                            <label>Rate</label>
                            <input type="text" name="q_tkt_rate[]" id="q_tkt_rate_0" class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 padding-zero marginlft-five">
                   		 <div class="form-group row">
                            <label>Total</label>
                            <input type="text" name="q_tkt_total[]" id="q_tkt_total_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group mbtn-top">
                            <input type="button" class="btn btn-success" onClick="add_q_ticket()" value="+" style="margin-top:23px;" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="clearfix"></div>
                    <div id="add_q_ticket"></div>
                 </div>
                    <!--panel-default-->
                    </div>

              </div><!-- /.box-body -->
              </div>    
           
           
           
           
           
           
           
         <div class="box box-solid collapsed-box" style="border-top: 3px solid #3c8dbc;">
                <div class="box-header with-border">
                  <h3 class="box-title">Other Services</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              <div class="box-body no-padding">
                <div class="col-md-12 topmargin-five">
        	<div class="panel-body">
            		<div class="col-lg-2 col-sm-3">
                   		 <div class="form-group">
                            <label>Service Name</label>
                            <input type="text" name="q_o_ser[]" id="q_o_ser_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                   		 <div class="form-group">
                            <label>Rate</label>
                            <input type="text" name="q_o_rate[]" id="q_o_rate_0"  class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                   		 <div class="form-group">
                            <label>Qty</label>
                            <input type="text" name="q_o_qty[]" id="q_o_qty_0" class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="col-lg-2 col-sm-3">
                   		 <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="q_o_total[]" id="q_o_total_0" class="form-control input-sm" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="clearfix"></div>
                    <div class="col-lg-8">
                    	<div class="form-group">
                        	<textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                     <div class="col-lg-1 col-sm-3 zero-padding marginlft-five">
                        <div class="form-group mbtn-top">
                            <input type="button" class="btn btn-success" onClick="o_q_ser()" value="+" />
                        </div>
                    </div>
                    <!--col-lg-2-->
                    <div class="clearfix"></div>
                    <div id="o_q_ser"></div>
            	</div>
                    <!--panel-default-->
                    </div>

              </div><!-- /.box-body -->
              </div>  
           
          <div class="col-lg-2 pull-right">
          	<input type="button"  value="Add Quotation" onClick="add_quotation()" class="btn btn-success">
          </div>
         </form>
         <div class="col-lg-12 topmargin-five">
         <div class="table-responsive">
           <table class="table table-bordered">
           		  <thead>
                  	<tr>
                    	<td colspan="11">
                        <div class="col-lg-2">
                         <form id="ref_form" role="form" class="form-horizontal">
                            <div class="form-horizontal form-group">
                                <input type="text" name="q_ref" placeholder="Quotation Ref" class="form-control input-sm" autocomplete="off" 
                                onkeyup="get_quotation()"  />
                            </div>
                            </form>
        				 </div>
                        </td>
                    </tr>
                  </thead>
                  <thead>
                  <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                  <th>#</th>
                    <th>Lead Id</th>
                    <th>Create Date</th>
                    <th>Branch</th>
                    <th>Visa Amount</th>
                    <th>Accommodation Amount</th>
                    <th>Transport Amount</th>
                    <th>Ticket Amount</th>
                    <th>Other Amount</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody id="get_quotation">
                 </tbody>
            </table>
            </div>
            <!-- responsive-->
           </div>
      </p>
    </div>