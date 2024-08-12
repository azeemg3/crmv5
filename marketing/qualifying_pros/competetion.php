<?php
$qp_comp_row=NULL;
if(!empty($address_id))
{
//editable data from qualyfing prospects Competetion ..........................
$qp_comp_result=$cm->selectData("qp_competetion","address_id=".$address_id."");
$qp_comp_row=$qp_comp_result->fetch_assoc();

}
?>
<div id="competiton" class="tab-pane fade">
                	<div class="panel-default panel-body panel">
                    <form>
                    	<div class="col-md-12">
                        	<div class="form-group">
                            	<label>Tour Vision Travel Competitors</label>
                                <input type="text" class="form-control input-sm" name="travel_competitor"
                                value="<?php echo $qp_comp_row['travel_competitor'] ?>">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                       <h3><i class="fa fa-angle-double-right"></i>Vendor Info</h3>
                       <div class="col-md-2">
                       	<div class="form-group">
                        	<label>Current Vendor</label>
                            <input type="text" class="form-control input-sm" name="current_vendor"
                            value="<?php echo $qp_comp_row['current_vendor'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div> 
                       <div class="col-md-2">
                       	<div class="form-group">
                        	<label>Ex Vendor</label>
                            <input type="text" class="form-control input-sm" name="ex_vendor"
                            value="<?php echo $qp_comp_row['ex_vendor'] ?>">
                        </div>
                        
                       </div>
                       <div class="col-md-10">
                       	<div class="form-group">
                        	<label>Reason</label>
                            <input type="text" class="form-control input-sm" name="ex_vendor_reason"
                            value="<?php echo $qp_comp_row['ex_vendor_reason'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Vendor Selection Process</label>
                            <input type="text" class="form-control input-sm" name="vendor_salection_process"
                            value="<?php echo $qp_comp_row['vendor_salection_process'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Asking Requirement</label>
                            <input type="text" class="form-control input-sm" name="asking_req"
                            value="<?php echo $qp_comp_row['asking_req'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Offered Requirement</label>
                            <input type="text" class="form-control input-sm" name="offered_req"
                            value="<?php echo $qp_comp_row['offered_req'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Agreed Requirement</label>
                            <input type="text" class="form-control input-sm" name="agreed_req"
                            value="<?php echo $qp_comp_row['agreed_req'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Payment Terms</label>
                            <input type="text" class="form-control input-sm" name="payment_term"
                            value="<?php echo $qp_comp_row['payment_term'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Service Level</label>
                            <input type="text" class="form-control input-sm" name="service_level"
                            value="<?php echo $qp_comp_row['service_level'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <h3><i class="fa fa-angle-double-right"></i>Evaluationg Benchmark</h3>
                       <div class="col-md-2">
                       	<div class="form-group">
                        	<label>Value</label>
                            <input type="text" class="form-control input-sm" name="ev_benchmark_value"
                            value="<?php echo $qp_comp_row['ev_benchmark_value'] ?>">
                        </div>
                       </div>
                       <div class="col-md-2">
                       	<div class="form-group">
                        	<label>Value%</label>
                            <input type="text" class="form-control input-sm"  name="ev_benchmark_val_per"
                            value="<?php echo $qp_comp_row['ev_benchmark_val_per'] ?>">
                        </div>
                       </div>
                       <div class="col-md-2">
                       	<div class="form-group">
                        	<label>Volume</label>
                            <input type="text" class="form-control input-sm" name="ev_benchmark_vol"
                            value="<?php echo $qp_comp_row['ev_benchmark_vol'] ?>">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                       	<div class="form-group">
                        	<label>Evaluating Benchmark</label>
                            <input type="text" class="form-control input-sm" name="ev_benchmark_det"
                            value="<?php echo $qp_comp_row['ev_benchmark_det'] ?>">
                        </div>
                       </div>
                       <div class="col-md-12">
                        <button type="button" value="qp_competetion" class="btn btn-primary pull-right update_qp" 
                        style="margin-left:5px !important;">
                        <i class="fa fa-save"></i> Finish</button>              	
                      </div>
                      </form>
                    </div>
                </div>
                <!--tab-->