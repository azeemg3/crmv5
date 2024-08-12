<?php
//editable data from businesss information ..........................
$bi_row=NULL;
if(!empty($address_id))
{
$bi_result=$cm->selectData("ab_bus_info","address_id=".$address_id."");
$bi_row=$bi_result->fetch_assoc();
}
?>
<div id="business-info" class="tab-pane fade">
<form>
        	<h3><i class="fa fa-angle-double-right"></i>Business Information</h3>
          <div class="panel panel-default panel-body">
          	<div class="col-md-3">
            	<div class="form-group">
                	<label>Company Name</label>
                    <input type="text" class="form-control input-sm" name="comp_name" value="<?php echo $bi_row['comp_name'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Type of Business</label>
                    <select class="form-control input-sm" name="bus_type">
                    	<option>Select...</option>
						<?php echo $marketing->business_type($bi_row['bus_type']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Size of Business</label>
                    <input type="text" class="form-control input-sm" name="bus_size" value="<?php echo $bi_row['bus_size'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Business Location</label>
                    <input type="text" class="form-control input-sm" name="bus_location" value="<?php echo $bi_row['bus_location'] ?>">
                </div>
            </div>
            <div class="clearfix"></div>
            <h4><i class="fa fa-angle-double-right"></i>Business Address:</h4>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control input-sm" name="country">
                        	<option value="">Select...</option>
                            <?php echo $cm->countryList($bi_row['country']); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Province</label>
                        <select class="form-control input-sm" name="province">
                        	<?php echo $cm->province($bi_row['province']); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control input-sm" name="city">
                        	<option value="">Select...</option>
                            <?php echo $cm->cities($bi_row['city']); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Area</label>
                       <input type="text" name="area" class="form-control input-sm" value="<?php echo $bi_row['area'] ?>">
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Phone</label>
                       <input type="text" name="phone" class="form-control input-sm" value="<?php echo $bi_row['phone'] ?>">
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Email</label>
                       <input type="text" name="email" class="form-control input-sm" value="<?php echo $bi_row['email'] ?>">
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Website</label>
                       <input type="text" name="website" class="form-control input-sm" value="<?php echo $bi_row['website'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Other</label>
                        <input type="text" name="other_det" class="form-control input-sm" value="<?php echo $bi_row['other_det'] ?>">
                    </div>
                </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Market Served</label>
                    <input type="text" class="form-control input-sm" name="market_served" value="<?php echo $bi_row['market_served'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Organization</label>
                    <input type="text" class="form-control input-sm" name="organization" value="<?php echo $bi_row['organization'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Management Types</label>
                    <input type="text" class="form-control input-sm" name="management_types" value="<?php echo $bi_row['management_types'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Credit Rating</label>
                    <input type="text" class="form-control input-sm" name="credit_rating" value="<?php echo $bi_row['credit_rating'] ?>">
                </div>
            </div>
             <div class="col-md-3">
            	<div class="form-group">
                	<label>Key Personals</label>
                    <input type="text" class="form-control input-sm" name="key_personals" value="<?php echo $bi_row['key_personals'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Product-Line</label>
                    <input type="text" class="form-control input-sm" name="product_line" value="<?php echo $bi_row['product_line'] ?>">
                </div>
            </div>
            <div class="col-md-3">
    	<div class="form-group">
        	<div class="button-group">
            	<label>Policeis</label>
            	<button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            	Policeis<span class="caret"></span></button>
                <ul class="dropdown-menu drp-group">
              	 <li>
                  <a href="#" class="small" data-value="vendor_policies" tabIndex="-1">
                    <input type="text" placeholder="Vendor Policies & Procedure" name="vendor_policies" 
                    value="<?php echo $bi_row['vendor_policies'] ?>"/></a>
                 </li>
                 <li>
                  <a href="#" class="small" data-value="payment_policies" tabIndex="-1">
                    <input type="text" placeholder="Payment Policies & Procedure" name="payment_policies"
                    value="<?php echo $bi_row['payment_policies'] ?>"/></a>
                 </li>
                 <li>
                  <a href="#" class="small" data-value="purchase_policies" tabIndex="-1">
                    <input type="text" placeholder="Purchase Policies & Procedure" name="purchase_policies"
                     value="<?php echo $bi_row['purchase_policies'] ?>"/></a>
                 </li>
             </ul>
            </div>
        </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Partinent Routines & Procedure</label>
                    <input type="text" class="form-control input-sm" name="partinent_routines" value="<?php echo $bi_row['partinent_routines'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Terminology</label>
                    <input type="text" class="form-control input-sm" name="termonology" value="<?php echo $bi_row['termonology'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Majore income & Expense items</label>
                    <input type="text" class="form-control input-sm" name="major_income" value="<?php echo $bi_row['major_income'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Competetion</label>
                    <input type="text" class="form-control input-sm" name="competetion" value="<?php echo $bi_row['competetion'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Previous Experience</label>
                    <input type="text" class="form-control input-sm" name="prev_exp" value="<?php echo $bi_row['prev_exp'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Problems</label>
                    <input type="text" class="form-control input-sm" name="problems" value="<?php echo $bi_row['problems'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Future Prospects</label>
                    <input type="text" class="form-control input-sm" name="future_pros" value="<?php echo $bi_row['future_pros'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Product User</label>
                    <input type="text" class="form-control input-sm" name="product_user" value="<?php echo $bi_row['product_user'] ?>">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Volume of Possibilites</label>
                    <select class="form-control input-sm" name="vol_poss">
                    	<?php echo $marketing->vol_poss($bi_row['vol_poss']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<label>Purchase Frequency</label>
                    <select class="form-control input-sm" name="purchase_freq">
                    	<?php echo $marketing->pur_freq($bi_row['purchase_freq']) ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
            	<?php if(empty($address_id))
				{
					echo '<button type="button" value="bus_info" class="btn btn-primary btnNext pull-right" 
                    style="margin-left:5px !important;"><i class="fa fa-fw fa-hand-o-right"></i> Save & Continue</button>              	
        			<a class="btn btn-primary btnNext pull-right"><i class="fa fa-save"></i> Save</a>';
				}
				else
				{
					echo '<button type="button" class="btn btn-primary pull-right update_qp" value="bus_info">Update <i class="fa fa-save"></i></button>';
				}
				 ?>
           </div>
            
        </div>
        </form>
      </div>