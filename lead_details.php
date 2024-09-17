<?php
require_once'inc.func.php';
$cm->get_header("");
if(isset($_GET['leadId'])){$leadId=$cm->decodeData($_GET['leadId']);}
$result=$cm->selectData("lead", "id=".$leadId."");
$row=$result->fetch_assoc();
require_once'lead-tabs/lead-details-editor/set_ticket_sale.php';
require_once'lead-tabs/lead-details-editor/set_other_sale.php';
require_once'lead-tabs/lead-details-editor/set_refund.php';
require_once'lead-tabs/term-condition.php';
require_once'lead-tabs/unSuccesfull-reason.php';
require_once'lead-tabs/set_reminder.php';
require_once'lead-tabs/lead-details-view/ticket_view.php';
require_once'lead-tabs/lead-details-view/other_sale_view.php';
require_once'lead-tabs/lead-details-view/refund_view.php';
require_once'tourSale/viewTourSale/view_tour_sale_det.php';
require_once'lead-tabs/client_feedback.php';
?>
<style type="text/css">
body {
	background-color: #FFFFFF;
}
</style>
<body bgcolor="#FFFFFF">
<input type="hidden" name="leadId" id="leadId" value="<?php echo $leadId ?>">
<script>
document.title='Lead Details';
</script> 
<!-- Modal -->
<div class="modal fade" id="myLoader" role="dialog">
  <div class="modal-dialog">
    <div class="modal-body">
      <p><img src="images/l_ajax_loader.gif" /></p>
    </div>
  </div>
</div>
<div class="modal fade" id="quotation_view" role="dialog">
  <div class="modal-dialog" style="width:70%;"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title" align="center">Quotation View</h2>
        <p>
        <div class="col-lg-3"> Branch: <span id="q_branch"></span> </div>
        <div class="col-lg-3"> Currency: <span id="currency"></span> </div>
        <div class="col-lg-3"> Spo: <span id="q_spo"></span> </div>
        <div class="col-lg-3"> Quotation Ref: <span id="q_vc"></span> </div>
        <div class="col-lg-6">
          <div class="btn-group">
            <button type="button" class="btn btn-primary">Email Format</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
            <ul class="dropdown-menu" role="menu">
              <li> <a onClick="q_o_email('det_email_o', 'det_email', 'Detail Email Quotation')"> <span class="glyphicon glyphicon-envelope"></span> Detail Email </a> </li>
              <li> <a onClick="q_o_email('det_email_o', 'smry_email','Summery Email Quotation')"> <span class="glyphicon glyphicon-envelope"></span> Summery Email </a> </li>
              <li> <a onClick="slctd_o_email('q_sel_email', 'Send Quotation Email')"> <span class="glyphicon glyphicon-envelope"></span> Selected Email </a> </li>
            </ul>
          </div>
        </div>
        <!--col-lg-6-->
        <div class="modal fade" id="det_email_o">
          <div class="modal-dialog"> 
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onClick="close_email('det_email_o')">&times;</button>
                <h4 class="modal-title"><span id="q_heading"></span></h4>
              </div>
              <form id="q_e_form">
                <div class="panel panel-default">
                  <input type="hidden" name="qId" id="qId" value="">
                  <input type="hidden" name="q_type" id="q_type" value="" />
                  <div class="panel-body">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                      <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                          <input type="text" name="email" id="email"  value=""  placeholder="Enter Email Adress" class="form-control">
                        </div>
                        <!-- form--group--> 
                      </div>
                      <!--co-lg-3-->
                      <div class="clearfix"></div>
                      <div class="col-lg-3 col-xs-12 col-sm-6 pull-right">
                        <input type="button" onClick="q_s_email()" id="q_s_email" class="btn btn-primary col-xs-12 col-sm-12"  value="Send">
                        <input type="button" onClick="slctd_q_email()" id="q_sel_email" class="btn btn-success col-xs-12 col-sm-12" 
                         value="Send" style="display:none;">
                      </div>
                      <!-- col-lg-12--> 
                    </div>
                  </div>
                  <!-- panel-body--> 
                </div>
              </form>
              
              <!--panel-default--> 
            </div>
          </div>
        </div>
      </div>
      <!-- edit--ticket--> 
      
      <!--end-emai model-->
      <div class="clearfix"></div>
      <div class="panel panel-default topmargin-five">
        <div id="visa_hide">
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-user"></span> Visa Information
            <input type="checkbox" name="visa_email" id="visa_email" value="visa_email"  />
          </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Adult</th>
                <th>Rate</th>
                <th>Child</th>
                <th>Rate</th>
                <th>Infant</th>
                <th>Rate</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="get_visa">
            </tbody>
            <tr>
              <td colspan="6" align="right">Visa Amount</td>
              <td><span id="v_total"></span></td>
            </tr>
          </table>
        </div>
        <div id="acc_hide">
          <h4 class="grey-heading"><span class="glyphicon glyphicon-bed"></span> Accommodation
            <input type="checkbox" name="acc_email" id="acc_email"  value="acc_email" />
          </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Hotel Name</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Nights</th>
                <th>Room Type</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="get_acc">
            </tbody>
            <tr>
              <td colspan="7" align="right">Accommodation Amount</td>
              <td><span id="acc_total"></span></td>
            </tr>
          </table>
        </div>
        <div id="trans_hide">
          <h4 class="grey-heading"><span class="glyphicon glyphicon-road"></span> Transporation
            <input type="checkbox" name="trans_email" id="trans_email" value="trans_email"  />
          </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Transport Name</th>
                <th>Vehicle Type</th>
                <th>Sector</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="get_trans">
            </tbody>
            <tr>
              <td colspan="5" align="right">Transportation Amount</td>
              <td><span id="trans_total"></span></td>
            </tr>
          </table>
        </div>
        <div id="ticket_hide">
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-plane"></span> Ticket
            <input type="checkbox" name="tkt_email" id="tkt_email" value="tkt_email"  />
          </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Passenger Type</th>
                <th>Air Line</th>
                <th>Date</th>
                <th>Sector From</th>
                <th>Sector To</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="get_ticket">
            </tbody>
            <tr>
              <td colspan="9" align="right">Ticket Amount</td>
              <td><span id="tkt_total"></span></td>
            </tr>
          </table>
        </div>
        <div id="other_ser_hide">
          <h4 class="grey-heading"><span class="glyphicon glyphicon-th-large"></span> Other Services
            <input type="checkbox" name="other_email" id="other_email" value="other_email"  />
          </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Service Name</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Description</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="get_other">
            </tbody>
            <tr>
              <td colspan="4" align="right">Other Amount</td>
              <td><span id="o_total"></span></td>
            </tr>
          </table>
        </div>
        <table class="table table-bordered table-striped">
          <tr>
            <td colspan="2" align="right" style="width:90%;"><b>Grand Total</b></td>
            <td><span id="grand_total" style="font-weight:bold;"></span></td>
          </tr>
        </table>
      </div>
      <!--panel-default-->
      </p>
    </div>
  </div>
