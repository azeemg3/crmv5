<?php
//editable data from personal information pi=Personal information
$pi_row=NULL;
if(!empty($address_id))
{
$pi_result=$cm->selectData("ab_personal_info","address_id=".$address_id."");
$pi_row=$pi_result->fetch_assoc();
}
?>
<div class="modal fade check-cnic" id="myModal">
    <div class="modal-dialog"> 
  <!-- Modal content-->
       <div class="alert alert-warning alert-dismissable">	
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Already Exist Information Against This CNIC Number..... 
        <a href="add_contact" class="btn btn-sm btn-info pull-right"  style="margin-left:5px;">Add New</a>
        <form action="add_contact" method="get">
        <button type="submit" class="btn btn-sm btn-primary pull-right exist_add_id" value="" name="address_id"
        style="margin-top:-19px;">Update</button>
        </form>
       </div>
    </div>
  </div>
  <!--====================already exits data e.g mobile and email address==============-->
<div class="modal fade check-ex-val" id="myModal">
    <div class="modal-dialog"> 
  <!-- Modal content-->
       <div class="alert alert-warning alert-dismissable">  
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
         
        <a href="add_contact" class="btn btn-sm btn-info pull-right"  style="margin-left:5px;">Add New</a>
        <form action="add_contact" method="get">
        <button type="submit" class="btn btn-sm btn-primary pull-right exist_add_id" value="" name="address_id"
        style="margin-top:-19px;">Update</button>
        </form>
       </div>
    </div>
  </div>
  <!--========================end===========================-->
