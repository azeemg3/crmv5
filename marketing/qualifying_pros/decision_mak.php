<?php
$qp_dm_row=NULL;
if(!empty($address_id))
{
//editable data from qualyfing prospects Decesion Making process ..........................
$qp_dm_result=$cm->selectData("qp_decision_making_process","address_id=".$address_id."");
$qp_dm_row=$qp_dm_result->fetch_assoc();
}
?>
<div id="dec-mak" class="tab-pane fade">
                	<div class="panel-default panel-body panel">
                    <form>
                    	 <div class="col-md-2">
                         	<div class="form-group">
                            	<label>No Of Department</label>
                            	<input type="text" class="form-control input-sm" placeholder="No of Department" name="no_dep"
                                value="<?php echo $qp_dm_row['no_dep'] ?>">
                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="col-md-3">
                         	<div class="form-group form-inline">
                            	<label>Name OF Dep</label>
                            	<select class="form-control input-sm select_dep">
                                	<option value="">Select Department</option>
                                    <?php echo $marketing->departments(); ?>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-2 count-dep-people" style="display:none;">
                         	<div class="form-group form-inline">
                            	<label>No Of People</label>
                            	<input type="text" class="form-control input-sm dec_total_person" placeholder="No Of People" 
                                name="total_person">
                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <!---------------------update department information----------------------->
                         <?php
						 if(!empty($address_id))
						 {
							 $qp_dec_making_proc_dep_result=$cm->selectData("qp_dec_making_proc_department",
							 "address_id=".$address_id."");
							 while($qp_dec_making_proc_dep_row=$qp_dec_making_proc_dep_result->fetch_assoc())
							 {
								 echo '
							<div class="'.preg_replace("/[^A-Za-z0-9]/", "", $qp_dec_making_proc_dep_row['dep_name']).'">
							<h5><i class="fa fa-angle-double-right"></i> '.$qp_dec_making_proc_dep_row['dep_name'].'</h5>	 	
							<input type="hidden" name="dep_name[]" value="'.$qp_dec_making_proc_dep_row['dep_name'].'">	
							<input type="hidden" name="total_person[]" value="'.$qp_dec_making_proc_dep_row['total_person'].'">	
							<div class="col-md-2">
								<div class="form-group">
                            	<input type="text" class="form-control input-sm" placeholder="Name" name="person_name[]" 
								value="'.$qp_dec_making_proc_dep_row['person_name'].'">
                            	</div>
							</div>
							<div class="col-md-2">
                        	<div class="form-group">
                            <input type="text" class="form-control input-sm" placeholder="Desigination" name="desigination[]"
							value="'.$qp_dec_making_proc_dep_row['desigination'].'">
                            </div>
                        	</div>
							<div class="col-md-2">
								<div class="form-group">
									<select class="form-control input-sm" name="role[]">
										'.$marketing->dep_role($qp_dec_making_proc_dep_row['role']).'
									</select>
								</div>
							</div> 	
							</div>
							<div class="clearfix"></div>';
							 }
						 }
						 ?>
                        <div class="col-md-12">
                        	<div class="form-group">
                            	<label>Authorization</label>
                            	<input type="text" class="form-control input-sm" name="authorization" 
                                value="<?php echo $qp_dm_row['authorization'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                        	<div class="form-group">
                            	<label>Others</label>
                            	<input type="text" class="form-control input-sm" placeholder="Other Details...." name="other_det"
                                value="<?php echo $qp_dm_row['other_det'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <?php
						if(empty($address_id))
						{ 
                        echo '<button type="button" value="qp-decesion_mak" class="btn btn-primary nested_btnNext pull-right" 
                        style="margin-left:5px !important;">
                        <i class="fa fa-fw fa-hand-o-right"></i> Save & Continue</button>              	
                        <a class="btn btn-primary btnNext pull-right"><i class="fa fa-save"></i> Save</a>';
						}
						else
						{
							echo '<button type="button" value="qp-decesion_mak" class="btn btn-primary pull-right update_qp" 
                        style="margin-left:5px !important;">
                        <i class="fa fa-fw fa-hand-o-right"></i>Update</button>';
						}
						?>
                        </div>
                        </form>
                    </div>
                </div>
                <!--tab-->