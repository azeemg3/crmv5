<?php
require_once'../inc.func.php';
session_start();
$leadData="";
if(!empty($_GET['mobile']))
{
	$code=$_GET['code'];
	$mobile=$_GET['mobile'];
	$mobile=ltrim($mobile,"092");
	$mobile=$code.$mobile;
    $mobile = preg_replace('/\s+/', '', $mobile);

}
if($mobile==$cm->u_value("lead", "mobile", "mobile='".$mobile."' AND branch_id=".$_SESSION['branch_id']." AND status!='Trashed'"))
{
	$result=$cm->selectData("lead", "mobile='".$mobile."' AND branch_id=".$_SESSION['branch_id']." AND status!='Trashed'");
	$row=$result->fetch_assoc();
	echo '
		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Already Exist:</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped">
                    <tbody>
					<tr>
						<th>Lead Id</th>
						<th>Mobile No</th>
						<th>Contact Name</th>
						<th>Spo Name</th>
						<th>Status</th>
						<th>Email</th>
						<th>Travel Date</th>
						<th>Action</th>
                    </tr>
					<tr>
						<td>'.$row['id'].'</td>
						<td>'.$row['mobile'].'</td>
						<td>'.$row['contact_name'].'</td>
						<td>'.$cm->emptyWord($cm->u_value("user", "name", "id=".$row['spo']."")).'</td>
						<td>'.$cm->ls_clr($row['status']).'</td>
						<td>'.$row['email'].'</td>
						<td></td>
						<td>
							<a onclick="lead_details_modal('.$row['id'].')">Client Details</a> | 
							'.(($_SESSION['sessionId']==$row['spo'] || $cm->user_access("reopenLead",$_SESSION['sessionId']))?'
							'.(($row['status']=="new" || $row['status']=='process')? 
							'<a href="lead_details?leadId='.$cm->encodeData($row['id']).'">
							<i class="fa fa-fw fa-folder-open-o"></i>Open Lead</a>' :"").'
							'.(($row['status']=="successfull" || $row['status']=="unsuccessfull")? '<a href="lead_details?leadId='.$cm->encodeData($row['id']).'&reopen=reopen">
							<i class="fa fa-eye"></i> ReOpen Lead</a>' :"").'
							':"N/A").'
						</td>
					</tr>
                  </tbody>
				</table><br>';
				/*Fetch the Travel information against get mobile number*/
				$ti_row=NULL;
				$address_id=$cm->u_value("ab_personal_info","address_id","mobile='".$mobile."'");
				if($address_id!="" || $address_id!=0){
				$ti_result=$cm->selectData("ab_travel_info","address_id=".$address_id."");
				$ti_row=$ti_result->fetch_assoc();
				echo '
				<div class="col-md-12">
					<h3 class="box-title">Travel Information:</h3>
					<table class="table" cellpadding="3" cellspacing="3" width="100%">
              	<tbody>
                	<tr>
                    	<th>Prefered Airline</th>
                        <td>'.$cm->emptyWord($ti_row['pref_airline']).'</td>
                    </tr>
                    <tr>
                    	<th>Prefered Class Of Travel</th>
                        <td>'.$cm->emptyWord($ti_row['pref_class']).'</td>
                    </tr>
                    <tr>
                    	<th>Prefered Destination</th>
                        <td>'.$cm->emptyWord($ti_row['pref_destination']).'</td>
                    </tr>
                    <tr>
                    	<th>Prefered Seat</th>
                        <td>'.$cm->emptyWord($ti_row['pref_seat']).'</td>
                    </tr>
                    <tr>
                    	<th>Prefered Meal</th>
                        <td>'.$cm->emptyWord($ti_row['pref_meal']).'</td>
                    </tr>
                    <tr>
                    	<th>Airline Membership</th>
                        <td>'.$cm->emptyWord($ti_row['airline_membership']).'</td>
                    </tr>
                    <tr>
                    	<th>Frequent Fly Card</th>
                        <td>'.$cm->emptyWord($ti_row['fre_fly_card']).'</td>
                    </tr>
                    <tr>
                    	<th>Travel Docment Details</th>
                        <td>'.$cm->emptyWord($ti_row['travel_doc_det']).'</td>
                    </tr>
                    <tr>
                    	<th>Luggage Information</th>
                        <td>'.$cm->emptyWord($ti_row['lugg_info']).'</td>
                    </tr>
                    <tr>
                    	<th>Airport Transport</th>
                        <td>'.$cm->emptyWord($ti_row['air_trans']).'</td>
                    </tr>
                    <tr>
                    	<th>Prefered Hotel</th>
                        <td>'.$cm->emptyWord($ti_row['pref_hotel']).'</td>
                    </tr>
                </tbody>
              </table>
				</div>
				<!--<div class="col-md-4" style="margin-top:5px; margin-bottom:5px;">
					<a   href="create_new_lead?lead=new" class="btn btn-default btn-sm" style="float:left; border-radius:0;">Continue And Create New Lead</a>
					<div class="arrow-right"></div>
				</div>-->
                </div><!-- /.box-body -->
              </div>';
			  }
}
elseif ($mobile==$cm->u_value("ab_personal_info", "mobile", "mobile='".$mobile."'")) 
{
    $ab_pi_row=NULL;
    $ab_pi_row=Null;
    
    $address_id=$cm->u_value("ab_personal_info","address_id","mobile=".$mobile."");
    //address book personal information fetch data against match mobile number
    $ad_pi_result=$cm->selectData("ab_personal_info","mobile=".$mobile."");
    $ab_pi_row=$ad_pi_result->fetch_assoc();
    // address book Travel information fetch data against match mobile number
    $ab_ti_result=$cm->selectData("ab_travel_info","address_id=".$address_id."");
    $ab_ti_row=$ab_ti_result->fetch_assoc();
    /****************************Travel Informaiton*******************/
    echo '
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">We Have Already Exist Travel Information About this Client</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">';
                echo '
                <div class="col-md-12">
                    <h3 class="box-title"><i class="fa fa-angle-double-right"></i>Persoanl Information:</h3>
                    <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>'.$cm->emptyWord($ab_pi_row['name']).'</td>
                            <th>CNIC Number</th>
                            <td>'.$cm->emptyWord($ab_pi_row['cnic_number']).'</td>
                        </tr>
                        <tr>
                            <th>Age</th><td>'.$cm->emptyWord($ab_pi_row['age']).'</td>
                            <th>Martial Status</th><td>'.$cm->emptyWord($ab_pi_row['martial_status']).'</td>
                        </tr>
                    </tbody>
                    </table>
                    <h3 class="box-title"><i class="fa fa-angle-double-right"></i>Travel Information:</h3>
                    <table class="table" cellpadding="3" cellspacing="3" width="100%">
                <tbody>
                    <tr>
                        <th>Prefered Airline</th>
                        <td>'.$cm->emptyWord($ab_ti_row['pref_airline']).'</td>
                    </tr>
                    <tr>
                        <th>Prefered Class Of Travel</th>
                       <td>'.$cm->emptyWord($ab_ti_row['pref_class']).'</td>
                    </tr>
                    <tr>
                        <th>Prefered Destination</th>
                       <td>'.$cm->emptyWord($ab_ti_row['pref_destination']).'</td>
                    </tr>
                    <tr>
                        <th>Prefered Seat</th>
                        <td>'.$cm->emptyWord($ab_ti_row['pref_seat']).'</td>
                    </tr>
                    <tr>
                        <th>Prefered Meal</th>
                        <td>'.$cm->emptyWord($ab_ti_row['pref_meal']).'</td>
                    </tr>
                    <tr>
                        <th>Airline Membership</th>
                        <td>'.$cm->emptyWord($ab_ti_row['airline_membership']).'</td>
                    </tr>
                    <tr>
                        <th>Frequent Fly Card</th>
                        <td>'.$cm->emptyWord($ab_ti_row['fre_fly_card']).'</td>
                    </tr>
                    <tr>
                        <th>Travel Docment Details</th>
                        <td>'.$cm->emptyWord($ab_ti_row['travel_doc_det']).'</td>
                    </tr>
                    <tr>
                        <th>Luggage Information</th>
                        <td>'.$cm->emptyWord($ab_ti_row['lugg_info']).'</td>
                    </tr>
                    <tr>
                        <th>Airport Transport</th>
                        <td>'.$cm->emptyWord($ab_ti_row['air_trans']).'</td>
                    </tr>
                    <tr>
                        <th>Prefered Hotel</th>
                        <td>'.$cm->emptyWord($ab_ti_row['pref_hotel']).'</td>
                    </tr>
                </tbody>
              </table>
                </div>
                <div class="col-md-4" style="margin-top:5px; margin-bottom:5px;">
                    <form action="create_lead" method="post">
                    <input type="hidden" name="mobile" value="'.$mobile.'">
                    <input type="hidden" name="contact_name" value="'.$ab_pi_row['name'].'">
                    <input type="hidden" name="email" value="'.$ab_pi_row['email'].'">
                    <input type="hidden" name="cnic_number" value="'.$ab_pi_row['cnic_number'].'">
                    <input type="hidden" name="sector" value="'.$ab_ti_row['pref_destination'].'">
                    <input type="hidden" name="address_id" value="'.$ab_ti_row['address_'].'">
                    <button class="btn btn-default btn-sm" style="float:left; border-radius:0;">Continue And Create</button>
                    <div class="arrow-right"></div>
                    </form>
                </div>
                </div><!-- /.box-body -->
              </div>';
              
}
else
{
?>
<script>
	window.location='create_new_lead?lead=new&mobile=<?php echo base64_encode($mobile) ?>';
</script>
<?php } ?>
