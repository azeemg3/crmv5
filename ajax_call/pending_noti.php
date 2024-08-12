<?php
require_once'../inc.func.php';
session_start();
$result=$cm->selectData("reminder", "status='pending' AND userId=".$_SESSION['sessionId']."");
$rem_list="";
while($row=$result->fetch_assoc())
{
	date_default_timezone_set("Asia/karachi");
	//$remDate = new DateTime(''.$row['reminder_date'].' '.$row['reminder_time'].':'.$row['reminder_min'].'');
	$remDate =$row['reminder_date'];
	//$cd = new DateTime($cm->current_dt());
	$cd =strtotime(date('d-m-Y'));
	if(strtotime($remDate)<=$cd && $row['reminder_time']<=date('H'))
	{	
		$rem_list.='
		<li>
			<a onClick="reminder_view('.$row['id'].')">
			  <i class="fa fa-clock-o"></i>'.$row['message'].'
			</a>
		</li>
			';
	}
}
echo '
	<li>
		<a href="availLeads">
		  <i class="fa fa-users text-aqua"></i>You have '.$lead->P_L($_SESSION['sessionId']).' Pending Leads.
		</a>
	</li>
	'.$rem_list.'
';
?>