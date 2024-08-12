<?php
require_once'../inc.func.php';
session_start();
//total reminder
date_default_timezone_set("Asia/karachi");
$count_reminder=$cm->count_val("reminder", "id", "status='pending' AND userId=".$_SESSION['sessionId']." AND reminder_date='".date('d-m-Y')."' AND 
        reminder_time=".date('G')."");
$alert=$cm->u_value("user","alert_notification", "id=".$_SESSION['sessionId']." AND branch_id=".$_SESSION['branch_id']."");
if($alert=='on')
{
echo '<div class="footerdiv col-md-12">';
		if($lead->P_L($_SESSION['sessionId'])>0)
		{
            echo '<div class="col-md-4 alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    <a href="availLeads">You have '.$lead->P_L($_SESSION['sessionId']).' Pending Leads.</a>
           </div>';
		}
        echo'<div class="clearfix"></div>';
		if($count_reminder>0)
		{
            echo '<div class="col-md-4 alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    You have '.$count_reminder.' Pending Reminder. (Clcik at the top right Bell Button)
           </div>';
		}
        echo '<div class="clearfix"></div>
        '.$lead->desk_lead_msg_alert($_SESSION['sessionId']).';
		<div class="clearfix"></div>
		'.$account->receipt_app_alert($_SESSION['sessionId']).'
		<div class="clearfix"></div>
	   '.$account->receipt_void_alert($_SESSION['sessionId']).'
	   <div class="clearfix"></div>
	   '.$account->receipt_pending_alert().'
    </div>';
    $res=$cm->selectData("reminder","status='pending' and lc=1 and userId=".$_SESSION['sessionId']."");
    while($row=$res->fetch_assoc()){
        echo '<div class="footerdiv col-md-12">
            <div class="col-md-4 alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    Lead has been closed (Clcik at the top right Bell Button)
           </div><div class="clearfix"></div>
        /div>';
    }
    
}
?>