</div>
</div>
<!-- Quotation View--> 
<!-- View UB-->
<div class="modal fade" id="ub_view" role="dialog">
  <div class="modal-dialog" style="width:70%;"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ub View Details:</h4>
        <p>
        <div class="panel panel-default topmargin-five">
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-user"></span> Clinet Details</h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Client Name</th>
                <th>Vender Name</th>
                <th>Quantity</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
              </tr>
            </thead>
            <tbody id="get_client_det">
            </tbody>
            <tr>
              <td colspan="4" align="right"><strong>Total</strong></td>
              <td><span id="total_cd"></span></td>
            </tr>
          </table>
          <div class="clearfix"></div>
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-bed"></span> Hotel Sale</h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>#</th>
                <th>Room Type</th>
                <th>Quantity</th>
                <th>Date From</th>
                <th>Date To</th>
                <th>Nights</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
              </tr>
            </thead>
            <tbody id="get_hotel_sale">
            </tbody>
            <tr>
              <td colspan="7" align="right"><strong>Total</strong></td>
              <td><span id="total_hs"></span></td>
            </tr>
          </table>
          <div class="clearfix"></div>
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-road"></span> Transport</h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>#</th>
                <th>Vender Name</th>
                <th>Quantity</th>
                <th>Sector</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
              </tr>
            </thead>
            <tbody id="get_ub_transport">
            </tbody>
            <tr>
              <td colspan="5" align="right"><strong>Total</strong></td>
              <td><span id="total_ubTrans"></span></td>
            </tr>
          </table>
          <div class="clearfix"></div>
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-th-large"></span> Others </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>#</th>
                <th>Vender Name</th>
                <th>Quantity</th>
                <th>Sector</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
              </tr>
            </thead>
            <tbody id="get_ub_other">
            </tbody>
            <tr>
              <td colspan="5" align="right"><strong>Total</strong></td>
              <td><span id="total_uboth"></span></td>
            </tr>
          </table>
          <div class="clearfix"></div>
          <h4 class="grey-heading"> <span class="glyphicon glyphicon-th-large"></span> Packages </h4>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>#</th>
                <th>Package Type</th>
                <th>Quantity</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
              </tr>
            </thead>
            <tbody id="get_pkg">
            </tbody>
            <tr>
              <td colspan="4" align="right"><strong>Total</strong></td>
              <td><span id="total_pkg"></span></td>
            </tr>
            <tr>
              <td colspan="4" align="right"><strong>Grand Total Total</strong></td>
              <td><span id="ub_g_total"></span></td>
            </tr>
          </table>
        </div>
        <!-- end panel-default-->
        </p>
      </div>
    </div>
  </div>
