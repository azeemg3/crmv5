<div id="ub" class="tab-pane fade">
      <h3></h3>
      <p>
      <div class="panel panel-default">
      		<form id="ub_form">
            <div class="col-lg-2 col-sm-3">
                <div class="form-group">
                  <label>Issue Date:</label>
                  <input class="form-control date input-sm" name="issue_date" value="" type="text" placeholder="Issue Date">
               </div>
            <!-- form--group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2 col-sm-3">
                <div class="form-group">
                  <label>Branch:</label>
                  <select class="form-control input-sm" name="branch">
                  </select>
               </div>
            <!-- form--group-->
            </div>
            <!--co-lg-2-->
            <div class="col-lg-2 col-sm-3">
                <div class="form-group">
                  <label>UB No:</label>
                  <input type="text" name="ub_no" class="form-control input-sm" / placeholder="UB No">
               </div>
            <!-- form--group-->
            </div>
            <!--co-lg-3-->
            <div class="col-lg-3 col-sm-3">
                <div class="form-group">
                  <label>Select Spo:</label>
                  <select class="form-control input-sm" name="spo">
               	 </select>
               </div>
            <!-- form--group-->
            </div>
            <!--co-lg-3-->
            <div class="panel-body">
            	<div class="col-lg-12 col-sm-12 col-xs-12 row">
                    <h3>Client Details:</h3>
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                          <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                    <th>Client name:*</th>
                                    <th>Vender Name:*</th>
                                    <th>Quantity:</th>
                                    <th>Purchase Price:</th>
                                    <th>Sales Price</th>
                                </tr>
                        </thead>
                        <tr>
                            <td>
                                <div class="form-group">
                                  <input type="text" name="clinet_name" id="ub_client_name" value="" >
                               </div>
                              <!-- form--group-->
                            </td>
                            <td>
                                <div class="form-group">
                                  <input type="text" name="vender_name" id="ub_vender_name" value="" >
                               </div>
                              <!-- form--group-->
                            </td>
                            <td>
                                <div class="form-group">
                                  <input type="text" name="quantity" id="v_visa_q" value="" >
                               </div>
                              <!-- form--group-->
                            </td>
                            <td>
                                <div class="form-group">
                                  <input type="text" name="v_p_price" id="v_p_price" onChange="visa()" value="" >
                               </div>
                              <!-- form--group-->
                            </td>
                            <td>
                                <div class="form-group">
                                  <input type="text" name="v_s_price" id="v_s_price" onChange="visa()" value="" >
                               </div>
                              <!-- form--group-->
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2" align="right"><strong>Total Purchase Price</strong></td>
                            <td><strong id="v_t_p_p"></strong></td>
                            <td><strong>Total Sale Price</strong></td>
                            <td><strong id="v_t_s_p"></strong></td>
                        </tr>
                        </table>
               </div>
               <!--table--responsive-->
               <div class="clearfix"></div>
               <h3>Hotel Sale:</h3>
               <div class="col-lg-12 col-sm-12 xo-routing">
                  <div class="four-per"><strong>Room Type</strong></div>
                  <div class="four-per"><strong>Quantity</strong></div>
                  <div class="four-per"><strong>Date From</strong></div>
                  <div class="four-per"><strong>Date To</strong></div>
                  <div class="four-per"><strong>Nights</strong></div>
                  <div class="four-per"><strong>Purchase Price</strong></div>
                  <div class="four-per"><strong>Sale Price</strong></div>
             </div>
             <!--col-lg-12-->
              <div class="col-lg-12 col-sm-12 xo-routing-2">
                  <div class="four-per-1">
                    <select name="room_type[]" id="room_type" class="routing-input" style="height:26px;">
                  		<option value="">Select</option>
                  	</select>
                 </div>
                  <div class="four-per-1">
                  	<input type="text" name="h_q[]" class="routing-input" id="h_q_0">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="date_frm[]" id="date_frm" class="routing-input date" value="" >
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="date_to[]" id="date_to" class="routing-input date" value="" onChange="count_night()">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="nights[]" id="nights_0" value="" class="routing-input">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="h_p_price[]" id="p_price_0" value="" class="routing-input" onChange="total_price()">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="h_s_price[]" id="s_price_0" class="routing-input" onChange="total_price()">
                  </div>
             </div>
             <!--col-lg-12-->
             <div class="clearfix"></div>
             <div class="col-lg-12 col-sm-12 xo-routing-2">
             	<div class="four-per-1"><strong class="pull-right">Vender Name:</strong></div>
                <div class="four-per-1"><input type="text" name="h_vender_name[]" class="routing-input"></div>
             	 <div class="four-per-1">
                  	<span><strong>Total Purchase Price</strong></span>
                  </div>
                  <div class="four-per-1">
                  	<input type="text"  id="t_p_price_0" name="h_t_p_price[]" class="routing-input" >
                  </div>
                  <div class="four-per-1">
                  	<span><strong>Total Sale Price</strong></span>
                  </div>
                  <div class="four-per-1">
                  	<input type="text" id="t_s_price_0" name="h_t_s_price[]" class="routing-input" >
                  </div>
                  <div class="four-per-1"><input type="button" value="+" onClick="add_hotel()"></div>
                  <div class="clearfix"></div>
                </div>
             <!--col-lg-12-->
             <div class="clearfix"></div>
              <hr style="border-color:black;">
              <div id="add_hotel"></div>
             <h3>Transports:</h3>
               <div class="col-lg-12 col-sm-12 xo-routing">
                  <div class="four-per"><strong>Vender Name</strong></div>
                  <div class="four-per"><strong>Quantity</strong></div>

                  <div class="four-per"><strong>Sector</strong></div>
                  <div class="four-per"><strong>Date</strong></div>
                  <div class="four-per"><strong>Purchase Price</strong></div>
                  <div class="four-per"><strong>Sale Price</strong></div>
             </div>
             <!--col-lg-12-->
             <div class="clearfix"></div>
             <div class="col-lg-12 col-sm-12 xo-routing-2">
                  <div class="four-per-1">
                   <input type="text" name="t_vender_name[]" class="routing-input" value="">
                 </div>
                  <div class="four-per-1">
                  	<input type="text" name="t_q[]" class="routing-input" id="t_q_0">
                  </div>
                   <div class="four-per-1">
                  	<input type="text" name="t_sector[]" class="routing-input">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="t_date[]" id="" class="routing-input date" value="" >
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="trans_p_price[]" id="trans_p_price_0" class="routing-input" onChange="total_transport()">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="trans_s_price[]"  id="trans_s_price_0" class="routing-input" onChange="total_transport()">
                  </div>
             </div>
             <!--col-lg-12-->
             <div class="clearfix"></div>
             <div class="col-lg-12 col-sm-12 xo-routing-2">
             	<div class="four-per-1">
                  	<span><strong></strong></span>
                  </div>
             	 <div class="four-per-1">
                  	<span><strong>Total Purchase Price</strong></span>
                  </div>
                  <div class="four-per-1">
                    <input type="text"  name="trans_t_p_price[]" id="trans_t_p_price_0" class="routing-input" readonly   />
                  </div>
                  <div class="four-per-1">
                  	<span><strong>Total Sale Price</strong></span>
                  </div>
                  <div class="four-per-1">
                  	<input type="text"  name="trans_t_s_price[]" id="trans_t_s_price_0" class="routing-input" readonly>
                  </div>
                  <div class="four-per-1"><input type="button" value="+" onClick="add_transport()"></div>
                </div>
             <!--col-lg-12-->
              <div class="clearfix"></div>
              <hr style="border-color:black;">
              <div id="add_transport"></div>
              <h3>Others:</h3>
               <div class="col-lg-12 col-sm-12 xo-routing">
                  <div class="four-per"><strong>Vender Name</strong></div>
                  <div class="four-per"><strong>Quantity</strong></div>
                  <div class="four-per"><strong>Sector</strong></div>
                  <div class="four-per"><strong>Date</strong></div>
                  <div class="four-per"><strong>Purchase Price</strong></div>
                  <div class="four-per"><strong>Sale Price</strong></div>
             </div>
             <!--col-lg-12-->
             <div class="clearfix"></div>
             <div class="col-lg-12 col-sm-12 xo-routing-2">
                  <div class="four-per-1">
                   <input type="text" name="o_vender_name[]" class="routing-input" value="">
                 </div>
                  <div class="four-per-1">
                  	<input type="text" name="o_q[]" id="o_q_0" class="routing-input">
                  </div>
                   <div class="four-per-1">
                  	<input type="text" name="o_sector[]" class="routing-input">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="o_date[]" id="" class="routing-input date" value="" >
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="o_p_price[]" id="o_p_price_0" class="routing-input" onChange="total_others()">
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="o_s_price[]" id="o_s_price_0" class="routing-input" onChange="total_others()">
                  </div>
             </div>
             <!--col-lg-12-->
              <div class="clearfix"></div>
             <div class="col-lg-12 col-sm-12 xo-routing-2">
             	<div class="four-per-1">
                  	<span><strong></strong></span>
                  </div>
             	 <div class="four-per-1">
                  	<span><strong>Total Purchase Price</strong></span>
                  </div>
                  <div class="four-per-1">
                  	<input type="text" name="o_t_p_price[]" id="o_t_p_price_0" class="routing-input" readonly>
                  </div>
                  <div class="four-per-1">
                  	<span><strong>Total Sale Price</strong></span>
                  </div>
                  <div class="four-per-1">
                  	<input type="text" class="routing-input" id="o_t_s_price_0" name="o_t_s_price[]" readonly>
                  </div>
                  <div class="four-per-1"><input type="button" value="+" onClick="add_others()"></div>
                   <div class="clearfix"></div>
              		<hr style="border-color:black;">
              <div id="add_others"></div>
             </div>
             	<h3>Packages Details:</h3>
                   <div class="col-lg-12 col-sm-12">
                   <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Package Type*</label>
                            <input type="text" name="ub_pkg_type[]" id="ub_pkg_type" class="form-control input-sm" placeholder="Package Type">
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-3">
                        <div class="form-group row">
                            <label>Quantity</label>
                            <input type="text" name="ub_pkg_qty[]" id="ub_pkg_qty" class="form-control input-sm" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type="text" name="ub_pkg_p[]" id="ub_pkg_p" class="form-control input-sm" onKeyUp="total_ub_pkg()" placeholder="Purchase Price">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label> Sale Price</label>
                            <input type="text" name="ub_pkg_s[]" id="ub_pkg_s" class="form-control input-sm" onKeyUp="total_ub_pkg()" placeholder="Sale Price">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Total Purchase Price</label>
                            <input type="text" name="ub_pkg_tp[]" readonly id="ub_pkg_tp" class="form-control input-sm" placeholder="Total Purchase Price">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-3">
                        <div class="form-group">
                            <label>Total Sale Price</label>
                            <input type="text" name="ub_pkg_ts[]" readonly id="ub_pkg_ts" class="form-control input-sm" placeholder="Total Sale Price">
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-3">
                    	<div class="form-group mbtn-top">
                    	<input type="button" value="+" onClick="add_ub_pkg()">
                    	</div>

                    </div>	
                 </div>
                 <!--col-lg-12-->
             <div class="clearfix"></div>
             	<div id="pkg_det"></div>
                <hr style="border-color:black;">
                  <div class="col-lg-2 col-xs-12 col-sm-3 pull-right">
                    <input type="button" value="Create Ub" class="btn btn-success col-xs-12 col-sm-12" onClick="add_ub()">
                    </div>
                </div>
             <!--col-lg-12-->
            </div>
            <!-- panel-body-->
            </form>
          </div>
          <!--panel-default-->
          </p>
    </div>