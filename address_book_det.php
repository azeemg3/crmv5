<?php 
require_once'inc.func.php';
$cm->get_header("");
$row=NULL;
if(isset($_GET['address_id']))
{
$result=$cm->selectData("address_book", "address_id=".$_GET['address_id']."");
$row=$result->fetch_assoc();
}
?>

<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Details</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
    <a onclick="history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
      <div class="box-body table-responsive">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Personal Information</a></li>
            <li><a href="#tab_2" data-toggle="tab">Business Information</a></li>
            <li><a href="#tab_4" data-toggle="tab">Travel Information</a></li>
            <li><a href="#tab_3" data-toggle="tab">Qualifying Prospects</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <table class="table" cellpadding="3" cellspacing="3" width="100%">
                <tbody>
                  <tr>
                    <td>CNIC NUMBER</td>
                    <td><?php echo $marketing->persoanl_u_val("cnic_number", $row['address_id']); ?></td>
                  </tr>
                  <tr>
                    <td>Name</td>
                    <td><?php echo $marketing->persoanl_u_val("name", $row['address_id']); ?></td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td><?php echo ucfirst($marketing->persoanl_u_val("gender", $row['address_id'])); ?></td>
                  </tr>
                  <tr>
                    <td>Birthday</td>
                    <td><?php echo $marketing->persoanl_u_val("birth_date", $row['address_id']); ?></td>
                  </tr>
                  <tr>
                    <td>Age</td>
                    <td><?php echo $marketing->persoanl_u_val("age", $row['address_id']); ?></td>
                  </tr>
                  <tr>
                    <td>Martial Status</td>
                    <td><?php echo ucfirst($marketing->persoanl_u_val("martial_status", $row['address_id'])); ?></td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("phone", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Mobile</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("mobile", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("email", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Skype</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("skype", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>LinkedIn</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("linkedIn", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Twitter</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("twitter", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>What's App</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("whatApp", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Immo</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("immo", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Facebook</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("facebook", $row['address_id']))); ?></td>
                  </tr>
                  <tr>
                    <td>Purchasing Power</td>
                    <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("pur_power", $row['address_id']))); ?></td>
                  </tr>
                </tbody>
              </table>
              <h4>Home Address:</h4>
              <table class="table">
              	<tbody>
                	<tr>
                    	<th>Country</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Area</th>
                    </tr>
                    <tr>
                    	<td>
						<?php echo $cm->emptyWord($cm->u_value("countries" ,"country_name","country_code=".$marketing->persoanl_u_val("country",$row['address_id'])).""); ?></td>
                        <td><?php echo $cm->emptyWord($cm->u_value("cities" ,"province","city_id=".$marketing->persoanl_u_val("city",$row['address_id'])."")); ?></td>
                        <td><?php echo $cm->emptyWord($cm->u_value("cities" ,"city_name","city_id=".$marketing->persoanl_u_val("city",$row['address_id'])."")); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->persoanl_u_val("area",$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td colspan="4"><strong>Other Details</strong>: 
						<?php echo $cm->emptyWord($marketing->persoanl_u_val("other_address",$row['address_id'])) ?></td>
                    </tr>
                </tbody>
              </table>
              <h4>Education:</h4>
              <table class="table">
              	<tbody>
                	<tr>
                    	<th>Qualification</th>
                        <th>University</th>
                        <th>Background</th>
                    </tr>
                    <tr>
               			<td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("university", $row['address_id']))); ?></td>
                        <td>
						<?php echo $cm->emptyWord($cm->u_value("institute", "ins_name",
						"ins_id=".$marketing->persoanl_u_val('university',$row['address_id'])."")); ?>
						</td>
                        <td><?php echo $cm->emptyWord(ucfirst($marketing->persoanl_u_val("edu_background", $row['address_id']))); ?></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane" id="tab_2">
              <table class="table" cellpadding="3" cellspacing="3" width="100%">
                <tbody>
                  <tr>
                    <td>Company Name</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val("comp_name", $row['address_id'])); ?></td>
                  </tr>
                  <tr>
                    <td>Type of Business</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val("bus_type", $row['address_id'])); ?></td>
                  </tr>
                  <tr>
                    <td>Size of Business</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val("bus_size", $row['address_id'])); ?></td>
                  </tr>
                  <tr>
                    <td>Business Location</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val("bus_location", $row['address_id'])); ?></td>
                  </tr>
                </tbody>
              </table>
              <h4>Business Address:</h4>
              <table class="table">
              	<tbody>
                	<tr>
                    	<th>Country</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Area</th>
                    </tr>
                    <tr>
                    	<td><?php
						 echo $cm->emptyWord($cm->u_value("countries","country_name",
						"country_code=".($marketing->business_u_val("country",$row['address_id'])?
						''.$marketing->business_u_val("country",$row['address_id']).'':"''").""));
						 ?></td>
                         <td><?php
						 echo $cm->emptyWord($cm->u_value("cities","province",
						"city_id=".($marketing->business_u_val("province",$row['address_id'])?
						''.$marketing->business_u_val("province",$row['address_id']).'':"''").""));
						 ?></td>
                          <td><?php
						 echo $cm->emptyWord($cm->u_value("cities","city_name",
						"city_id=".($marketing->business_u_val("city",$row['address_id'])?
						''.$marketing->business_u_val("city",$row['address_id']).'':"''").""));
						 ?></td>
                         <td>
                         	<?php echo $cm->emptyWord($marketing->business_u_val("area", $row['address_id'])); ?>
                         </td>
                    </tr>
                    <tr>
                    	<td colspan="4"><strong>Other Details</strong>:</td>
                        <td><?php echo $cm->emptyWord($marketing->business_u_val("other_det", $row['address_id'])); ?></td>
                    </tr>
                </tbody>
              </table>
              <table class="table" cellpadding="3" cellspacing="3" width="100%">
              	<tr>
                	<td>Phone</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('phone',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Email</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('email',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Website</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('website',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Market Served</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('market_served',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Organization</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('organization',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Management Types</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('management_types',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Credit Rating</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('credit_rating',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Key Personals</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('key_personals',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Product-Line</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('product_line',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Policies</td>
                    <td></td>
                </tr>
                </table>
                <h3>Policies:</h3>
                <table class="table">
                	<tr>
                    	<th>Vendor Policies</th>
                        <th>Payment Policies</th>
                        <th>Purchasing Policies</th>
                    </tr>
                    <tr>
                    	<td><?php echo $cm->emptyWord($marketing->business_u_val('vendor_policies',$row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->business_u_val('payment_policies',$row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->business_u_val('purchase_policies',$row['address_id'])); ?></td>
                    </tr>
                </table>
                <table class="table">
                <tr>
                	<td>Partinent Routines & Procedure</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('partinent_routines',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Termonology</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('termonology',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Majore income & Expense items</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('major_income',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Competetion</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('competetion',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Previous Experience</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('prev_exp',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Problems</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('problems',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Future Prospects</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('future_pros',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Product User</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('product_user',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Volume of Possibilites</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('vol_poss',$row['address_id'])); ?></td>
                </tr>
                <tr>
                	<td>Purchase Frequency</td>
                    <td><?php echo $cm->emptyWord($marketing->business_u_val('purchase_freq',$row['address_id'])); ?></td>
                </tr>
              </table>
            </div>
            <div class="tab-pane" id="tab_4">
              <table class="table" cellpadding="3" cellspacing="3" width="100%">
              	<tbody>
                	<tr>
                    	<td>Prefered Airline</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('pref_airline',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Prefered Class Of Travel</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('pref_class',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Prefered Destination</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('pref_destination',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Prefered Seat</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('pref_seat',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Prefered Meal</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('pref_meal',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Airline Membership</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('airline_membership',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Frequent Fly Card</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('fre_fly_card',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Travel Docment Details</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('travel_doc_det',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Luggage Information</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('lugg_info',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Airport Transport</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('air_trans',$row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td>Prefered Hotel</td>
                        <td><?php echo $cm->emptyWord($marketing->travel_u_val('pref_hotel',$row['address_id'])); ?></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane" id="tab_3">
              <h4>Industry:</h4>
              <table class="table">
              	<tbody>
                	<tr>
                    	<td>Products/Services</td>
                        <td>Based On</td>
                        <td>No Of supplier</td>
                        <td>Internal Employee</td>
                        <td>External Employee</td>
                    </tr>
                    <tr>
                    	<td><?php echo $cm->emptyWord($marketing->qp_cus_profile('ind_base_on', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('ind_selected', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('no_supplier', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('internal_employee', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('external_employee', $row['address_id'])); ?></td>
                    </tr>
                    <tr>
                    	<td><strong>Other Details</strong>:
                        <?php echo $cm->emptyWord($marketing->qp_cus_profile('ind_other_details', $row['address_id'])); ?>
                        </td>
                    </tr>
                </tbody>
              </table>
              <h4>Size & Location</h4>
              <table class="table">
              	<tbody>
                	<tr>
                    	<td>Functional Department</td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('cp_size_loc_dep', $row['address_id'])); ?></td>
                    </tr>
                </tbody>
              </table>
              <h5><strong>Finacial</strong>:</h5>
              <table class="table">
              	<tbody>
                	<tr>
                    	<td>Brand Value</td>
                        <td>Assets Value</td>
                        <td>Company Finacially Wearth</td>
                        <td>Annual Turnover</td>
                    </tr>
                    <tr>
                    	<td><?php echo $cm->emptyWord($marketing->qp_cus_profile('brand_val', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('assets_val', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('comp_finacial_wealth', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('annual_turnover', $row['address_id'])); ?></td>
                    </tr>
                </tbody>
              </table>
              <h5><strong>No OF Offices locations</strong>:</h5>
              <table class="table">
              	<tbody>
                 <tr>
                	<td>Location</td>
                    <td>Wherehouse</td>
                    <td>Manufacturing Unit</td>
                    <td>Display Center</td>
                 </tr>
                 <?php
				 $qp_cp_offices_location=$cm->selectData("qp_cp_offices_location","address_id=".$row['address_id']."");
				 while($ol_row=$result->fetch_assoc())
				 {
					 echo '<tr>
					 		<td>'.$cm->emptyWord($ol_row['location']).'</td>
							<td>'.$cm->emptyWord($ol_row['wherehouse']).'</td>
							<td>'.$cm->emptyWord($ol_row['wherehouse']).'</td>
							<td>'.$cm->emptyWord($ol_row['wherehouse']).'</td>
					 </tr>
					 <tr>
					 	<td>Other Details: '.$cm->emptyWord($ol_row['other_details']).'</td>
					 </tr>
					 ';
				 }
				 ?>
                </tbody>
              </table>
              <h5><strong>No OF Clients</strong>:</h5>
              <table class="table">
              	<tbody>
                	<tr>
                    	<td>B2B</td>
                        <td>B2C</td>
                        <td>Total Clients</td>
                    </tr>
                    <tr>
                    	<td><?php echo $cm->emptyWord($marketing->qp_cus_profile('b2b_clients', $row['address_id'])); ?></td>
                       	<td><?php echo $cm->emptyWord($marketing->qp_cus_profile('b2c_clients', $row['address_id'])); ?></td>
                        <td><?php echo $cm->emptyWord($marketing->qp_cus_profile('total_clients', $row['address_id'])); ?></td>
                    </tr>
                </tbody>
              </table>
              <h5><strong>Certification & Licenses</strong></h5>
              <table class="table">
              	<tbody>
                	<tr>
                    	<td>Certification</td>
                        <td>License</td>
                        <td>Other Details</td>
                    </tr>
                    <?php
					$qp_cp_size_loc_certificate_license=$cm->selectData("qp_cp_size_loc_certificate_license","address_id=".$row['address_id']."");
					while($sl_row=$qp_cp_size_loc_certificate_license->fetch_assoc())
					{
						echo '<tr>
							<td>'.$cm->emptyWord($sl_row['certificaton']).'</td>
							<td>'.$cm->emptyWord($sl_row['license']).'</td>
							<td>'.$cm->emptyWord($sl_row['other_det']).'</td>
						</tr>';
					}
					?>
                </tbody>
              </table>
              <table class="table">
              	<tr>
                	<td>Idle Use Case</td>
                    <td></td>
                </tr>
              </table>
              <h3>Needs:</h3>
              <table class="table">
              	<td>Needs:</td>
                <td><?php echo $cm->emptyWord($marketing->qp_needs('prospect_need',$row['address_id'])); ?></td>
              </table>
              <h3>Decesion Making Process:</h3>
              <table class="table">
              	<tr>
                	<td>No Of Department</td>
                    <td><?php echo $cm->emptyWord($marketing->qp_decision_making_process("no_dep",$row['address_id'])) ?></td>
                </tr>
                <tr>
                	<td>Authorization</td>
                    <td><?php echo $cm->emptyWord($marketing->qp_decision_making_process("authorization",$row['address_id'])) ?></td>
                </tr>
                <tr>
                	<td>Others</td>
                    <td><?php echo $cm->emptyWord($marketing->qp_decision_making_process("other_det",$row['address_id'])) ?></td>
                </tr>
                <?php
				$qp_decision_making_process=$cm->selectData("qp_dec_making_proc_department","address_id=".$row['address_id']."");
				while($dmp_row=$qp_decision_making_process->fetch_assoc())
				{
					echo '<tr>
							<td>'.$dmp_row['total_person'].'</td>
							<td>'.$dmp_row['dep_name'].'</td>
							<td>'.$dmp_row['person_name'].'</td>
							<td>'.$dmp_row['desigination'].'</td>
							<td>'.$dmp_row['role'].'</td>
						</tr>
						';
				}
				?>
              </table>
              <h3>Competetion:</h3>
              <table class="table">
              	<tbody>
                 <tr>
                  <td>Tourvision Travel competitors</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('travel_competitor', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <th colspan="2" align="center">Vendor Info:</th>
                 </tr>
                 <tr>
                  <td>Current Vendor</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('current_vendor', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Ex Vendor</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('ex_vendor', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Reason</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('ex_vendor_reason', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Vendor Selection Process</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('vendor_salection_process', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Asking Requirement</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('asking_req', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Offered Requirement</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('offered_req', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Agreed Requirement</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('agreed_req', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Payment Terms</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('payment_term', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Service Level</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('service_level', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                 	<th colspan="2">Evaluationg Benchmark</th>
                 </tr>
                 <tr>
                 	<td>Value</td>
                    <td><?php echo $cm->emptyWord($marketing->qp_competetion('ev_benchmark_value', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Value%</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('ev_benchmark_val_per', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Volume</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('ev_benchmark_vol', $row['address_id'])) ?></td>
                 </tr>
                 <tr>
                  <td>Evaluating Benchmark</td>
                  <td><?php echo $cm->emptyWord($marketing->qp_competetion('ev_benchmark_det', $row['address_id'])) ?></td>
                 </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--panel panel-default--> 
  </div>
  <!--panel-body--> 
</div>
<!-- container-->
<?php 
$cm->get_footer("")
?>