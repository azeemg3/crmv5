<?php
$qp_need_row=NULL;
$prospect_need[]="";
if(!empty($address_id))
{
//editable data from qualyfing prospects Needs ..........................
$qp_need_result=$cm->selectData("qp_needs","address_id=".$address_id."");
$qp_need_row=$qp_need_result->fetch_assoc();
// indestry editable data
$prospect_need=explode(",",$qp_need_row['prospect_need']);
}
?>
<div id="needs" class="tab-pane fade">
                	<div class="panel-default panel-body panel">
                    <form>
                    	<div class="col-md-6">
                        	<div class="form-group">
                            	<label class="checkbox-inline">
                                <input type="checkbox" class="" value="Products" name="prospect_need[]"
								<?php if(in_array('Products',$prospect_need)): echo 'checked'; endif;?>>Products
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" class="" value="Profit" name="prospect_need[]"
                                <?php if(in_array('Profit',$prospect_need)): echo 'checked'; endif;?>>Profit
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" class="" value="Plant" name="prospect_need[]"
                                <?php if(in_array('Plant',$prospect_need)): echo 'checked'; endif;?>>Plant
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" class="" value="Promotion" name="prospect_need[]"
                                <?php if(in_array('Promotion',$prospect_need)): echo 'checked'; endif;?>>Promotion
                                </label>
                                <label class="checkbox-inline">
                                <input type="checkbox" class="" value="Industry" name="prospect_need[]"
                                <?php if(in_array('Industry',$prospect_need)): echo 'checked'; endif;?>>Industry
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <?php 
						if(empty($address_id))
						{
                        echo '<button type="button" value="qp-needs" class="btn btn-primary nested_btnNext pull-right" 
                        style="margin-left:5px !important;">
                        <i class="fa fa-fw fa-hand-o-right"></i> Save & Continue</button>              	
                        <a class="btn btn-primary btnNext pull-right"><i class="fa fa-save"></i> Save</a>';
						}
						else
						{
							echo '<button type="button" value="qp-needs" class="btn btn-primary pull-right update_qp" 
                        style="margin-left:5px !important;">
                        <i class="fa fa-fw fa-hand-o-right"></i> Update</button>';
						}
						
						?>
                      </div>
                      </form>
                    </div>
                </div>
                <!--tab-->