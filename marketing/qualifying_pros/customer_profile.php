<?php
$industry="";$size_location="";
$qp_cp_row=NULL;
$ind_selected[]="";
$qp_cl_data="";
if(!empty($address_id))
{
$industry=$cm->u_value("qp_customer_profile","ind_base_on","address_id=".$address_id."");
$size_location=$cm->u_value("qp_customer_profile","cp_size_loc_dep","address_id=".$address_id."");
//editable data from qualyfing prospects customer profile ..........................
$qp_cp_result=$cm->selectData("qp_customer_profile","address_id=".$address_id."");
$qp_cp_row=$qp_cp_result->fetch_assoc();
// indestry editable data
$ind_selected=explode(",",$qp_cp_row['ind_selected']);
}
?>
<div id="cust-pro" class="tab-pane fade in active">
  <div class="panel-default panel panel-body">
  <form>
    <div class="col-md-6">
      <div class="form-group">
        <label class="checkbox-inline">
          <input type="checkbox" class="customer-profile" value="industry"
          <?php if(!empty($industry)) echo 'checked'?>>
          Industry </label>
        <label class="checkbox-inline">
          <input type="checkbox" class="customer-profile" value="size-location" <?php if(!empty($size_location)) echo 'checked'?>>
          Size & Location </label>
        <label class="checkbox-inline">
          <input type="checkbox" value="ideal-use" class="customer-profile">
          Idle Use Case</label>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="industry-types" <?php if(!empty($industry)) echo 'style="display:block;"'; else echo 'style="display:none;"' ?>>
      <h3><i class="fa fa-angle-double-right"></i>Industry</h3>
      <div class="col-md-2">
        <div class="form-group">
          <select class="form-control input-sm industry-based-on" name="ind_base_on">
            <option value="">Industry Base On</option>
            <?php echo $marketing->ind_base_on($qp_cp_row['ind_base_on']) ?>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <div class="button-group">
            <button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            Select.....<span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li class="pb"><a href="#" class="small" data-value="option1" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Leather" <?php if(in_array('Leather',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Leather</a></li>
              <li class="pb"><a href="#" class="small" data-value="option2" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="FMGC" <?php if(in_array('FMGC',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;FMGC</a></li>
              <li class="pb"><a href="#" class="small" data-value="option3" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Textile" <?php if(in_array('Textile',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Textile</a></li>
              <li class="pb"><a href="#" class="small" data-value="option4" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Chemical" <?php if(in_array('Chemical',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Chemical</a></li>
              <li class="pb"><a href="#" class="small" data-value="option5" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Pharmaceutical" <?php if(in_array('Pharmaceutical',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Pharmaceutical</a></li>
              <li class="pb"><a href="#" class="small" data-value="option6" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Engineering" <?php if(in_array('Engineering',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Engineering</a></li>
                <li class="pb"><a href="#" class="small" data-value="option7" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Agriculture" <?php if(in_array('Agriculture',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Agriculture</a></li>
                <li class="pb"><a href="#" class="small" data-value="option8" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Electrical & Electronics" <?php if(in_array('Electrical & Electronics',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Electrical & Electronics</a></li>
                <li class="sb"><a href="#" class="small" data-value="option9" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Retail & Wholesale" <?php if(in_array('Retail & Wholesale',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Retail & Wholesale</a></li>
                <li class="sb"><a href="#" class="small" data-value="option10" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Tourism"  <?php if(in_array('Tourism',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Tourism</a></li>
                <li class="sb"><a href="#" class="small" data-value="option11" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="I.T" <?php if(in_array('I.T',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;I.T</a></li>
                <li class="sb"><a href="#" class="small" data-value="option12" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Education" <?php if(in_array('Education',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Education</a></li>
                <li class="sb"><a href="#" class="small" data-value="option13" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Health" <?php if(in_array('Health',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Health</a></li>
                <li class="sb"><a href="#" class="small" data-value="option6" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Telecom" <?php if(in_array('Telecom',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Telecom</a></li>
                <li class="sb"><a href="#" class="small" data-value="option14" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Professional" <?php if(in_array('Professional',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Professional</a></li>
                <li class="sb pb"><a href="#" class="small" data-value="option15" tabIndex="-1">
                <input type="checkbox" name="ind_selected[]" value="Others" <?php if(in_array('Others',$ind_selected)): echo 'checked'; endif; ?>/>
                &nbsp;Others</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="No of Supplier" name="no_supplier"
          value="<?php echo $qp_cp_row['no_supplier']  ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Internal Employee" name="internal_employee"
          value="<?php echo $qp_cp_row['internal_employee']  ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="External Employee" name="external_employee"
          value="<?php echo $qp_cp_row['external_employee']  ?>">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Others Details" name="ind_other_details">
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="size-locations" <?php if(!empty($size_location)) echo 'style="display:block;"'; else echo 'style="display:none;"' ?>>
      <h3><i class="fa fa-angle-double-right"></i>Size & Location</h3>
      <div class="col-md-12">
        <div class="form-group">
          <div class="button-group">
            <button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            Select Functional Department<span class="caret"></span></button>
            <ul class="dropdown-menu">
              <?php echo $marketing->functional_dep($qp_cp_row['cp_size_loc_dep']); ?>
                <li><a href="#" class="small" data-value="" tabIndex="-1">
                <input type="text" name="cp_size_loc_dep[]" placeholder="Other Functional department" class="form-control input-sm"/></a></li>
          </ul>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <h4><i class="fa fa-angle-double-right"></i>Finacial</h4>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" placeholder="Brand Value" class="form-control input-sm f_brand_val" name="brand_val" onkeyup="comp_f_wealth()" value="<?php echo $qp_cp_row['brand_val'] ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" placeholder="Assets Value" class="form-control input-sm f_assets_val" name="assets_val" onkeyup="comp_f_wealth()" value="<?php echo $qp_cp_row['assets_val'] ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" placeholder="Company Finacially Wearth" class="form-control input-sm f_comp_finacialy_wealth" name="comp_finacial_wealth" value="<?php echo $qp_cp_row['comp_finacial_wealth'] ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" placeholder="Annual Turnover" class="form-control input-sm" name="annual_turnover"
         value="<?php echo $qp_cp_row['annual_turnover'] ?>" >
        </div>
      </div>
      <div class="clearfix"></div>
      <h4><i class="fa fa-angle-double-right"></i>No OF Offices locations</h4>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Location" name="location[]"
          >
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Wherehouse" name="wherehouse[]">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Manufacturing Unit"  name="manufacturing_unit[]">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Dispaly Center" name="display_center[]">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-8">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Other Details" name="other_details[]">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-sm" onClick="office_locations()"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <?php
	  // qualifying prospects customer profile(Offices Location)
	  if(!empty($address_id)){
		  $qp_ol_data="";
	  $qp_ofl_result=$cm->selectData("qp_cp_offices_location","address_id=".$address_id."");
		  // fetch offices location
		  while($ofl_row=$qp_ofl_result->fetch_assoc())
		  {
		  $qp_ol_data.= '
		  		<div class="rem-office-loc"><div class="clearfix"></div><div class="col-md-2">
					<div class="form-group">
						<input type="text" class="form-control input-sm" placeholder="Location" name="location[]"
						value="'.$ofl_row['location'].'">
					</div>
                </div>
                <div class="col-md-2">
					<div class="form-group">
						<input type="text" class="form-control input-sm" placeholder="Wherehouse" name="wherehouse[]"
						value="'.$ofl_row['wherehouse'].'">
					</div>
                </div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" class="form-control input-sm" placeholder="Manufacturing Unit" name="manufacturing_unit[]" value="'.$ofl_row['manufacturing_unit'].'">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" class="form-control input-sm" placeholder="Dispaly Center" name="display_center[]"
						value="'.$ofl_row['display_center'].'">
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="text" class="form-control input-sm" placeholder="Other Details" name="other_details[]"
						value="'.$ofl_row['location'].'">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-sm rem-off-loc"><i class="fa fa-remove"></i></button>
					</div>
				</div></div>
				<div class="clearfix"></div>
		  	';
		  }
		  echo $qp_ol_data;
	  }
	  ?>
      <div class="office-locations"></div>
      <div class="clearfix"></div>
      <h4><i class="fa fa-angle-double-right"></i>No OF Clients</h4>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="B2B Clients" name="b2b"
          value="<?php echo $qp_cp_row['b2b_clients'] ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="B2C Clients" name="b2c"
          value="<?php echo $qp_cp_row['b2c_clients'] ?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Total Clients" name="total_clients"
          value="<?php echo $qp_cp_row['total_clients'] ?>">
        </div>
      </div>
      <div class="clearfix"></div>
      <h4><i class="fa fa-angle-double-right"></i>Certification & Licenses</h4>
      <?php
	  if(!empty($address_id))
	  {
	  //certification and License editing list
	  $qp_cl_result=$cm->selectData("qp_cp_size_loc_certificate_license", "address_id=".$address_id."");
	  $qp_cl_data="";
	  while($cl_row=$qp_cl_result->fetch_assoc())
	  {
		  $qp_cl_data.= '
		  	<div class="rem-cer-lic"><div class="col-md-2">
				<div class="form-group">
					<input type="text" class="form-control input-sm" placeholder="Certification" name="certificaton[]"
					value="'.$cl_row['certificaton'].'">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<input type="text" class="form-control input-sm" placeholder="Lienses" name="license[]"
					value="'.$cl_row['license'].'">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-8">
				<div class="form-group">
					<input type="text" class="form-control input-sm" placeholder="Other Details" name="other_det[]"
					value="'.$cl_row['other_det'].'">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<button class="btn btn-primary btn-sm rem-cer-lic">
					<i class="fa fa-remove"></i></button>
				</div>
			</div>
			<div class="clearfix"></div></div>
		  	';
	  }
	  }
	  
	   ?>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Certification" name="certificaton[]">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="License" name="license[]">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-8">
        <div class="form-group">
          <input type="text" class="form-control input-sm" placeholder="Other Details" name="other_det[]">
        </div>
      </div>
       <div class="col-md-2">
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-sm" onClick="cer_license()"> <i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="clearfix"></div>
      <?php echo $qp_cl_data; ?>
      <div class="div-certification-lic"></div>
    </div>
    <!--size&Location-->
    <div class="idle-users" style="display:none;">
      <h3><i class="fa fa-angle-double-right"></i>Ideal Use Case</h3>
      <div class="col-md-2">
        <div class="form-group">
          <select class="form-control input-sm">
            <option value="">Select Ideal User</option>
            <?php echo $marketing->idle_usecase() ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12">
    <?php 
	if(empty($address_id))
	{
		echo '<button type="button" value="qp-cp" class="btn btn-primary nested_btnNext pull-right" 
        style="margin-left:5px !important;">
        <i class="fa fa-fw fa-hand-o-right"></i> Save & Continue</button>              	
        <a class="btn btn-primary btnNext pull-right"><i class="fa fa-save"></i> Save</a>';
	}
	else
	{
		echo '<button type="button" class="btn btn-primary pull-right update_qp" value="qp-cp">Update</button>';
	}
	 ?>
   </div>
   </form>
  </div>
</div>