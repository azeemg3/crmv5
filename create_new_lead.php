<?php
require_once'inc.func.php';
$lead=new lead();
$cm->get_header("");
$mobile="";
$row=NULL;
if(isset($_GET['mobile']) && !empty($_GET['mobile']))
{
	$mobile=base64_decode($_GET['mobile']);
	$userId=$_SESSION['sessionId'];
}
elseif(isset($_GET['leadId']) && !empty($_GET['leadId']))
{
	$result=$cm->selectData("lead", "id=".base64_decode($_GET['leadId'])."");
	$row=$result->fetch_assoc();
	$mobile=$row['mobile'];
	$userId=$row['spo'];
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
<!--lead details summary in modal--->
	<div class="modal fade" id="lead_details_modal">
          <div class="modal-dialog"> 
            <!-- Modal content-->
            <div class="modal-content">
            	<div class="panel-body">
                	<table class="table table-bordered table-striped">
                     <tbody id="lead_det_summary"></tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
<!--lead details summary in modal--->

    <div class="content-wrapper" id="loadpage">
        <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
            <h1>Create New Lead</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <?php validation::empty_field() ?>
        <div id="primary">
        <?php if(isset($_GET['lead']) && $_GET['lead']=='new' || base64_encode("edit") && !empty($_GET['lead']))
		{
		 ?>
        <div class="panel panel-default" style="margin-bottom:0px !important;">
            <div class="panel-body">
            	<form action="saveLead" method="post">
               <input type="hidden" name="id" value="<?php echo $row['id']??"" ?>" />
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
                          <input class="form-control" name="sec_mobile"  type="text" value="<?php echo $row['sec_mobile']??"" ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>CNIC Number</label>
                          <input class="form-control" name="cnic_number"  type="number" value="">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                     <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Contact Name</label>
                          <input class="form-control" name="contact_name"  type="text" value="<?php echo $row['contact_name']??"" ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Spo</label>
                          <select name="spo" class="form-control">
                          	<option value="">Select...</option>
                            <?php echo $lead->all_branch_spo($userId); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!--co-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Traveling Date From</label>
                          <input class="form-control date" name="travel_datefrm"  type="text" placeholder="Date From"
                          value="<?php echo $row['travel_datefrm']??"" ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                     <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Traveling Date To</label>
                          <input class="form-control date" name="travel_dateto"  type="text" placeholder="Date To" 
                          value="<?php echo $row['travel_dateto']??"" ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Sector</label>
                          <input class="form-control" name="sector" type="text" value="<?php echo $row['sector']??"" ?>">
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
                          <input class="form-control" name="email"  type="text" value="<?php echo $row['email']??"" ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Secondary Email</label>
                          <input class="form-control" name="sec_email"  type="text" value="<?php echo $row['sec_email']??"" ?>">
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>Country</label>
                          <select class="form-control select2" name="country_id" onChange="select_city(this.value)">
                          	<option value="">Select Country</option>
                          	<?php echo $cm->countries($row['country_code']??0); ?>
                          </select>
                       </div>
                    <!-- form--group-->
                    </div>
                    <!-- col-lg-4-->
                    <div class="col-lg-4 col-sm-6">
                    	<div class="form-group">
                          <label>City</label>
                          <select class="form-control select2" name="city_id" id="city_id">
                            <?php echo $cm->cities(92,$row['city_id']); ?>
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
                         <textarea rows="7" name="comment" class="form-control"><?php echo $row['comment']??"" ?></textarea>
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
        <?php }
			else
			{
		 ?>
      		<div class="panel panel-default" style="margin-bottom:0px !important;">
            <div class="panel-body">
                <div class="col-lg-7 form-inline c_n_l">
                    <div class="form-group">
                        <label for="focusedInput">Mobile No *</label>
                        <select class="form-control input-sm" name="c_code" id="c_code">
                            <?php echo crm::get_cc(); ?>
                        </select>
                        <input class="form-control input-sm" name="mobile" id="mobile"   type="number">
                        <button type="button" class="btn btn-success createLead">Create Lead</button>
                    </div>
                    <div class="load" align="center"></div>
                    <!-- form--group-->
                </div>
                <!-- col-lg-5-->
            </div>
            <!-- panel-body-->
        </div>
        <!--panel-default-->
        <h2 style="text-align:center;display:block;margin:0px;padding:15px 0px;font-style:italic;">
        <span class="main-heading">Lead Status</span></h2>
        <div class="col-md-12">
        	<?php echo $lead->spo_leads($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
      </div>
       <?php } ?>
        </div>
        <!--primary-->
        <span class="clearfix"></span>
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