</div>
<!-- End View UB-->

<style>
.wrapper{ overflow:visible;}
.table{
	background:#FFF;
	font-size:12px;
}
.table tbody tr td b{
	color: #000000;
}
.main-heading{
	background:darkcyan;
	text-align:center;
	font-size:18px;
	padding:12px;
	color:#FFF;
}
.dataTable thead tr{
	background-color:#CFF;
}
.dataTable thead tr th{
	background-color:#d1d1d1;
}
.table-bordered tbody tr td{
	border: 1px solid #d1d1d1 !important;
}
.direct-chat-text {
	position:inherit !important;
	margin:0px !important;
}
.direct-chat-msg {
    width: 50% !important;
}
.nave-style li a{
	padding:10px 15px !important;
	font-size:12px !important;
	color: darkcyan !important;
}

</style>
<?php
if(isset($_GET['closeLead']) && !empty($_GET['closeLead']))
{
		$closeLead=$_GET['closeLead'];
		$un_Succ_reason="";
		if(isset($_GET['un_Succ_reason']) && $_GET['un_Succ_reason']!="other")
		{
			$un_Succ_reason=$_GET['un_Succ_reason'];
		}
		elseif(isset($_GET['other_reason']) && $_GET['un_Succ_reason']="other")
		{
			$un_Succ_reason=$_GET['other_reason'];
		}
		if($closeLead=='successfull')
		{
			if($account->succ_acc($leadId)>0)
			{
				echo '
			<div class="col-md-4 col-md-offset-5" style="margin-top:2%;">
    			<div class="alert alert-danger alert-dismissable">
					
					<h4> <i class="icon fa fa-check"></i> Alert! '.$account->succ_acc($leadId).'</h4>
					Failed: Net Balance Should be 0 For Successfull Lead <a onclick="history.go(-1)">Go Back</a>
					</div>
  			</div>
  			<div class="clearfix"></div>';
			exit();
			}
			else
			{
				$cm->update("lead", "status='$closeLead', unSucc_reason='$un_Succ_reason', close_date='".$cm->current_dt()."'", "id=".$leadId."");
				echo '
					<div class="col-md-4 col-md-offset-5" style="margin-top:2%;">
    				 <div class="alert alert-success alert-dismissable">
						<h4> <i class="icon fa fa-check"></i> Alert!</h4>
						Lead No <b>'.$cm->serial($leadId).'</b> Closed Successfully! <a onclick="history.go(-2)">Go Back</a> 
					 </div>
  					</div
  			<div class="clearfix"></div>
			';
			
				exit();
			}
		}
		else
		{
			$cm->update("lead", "status='$closeLead', unSucc_reason='$un_Succ_reason', closed_by=".$_SESSION['sessionId'].", close_date='".$cm->current_dt()."'", "id=".$leadId."");
		}
		//$c_m->success_message("Lead No ".$leadId." Closed Successfully <a href='lead_details.php?leadId=".$leadId."'>Go Back</a>");
		echo '
			<div class="col-md-4 col-md-offset-5" style="margin-top:2%;">
    			<div class="alert alert-success alert-dismissable">
					
					<h4> <i class="icon fa fa-check"></i> Alert!</h4>
					Lead No <b>'.$cm->serial($leadId).'</b> Closed Successfully! <a onclick="history.go(-2)">Go Back</a> </div>
  			</div
  			<div class="clearfix"></div>
			';
			exit;
		
}
?>
<div class="content-wrapper"> <br>
  <div class="col-md-6 col-md-offset-3"> <?php echo $lead->lead_transfer_alert($leadId) ?> </div>
  <div class="hide-this">
