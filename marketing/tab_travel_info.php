<?php
//editable data from Travel  information ..........................
$ti_row=NULL;
if(!empty($address_id))
{
$bi_result=$cm->selectData("ab_travel_info","address_id=".$address_id."");
$ti_row=$bi_result->fetch_assoc();
}
?>

<div id="travel-info" class="tab-pane fade">
  <h3><i class="fa fa-angle-double-right"></i>Travel Information</h3>
  <form>
  <div class="panel panel-default panel-body">
  	<div class="col-md-3">
    	<div class="form-group">
        	<div class="button-group">
            	<button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            	Prefered Airline<span class="caret"></span></button>
                <ul class="dropdown-menu drp-group">
              <?php 
			  echo $administrator->airlines($ti_row['pref_airline']); ?>
             </ul>
            </div>
        </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
        	<div class="button-group">
            	<button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            	Prefered Class of Travel<span class="caret"></span></button>
                <ul class="dropdown-menu drp-group">
              	<?php echo $administrator->travel_class($ti_row['pref_class']); ?>
             </ul>
            </div>
        </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
        	<input type="text" name="pref_destination" class="form-control input-sm" placeholder="Prefered Destination"
            value="<?php echo $ti_row['pref_destination'] ?>" />
        </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
        	<div class="button-group">
            	<button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            	Prefered Seat<span class="caret"></span></button>
                <ul class="dropdown-menu">
              <?php echo $administrator->airline_seat_list($ti_row['pref_seat']); ?>
             </ul>
            </div>
        </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
        	<input type="text" class="form-control input-sm" placeholder="prefered Meal" name="pref_meal" 
            value="<?php echo $ti_row['pref_meal'] ?>"/>
        </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
        	<div class="button-group">
            	<button type="text" class="form-control input-sm dropdown-toggle test" data-toggle="dropdown">
            	Airline Membership<span class="caret"></span></button>
                <ul class="dropdown-menu">
              <?php echo $administrator->airline_membership($ti_row['airline_membership']); ?>
                
             </ul>
            </div>
        </div>
	</div>
    <div class="col-md-6">
    	<div class="form-group">
        	<input type="text" class="form-control input-sm" placeholder="Frequent Fly Card" name="fre_fly_card"
            value="<?php echo $ti_row['fre_fly_card'] ?>" />
        </div>
	</div>
    <div class="clearfix"></div>
    <div class="col-md-12">
    	<div class="form-group">
        	<input type="text" class="form-control input-sm" name="travel_doc_det" placeholder="Travel Document Details"
            value="<?php echo $ti_row['travel_doc_det'] ?>" />
        </div>
	</div>
    <div class="col-md-12">
    	<div class="form-group">
        	<input type="text" class="form-control input-sm" name="lugg_info" placeholder="Luggage Information" 
            value="<?php echo $ti_row['lugg_info'] ?>"/>
        </div>
	</div>
    <div class="col-md-12">
    	<div class="form-group">
        	<input type="text" class="form-control input-sm" name="air_trans" placeholder="Air Port Transport" 
            value="<?php echo $ti_row['air_trans'] ?>"/>
        </div>
	</div>
    <div class="col-md-12">
    	<div class="form-group">
        	<input type="text" class="form-control input-sm" name="pref_hotel" placeholder="Prefered Hotel"
            value="<?php echo $ti_row['pref_hotel'] ?>" />
        </div>
	</div>
    <div class="col-md-12">
    	<?php
		if(empty($address_id))
		{
			echo '<button type="button" class="btn btn-primary btnNext pull-right" value="travel_info" style="margin-left:5px !important;">
        <i class="fa fa-fw fa-hand-o-right"></i> Save & Continue</button> 
        <a class="btn btn-primary btnNext pull-right"><i class="fa fa-save"></i> Save</a> ';
		}
		else
		{
			echo '<button type="button" class="btn btn-primary pull-right update_qp" value="travel_info">Update</button>';
		}
		 ?> 
    	</div>
    <!--col-md-12--> 
  </div>
  </form>
</div>