<div id="personal-info" class="tab-pane fade">
<form id="FormPersonal_info">
          <h3><i class="fa fa-angle-double-right"></i>Objective Information</h3>
          <div class="panel-body panel panel-default">
          <div class="col-md-2">
            	<div class="form-group">
                	<label>CNIC Number</label>
                    <input type="text" name="cnic_number" value="<?php echo $pi_row['cnic_number'] ?>" 
                    class="form-control input-sm" onchange="check_cnic(this.value)" placeholder="CNIC Number without Dashes"
                    autocomplete="off">
                </div>
            </div>
       		<div class="col-md-2">
            	<div class="form-group">
                	<label>Name</label>
                    <input type="text" name="name" value="<?php echo $pi_row['name'] ?>" class="form-control input-sm">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Gender</label>
                    <select class="form-control input-sm" name="gender">
                    	<?php echo $cm->gender($pi_row['gender']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Birthday</label>
                    <input type="text" class="form-control input-sm" name="birth_date" onChange="date_birth(this.value)" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" id="datemask" value="<?php echo $pi_row['birth_date'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Age</label>
                    <input type="text" class="form-control input-sm age" name="age" value="<?php echo $pi_row['age'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Martial Status</label>
                    <select class="form-control input-sm" name="martial_status">
                    	<?php echo $cm->martial_status($pi_row['martial_status']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Phone</label>
                    <input type="text" class="form-control input-sm" name="phone" value="<?php echo $pi_row['phone'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Mobile</label>
                    <input type="text" class="form-control input-sm" name="mobile" value="<?php echo $pi_row['mobile'] ?>" 
                    onChange="check_exist_val('mobile',this.value)">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Email</label>
                    <input type="text" class="form-control input-sm" name="email" value="<?php echo $pi_row['email'] ?>"
                    onChange="check_exist_val('email',this.value)">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Skype</label>
                    <input type="text" class="form-control input-sm" name="skype" value="<?php echo $pi_row['skype'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Linked In</label>
                    <input type="text" class="form-control input-sm" name="linkedIn" value="<?php echo $pi_row['linkedIn'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Twitter</label>
                    <input type="text" class="form-control input-sm" name="twitter" value="<?php echo $pi_row['twitter'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>What's App</label>
                    <input type="text" class="form-control input-sm" name="whatApp" value="<?php echo $pi_row['whatApp'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Immo</label>
                    <input type="text" class="form-control input-sm" name="immo" value="<?php echo $pi_row['immo'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Facebook</label>
                    <input type="text" class="form-control input-sm" name="facebook" value="<?php echo $pi_row['facebook'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Purchasing Power</label>
                    <input type="text" class="form-control input-sm" name="pur_power" value="<?php echo $pi_row['pur_power'] ?>">
                </div>
            </div>
            <div class="clearfix"></div>
            <h4><i class="fa fa-angle-double-right"></i>Home Address:</h4>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control input-sm" name="country">
                        	<option value="">Select...</option>
                            <?php echo $cm->countryList($pi_row['country']); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Province</label>
                        <select class="form-control input-sm" name="province">
                        	<option value="">Select....</option>
                            <?php echo $cm->province($pi_row['province']); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control input-sm" name="city">
                        	<option value="">Select...</option>
                            <?php echo $cm->cities($pi_row['city']); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>Area</label>
                       <input type="text" name="area" class="form-control input-sm" value="<?php echo $pi_row['area'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Other</label>
                        <input type="text" name="other_address" class="form-control input-sm" value="<?php echo $pi_row['other_address'] ?>">
                    </div>
                </div>
            <div class="col-md-12">
            	<div class="form-group">
                	<label>Major Ownership</label>
                    <input type="text" class="form-control input-sm" name="major_own" value="<?php echo $pi_row['major_own'] ?>">
                </div>
            </div>
            <div class="clearfix"></div>
            <h4><i class="fa fa-angle-double-right"></i>Education:</h4>
            <div class="col-md-4">
            	<div class="form-group">
                	<label>Qualification</label>
                    <select class="form-control input-sm" name="qualification" >
                       <option value="">Select One</option>
                       <?php echo $cm->qualification($pi_row['qualification']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="form-group">
                	<label>University</label>
                    <select class="form-control input-sm" name="university" >
                    <option value="0">None</option>
                     <?php echo $cm->institute($pi_row['university']); ?>
					</select>
                </div>
            </div>
            <div class="clearfix"></div>
            <h4><i class="fa fa-angle-double-right"></i>Background:</h4>
            <div class="col-md-12">
            	<div class="form-group">
                	<input type="text" class="form-control input-sm" name="edu_background" value="<?php echo $pi_row['edu_background'] ?>">
                </div>
            </div>
            <h4><i class="fa fa-angle-double-right"></i>Family Data:</h4>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Parents</label>
                    <input type="text" class="form-control input-sm" name="parents" value="<?php echo $pi_row['parents'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Wife</label>
                    <input type="text" class="form-control input-sm" name="wife" value="<?php echo $pi_row['wife'] ?>">
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Son</label>
                    <input type="text" class="form-control input-sm" name="son" value="<?php echo $pi_row['son'] ?>" >
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Daughter</label>
                    <input type="text" class="form-control input-sm" name="daughter" value="<?php echo $pi_row['daughter'] ?>">
                </div>
            </div>
            <div class="col-md-12">
            	<div class="form-group">
                	<label>Social Circle</label>
                    <input type="text" class="form-control input-sm" name="social_circle" value="<?php echo $pi_row['social_circle'] ?>">
                </div>
            </div>
            <div class="col-md-12">
            	<div class="form-group">
                	<label>Organization Membership</label>
                    <input type="text" class="form-control input-sm" name="org_membership" value="<?php echo $pi_row['org_membership'] ?>">
                </div>
            </div>
            <div class="clearfix"></div>
            <h4><i class="fa fa-angle-double-right"></i>Job/Desigination:</h4>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Department Name</label>
                    <select class="form-control input-sm" name="dep_name">
                    	<option value="">Select Department</option>
                    	<?php echo $marketing->departments($pi_row['dep_name']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
            	<div class="form-group">
                	<label>Heads Of Department</label>
                    <select class="form-control input-sm" name="head_dep">
                    	<option value="">Select HOD</option>
                    	<?php echo $marketing->dep_heads($pi_row['head_dep']); ?>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
            	<div class="form-group">
                	<label>Other</label>
                   <input type="text" class="form-control input-sm" name="other_dep_det" value="<?php echo $pi_row['other_dep_det'] ?>">
                </div>
            </div>
            <h4><i class="fa fa-angle-double-right"></i>Daily Routine:</h4>
            <div class="col-md-2">
            	<!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>From:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker input-sm" name="dr_from" value="<?php echo $pi_row['dr_from'] ?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                  </div>
            </div>
            <div class="col-md-2">
            	<!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>To:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker input-sm" name="dr_to" value="<?php echo $pi_row['dr_to'] ?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                  </div>
            </div>	
          </div>
          <!--panel-body-->
          <h3><i class="fa fa-angle-double-right"></i>Subjective Information</h3>
            <div class="panel-body panel panel-default">
       			<div class="col-md-3">
                	<div class="form-group">
                    	<label>Character</label>
                        <input type="text" name="sub_character" class="form-control input-sm" value="<?php echo $pi_row['sub_character'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Beliefs</label>
                        <input type="text" name="sub_beliefs" class="form-control input-sm" 
                        value="<?php echo $pi_row['sub_beliefs'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Mental Type</label>
                        <input type="text" name="sub_mental_type" class="form-control input-sm" value="<?php echo $pi_row['sub_mental_type'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Trait</label>
                        <input type="text" name="sub_trait" class="form-control input-sm" value="<?php echo $pi_row['sub_trait'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Interests</label>
                        <input type="text" name="sub_interest" class="form-control input-sm" value="<?php echo $pi_row['sub_interest'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Likes& Dislikes</label>
                        <input type="text" name="like_dislike" class="form-control input-sm" value="<?php echo $pi_row['like_dislike'] ?>">
                    </div>
                </div>
               	<div class="col-md-3">
                	<div class="form-group">
                    	<label>Buying Problems</label>
                        <input type="text" name="buying_prob" class="form-control input-sm" value="<?php echo $pi_row['buying_prob'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Aspiration</label>
                        <input type="text" name="aspiration" class="form-control input-sm" value="<?php echo $pi_row['aspiration'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                <?php if($address_id==""){ ?>
                	<button type="button" value="personal_info" class="btn btn-primary btnNext pull-right" 
                    style="margin-left:5px !important;">
                    <i class="fa fa-fw fa-hand-o-right"></i> Save & Continue</button>              	
        			<a class="btn btn-primary btnNext pull-right"><i class="fa fa-save"></i> Save</a>
                    <?php }
					else
					{
					echo '<button type="button" value="personal_info" class="btn btn-primary pull-right update_qp" 
                    style="margin-left:5px !important;">Update</button>					
					';
					}
					 ?>
                </div>
          </div>
          </form>
        </div>
        <!--tab-pane-->