<?php if($row['status']=='new' || $row['status']=='process' || $row['status']=='successfull' || $cm->user_access("viewAllLeads", $_SESSION['sessionId']) || 
$cm->user_access("reopenLead", $_SESSION['sessionId'])){ ?>
    <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
      <h1> Dashboard <small>Control panel</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <h2><span class="main-heading" style="">Lead Details</span></h2>
    <div class="panel panel-default">
      <div class="panel-body"> <?php echo $cm->go_back() ?>
        <div class="clearfix"></div>
        <div class="col-lg-4 col-sm-4">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Lead Id: </b> <?php echo $cm->serial($leadId); ?></td>
              </tr>
              <tr>
                <td><b>Contact Name:</b> <i class="fa fa fa-male"></i> <?php echo $row['contact_name']; ?></td>
              </tr>
              <tr>
                <td><b>Primary Phone No:</b><i class="fa fa-fw fa-phone"></i> <?php echo $row['mobile']; ?></td>
              </tr>
              <tr>
                <td><b>Email:</b> <i class="fa fa-fw fa-envelope-o"></i> <?php echo $cm->emptyWord($row['email']); ?></td>
              </tr>
              <tr>
                <td><b>Service Name:</b> <?php echo $cm->emptyWord(ucwords($row['services'])); ?></td>
              </tr>
              <tr>
                <td><b>Sector:</b> <?php echo $cm->emptyWord(ucwords($row['sector'])); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- col-lg-4-->
        <div class="col-lg-4 col-sm-4">
          <table class="table">
            <tbody>
              <tr>
                <td><b>Service Date:</b> <i class="fa fa-fw fa-calendar-check-o"></i> <?php echo $row['create_date']; ?></td>
              </tr>
              <tr>
                <td><b>Date Created:</b> <i class="fa fa-fw fa-calendar-check-o"></i> <?php echo $row['create_date']; ?></td>
              </tr>
              <tr>
                <td><b>Lead Status:</b> <?php echo $cm->ls_clr($row['status']) ?>
              </tr>
              <tr>
                <td><b>Created By:</b> <i class="fa fa-user"></i> <?php echo $cm->u_value("user", "name", "id=".$row['created_by'].""); 
			  if($row['created_by']==0) {echo 'ONLINE';}
			  ?></td>
              </tr>
              <tr>
                <td><b>Taken Over By:</b> <i class="fa fa-user"></i> <?php echo $cm->u_value("user", "name", "id=".$row['spo']."") ?></td>
              </tr>
              <?php if(!empty($row['reopen_by'])){ ?>
              <tr>
                <td><b>Reopen Date:</b> <i class="fa fa-fw fa-calendar-check-o"></i> <?php echo $row['reopen_time'] ?></td>
              </tr>
              <tr>
                <td><b>Reopen By:</b> <i class="fa fa-user"></i> <?php echo $cm->u_value("user", "name", "id=".$row['reopen_by']."") ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- col-lg-4-->
        <div class="col-lg-4 col-sm-4">
          <table class="table">
            <tbody>
            
              <tr>
                <td><b>Transfer To:</b>
                  <select onChange="lead_transfer(<?php echo $leadId ?>)" name="t_t_spo" id="t_t_spo">
                    <option value="">Select spo</option>
                    <?php if($cm->user_access("transferLead", $_SESSION['sessionId']))
					{
						echo $cm->spo("", $_SESSION['branch_id']);
					}
					else
					{
						$tl=$cm->u_value("user", "team_leader", "id=".$_SESSION['sessionId']."");
						if($tl=='yes')
						{
							echo $cm->team_spo($_SESSION['sessionId']);
						}
					}
					?>
                  </select></td>
              </tr>
              <?php if($cm->user_access("ticket_msg", $_SESSION['sessionId'])){ ?>
              <tr>
                <td><button type="button" class="btn btn-success btn-xs btn-flat"
              onClick="desk_lead_msg( <?php echo $leadId ?>, <?php echo $row['spo'] ?>)"> <span class="glyphicon glyphicon-envelope"></span> Ticket Message </button></td>
              </tr>
              <?php } ?>
              <tr>
                <td><button type="button" class="btn btn-primary btn-xs btn-flat" onClick="set_reminder()"><i class="fa fa-fw fa-bell-o"></i> Set Reminder</button>
                </td>
              </tr>
              <tr>
                <td>
                <b>Recent Reminder</b>:  <?php echo $cm->u_value("reminder", "reminder_date","status='pending' AND leadId=".$leadId." ORDER BY id DESC LIMIT 1") ?> 
                </td>
              </tr>
              <tr>
                <td style="padding:2px; padding-left:10px;"><b> Priority Level:</b>
                <label style="font-weight:200 !important;"> Urgent
                    <input type="checkbox" class="lead-pr" 
				<?php if($row['lp']=="urgent") echo "checked" ?> value="urgent-<?php echo $leadId?>">
                  </label>
                  <label style="font-weight:200 !important;"> High
                    <input type="checkbox" class="lead-pr" 
				<?php if($row['lp']=="high") echo "checked" ?> value="high-<?php echo $leadId?>">
                  </label>
                  <label style="font-weight:200 !important;"> Medium
                    <input type="checkbox" class="lead-pr" 
				<?php if($row['lp']=="medium") echo "checked" ?> value="medium-<?php echo $leadId?>">
                  </label>
                  <label style="font-weight:200 !important;"> Low
                    <input type="checkbox" value="low-<?php echo $leadId?>" class="lead-pr" <?php if($row['lp']=="low") echo "checked" ?>>
                  </label></td>
              </tr>
              <?php if($cm->user_access("lead-feedback", $_SESSION['sessionId'])){ ?>
              <tr>
                <td><button type="button" class="btn btn-primary btn-xs btn-flat" onClick="client_feedback(<?php echo $leadId ?>)">
                  <i class="fa fa-fw fa-comment"></i> Client Feedback</button></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- col-lg-4--> 
      </div>
      <!--panel panel-default--> 
    </div>
    <!--============================Loader modal===========================-->
    <div class="modal fade" id="this-loader" role="dialog" style="overflow:scroll;">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="col-sm-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Loading........</h3>
            </div>
            <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay"> <i class="fa fa-refresh fa-spin"></i> </div>
            <!-- end loading --> 
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </div>
    <!--============================Loader modal===========================--> 
    <!--============================Success modal===========================-->
    <div class="modal fade" id="success-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="col-sm-12">
          <div class="alert alert-success alert-dismissable">
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            Opration Successfull.............. </div>
        </div>
      </div>
    </div>
    <!--============================Success modal===========================--> 
    <!--============================Error modal===========================-->
    <div class="modal fade" id="error-loader">
      <div class="modal-dialog"> 
        <!-- Modal content-->
        <div class="alert alert-danger alert-dismissable">
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          Operation Failed </div>
      </div>
    </div>
    <!--============================Error modal===========================-->
    <?php 
	  require_once'lead-tabs/client_requirements.php';
	  require_once'lead-tabs/lead-conversation.php';
   ?>
    <?php if($cm->user_access("sale_posting",$_SESSION['sessionId'])){ ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="nav nav-tabs nave-style">
          <li><a data-toggle="tab" href="#make_receipt">Make Receipt</a></li>
          <li><a data-toggle="tab" href="#ticket">Add Ticket</a></li>
          <li><a data-toggle="tab" href="#otherSale">Add Other Sale </a></li>
          <li><a data-toggle="tab" href="#tourSale">Tour Sale</a></li>
          <li><a data-toggle="tab" href="#refund">Refund</a></li>
          <!--<li><a data-toggle="tab" href="#ub">UB</a></li>-->
          <li><a data-toggle="tab" href="#xo">Xo</a></li>
          <li><a data-toggle="tab" href="#refund_payment">Refund Payment</a></li>
          <li><a data-toggle="tab" href="#quotation">Quotation </a></li>
          <li><a data-toggle="tab" href="#att-doc">Attach Doc </a></li>
          <li><a data-toggle="tab" href="#c_lead">Close Lead</a></li>
          <li><a data-toggle="tab" href="#c_form">Close Form</a></li>
        </ul>
        <div class="tab-content">
          <?php require_once'lead-tabs/make-receipt.php'; ?>
          <?php require_once'lead-tabs/add-ticket.php'; ?>
          <?php require_once'lead-tabs/other-sale.php'; ?>
          <?php require_once'lead-tabs/tour-sale.php'; ?>
          <?php require_once'lead-tabs/refund.php'; ?>
          <?php require_once'lead-tabs/xo.php'; ?>
          <?php require_once'lead-tabs/refund-payment.php'; ?>
          <?php require_once'lead-tabs/quotation.php'; ?>
          <?php require_once'lead-tabs/att-doc.php'; ?>
          <?php require_once'lead-tabs/close-lead.php'; ?>
          <div id="c_form" class="tab-pane fade"></div>
        </div>
        <!-- tab-content--> 
      </div>
      <!--panel-body--> 
    </div>
    <!--panel panel-default-->
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <?php require_once'lead-tabs/lead-ledger/set_ticket.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/set_other_sale.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/set_tour_sale.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/set_refund.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/set_receipt.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/set_refundPayment.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/set_refundPayment.php'; ?>
        <?php require_once'lead-tabs/lead-ledger/lead-ledger-summary.php'; ?>
      </div>
      <!-- panel-body--> 
    </div>
    <!-- panel-default-->
    
    <?php }
   elseif($row['status']=='unsuccessfull' || $cm->user_access("reopenLead", $_SESSION['sessionId']))
   {
	   echo '<div class="col-md-5 col-md-offset-3" style="margin-top:2%;">
    			<div class="alert alert-danger alert-dismissable">
					
					<h4> <i class="icon fa fa-check"></i> Alert! &emsp;(Unsuccessfull Lead)</h4>
					Reason: '.$row['unSucc_reason'].' &emsp;<a onclick="history.go(-1)" class="btn-link">Go Back</a> 
					OR <a href="lead_details?reopen=reopen&leadId='.$cm->encodeData($leadId).'">Reopen Lead</a>
					</div>
  			</div><div class="clearfix"></div>';
   }
   else
   {
    echo '<div class="col-md-5 col-md-offset-3" style="margin-top:2%;">
    			<div class="alert alert-danger alert-dismissable">
					
					<h4> <i class="icon fa fa-check"></i> Alert!</h4>
					You are Unable to view Closed Lead <a onclick="history.go(-1)">Go Back</a> 
					'.(($row['status']=='successfull' || $row['status']=='unsuccessfull')?'OR <a href="lead_details?reopen=reopen&leadId='.$cm->encodeData($leadId).'">Reopen Lead</a>' : "").'
					</div>
  			</div><div class="clearfix"></div>';
    }
	if(isset($_GET['reopen']) && !empty($_GET["reopen"]) && !empty($_GET["leadId"]))
   {
    $leadId=$cm->decodeData($_GET['leadId']);
    $cm->update("lead","status='pending', reopen_by='".$_SESSION['sessionId']."', reopen_time='".$cm->current_dt()."'","id=".$leadId."");
	header("location:lead_details?leadId=".$cm->encodeData($leadId)."");
   }
    ?>
  </div>
</div>
<!-- container-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(function() 
			{ $(".date" ).datepicker({
                format:"dd-mm-yyyy",
				<?php if(!$cm->user_access('edit', ''.$_SESSION['sessionId'].'')){ ?>
				startDate: "-1d",
				<?php } ?>
        	});
        });
		$(function() 
			{ $(".fdate" ).datepicker({
                format:"dd-mm-yyyy",
        	});
        });
</script>
<?php 
$cm->get_footer("")
?>
<script>
// show otehr vendor stock details
function other_stock(val, other_stock)
{
	if(val=="other")
	{
		$("#"+other_stock).show();
		$("#"+other_stock).html('<div class="col-sm-12">'+
		'<div class="form-group">'+
			'<label>Select Vendor</label><select class="form-control input-sm" onChange="s_term_c(this.value)" name="vendor_id">'+
			'<option value="">Select...</option><?php echo $cm->vendors(); ?>'+
			'</select></div></div>');
	}
	else
	{
		$("#"+other_stock).hide();
		$("#"+other_stock).html('');
	}
}
function lead_transfer(leadId)
{
	var t_t_spo=$("#t_t_spo").val();
	var sure=confirm("Are You Sure?");
	if(!sure)
	{
		return false;
	}
	//window.location='lead_details?leadId='+<?php echo $cm->encodeData($leadId) ?>+"&to="+t_t_spo
	//$(".lead-transfer").load("ajax_call/lead_transfer?leadId="+leadId+"&to="+t_t_spo);
	$(".hide-this").hide();
	$(".lead-transfer").show();
	$.ajax({
		url:"ajax_call/lead_transfer?leadId="+leadId+"&to="+t_t_spo,
		success: function(data)
		{
			
		}
	});
}
</script>