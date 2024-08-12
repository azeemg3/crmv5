<?php 
require_once'inc.func.php';
$cm->get_header("");
$row=NULL;
$address_id="";
if(isset($_GET['address_id']) && !empty($_GET['address_id']))
{
	$address_id=$_GET['address_id'];
	$result=$cm->selectData("address_book","address_id=".$address_id."");
	$row=$result->fetch_assoc();
}
?>
<body>
<div class="modal fade modal-pop" id="myModal">
    <div class="modal-dialog"> 
  <!-- Modal content-->
      <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="alert alert-success">	
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Data Updated Successfully........ 
        <button class="btn btn-sm btn-default pull-right update_btn_next" style="margin-left:5px;">
        <i class="fa fa-fw fa-hand-o-right"></i> Next
        </button> 
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
        Ok
        </button>
       </div>
    </div>
  </div>
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Add New Contact</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
    	<!--<div class="col-md-2">
        	<div class="form-group">
            	<input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control input-sm">
            </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
            	<input type="number" name="mobile_number" placeholder="Mobile Number" autocomplete="off" class="form-control input-sm">
            </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
            	<input type="number" placeholder="CNIC Number...." name="cnic_number" autocomplete="off" class="form-control input-sm">
            </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
            	<button class="btn btn-primary btn-sm" onClick="check_ex_query()"><i class="fa fa-fw fa-hand-o-right"></i>Next</button>
            </div>
        </div>
        <div class="clearfix"></div>-->
       <div class="content-tabs">
      <ul class="nav nav-tabs">
      	<li class="active"><a data-toggle="tab" href="#tech">Techniques</a></li>
        <li><a data-toggle="tab" href="#personal-info">Personal Information</a></li>
        <li><a data-toggle="tab" href="#business-info">Business Information</a></li>
        <li><a data-toggle="tab" href="#travel-info">Travel Information</a></li>
        <li><a data-toggle="tab" href="#qualifying-pros">Qualifying Prospects</a></li>
      </ul>
      <div class="tab-content">
      	<div id="tech" class="tab-pane fade in active">
        <input type="hidden" name="address_id" value="<?php echo $address_id ?>" id="address_id">
        <form>
        	<div class="col-md-3 col-sm-6">
            	<div class="form-group">
                	<label>Techniques For Prospecting</label>
                    <select class="form-control input-sm" name="pros_tech">
                    	<option value="">Select...</option>
                        <?php echo $marketing->pros_tech($row['pros_tech']); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
            	<div class="form-group">
                	<label>Select Group</label>
                    <select class="form-control input-sm" name="group_id">
                    	<option value="">--Select Group--</option>
                        <?php echo $marketing->e_mar_group($row['group_id']); ?>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8">
            	<div class="form-group">
                	<input type="text" class="form-control input-sm" name="other_det" placeholder="Other Details...."
                     value="<?php echo $row['other_det'] ?>">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8">
            	<label>Client Short Conversation</label>
            	<div class="form-group">
                	<input type="text" class="form-control input-sm" name="client_short_conv" placeholder="Client Short Conversation...."
                     value="<?php echo $row['client_short_conv'] ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
            	<div class="form-group">
              <?php
              if(empty($address_id))
              {
               echo '<button  type="button" class="btn btn-primary btnNext btn-sm" value="pros_tech" style="margin-top:25PX;">
                    <i class="fa fa-fw fa-hand-o-right"></i> Next</button>';
              }
              else
              {
                echo '<button type="button" class="btn btn-primary btn-sm update_qp" value="pros_tech" style="margin-top:25PX;">Update</button>';
              }
              ?>
                </div>
              
            </div>
            </form>
        </div>
        <?php require_once'marketing/tab_personal_info.php'; ?>
        <?php require_once'marketing/tab_business_info.php'; ?>
      	<?php require_once'marketing/tab_travel_info.php'; ?>
      <div id="qualifying-pros" class="tab-pane fade">
        	<h3><i class="fa fa-angle-double-right"></i>Qualifying Prospects</h3>
          <div class="panel panel-default panel-body">
    			<ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#cust-pro">Customer Profile</a></li>
                    <li><a data-toggle="tab" href="#needs">Needs</a></li>
                    <li><a data-toggle="tab" href="#dec-mak">Decision Making Process</a></li>
                    <li><a data-toggle="tab" href="#competiton">Competetion</a></li>
              </ul>
              <div class="tab-content">
               <?php require_once'marketing/qualifying_pros/customer_profile.php'; ?>
               <?php require_once'marketing/qualifying_pros/needs.php'; ?>  
               <?php require_once'marketing/qualifying_pros/decision_mak.php'; ?>
               <?php require_once'marketing/qualifying_pros/competetion.php'; ?> 
              </div>
              <!--tab-content-->
          </div>
          <!--panel-default-->
      </div>
      <!--qualifying-pros-->
    </div>
    </div>
    <!--contact-tabs-->
    <?php require_once'marketing/existing_query.php'; ?>
  </div>
  <!-- panel-body--> 
</div>
<!--panel-default-->
</section>
</div>
<!-- container-->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
$(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
		$(".func-dep").select2();
		$("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
      });

$(document).on('click','.select2-selection__choice',function() {
 	$(this).remove();
});

// multple options checked
var options = [];
var getval="";
$('.dropdown-menu a').on( 'click', function( event ) {
	getval+=$(this).attr("data-value")+",";
   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find('input'),
       idx;
   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push(val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).focus();
   return false;
});
</script>
<?php 
$cm->get_footer("");
?>
