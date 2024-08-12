<?php
require_once'../inc.func.php';
session_start();
$file=$_POST['type'];
$account=new account();
$query=$account->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$query->fetch_assoc();
?>
<link href="../bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function print_data() {
		document.getElementById("print_data").style.display="none";
		window.print();
		setTimeout(function() {window.close();},0);
	};
</script>
<style media="print">
@page {
  size: auto;
  margin:1 auto;
       }
table{ font-size:12px;}
</style>
<?php
if($file=="sale"){
if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$_SESSION['branch_id'];}
if(!empty($_POST['frm_dt']) && !empty($_POST['to_dt']) && empty($_POST['spo']))
{
	$date_frm=$_POST['frm_dt'];
	$date_to=$_POST['to_dt'];
	$account=$account=$account->search_reports("STR_TO_DATE(add_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND add_sale.branch=".$branch."", 
	"STR_TO_DATE(other_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND other_sale.branch=".$branch."",
	 "STR_TO_DATE(ub_client_details.ub_issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND ub_client_details.branch=".$branch."", "STR_TO_DATE(issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND branch=".$branch."");
	
}
else if(!empty($_POST['spo']) && empty($_POST['frm_dt']) && empty($_POST['to_dt']))
{
	$spo=$_POST['spo'];
	if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$branch;}
	$account=$account->search_reports("add_sale.salesStaff='$spo' AND add_sale.branch=".$branch."", "other_sale.salesStaff='$spo'
	 AND other_sale.branch=".$branch."", "ub_client_details.salesStaff='$spo' AND ub_client_details.branch=".$branch."", "spo=".$spo." AND branch=".$branch."");
}
else if(!empty($_POST['frm_dt']) && !empty($_POST['to_dt']) && !empty($_POST['spo']))
{
	$date_frm=$_POST['frm_dt'];
	$date_to=$_POST['to_dt'];
	$spo=$_POST['spo'];
	if(!empty($_POST['branch'])){ $branch=$_POST['branch']; } else {$branch=$user_branch;}
	$account=$account->search_reports("STR_TO_DATE(add_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND add_sale.branch=".$branch." AND add_sale.salesStaff='$spo'", 
	"STR_TO_DATE(other_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND other_sale.branch=".$branch." AND other_sale.salesStaff='$spo'",
	 "STR_TO_DATE(ub_client_details.ub_issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND ub_client_details.branch=".$branch." AND ub_client_details.salesStaff='$spo'", 
	 "STR_TO_DATE(issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND spo=".$spo." AND branch=".$branch."");
}
else if(empty($_POST['frm_dt']) && empty($_POST['to_dt']) && empty($_POST['spo']) && empty($_POST['air_code']) && 
empty($_POST['ticket_no']) && !empty($_POST['passport_num']))
{
	$pass_num=$_POST['passport_num'];
	$account=$account->search_reports("0", 
	"other_sale.passport_num='$pass_num'  AND  other_sale.branch=".$branch."",
	 "0",0);
}
else
{
	$account=$account->search_reports("add_sale.issue_date='".$account->today()."' AND add_sale.branch='".$branch."'", "other_sale.issue_date='".$account->today()."' AND other_sale.branch='".$branch."'", "ub_client_details.ub_issue_date='".$account->today()."' AND ub_client_details.branch='$branch'", "issue_date='".$account->today()."' AND branch=".$branch."");
}
}
?>
<title>Print Sale Report</title>
<div id="print">
<div id="wrapper">
<div id="header">
        	<div id="tvt"><img src="../branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
            <div id="header-mid">
            	<div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
                <p align="center"><?php echo nl2br($branch_data['address']) ?>
                      
    			</p>
            </div>
            <!--<div id="iata"></div>-->
        </div>
        <hr />
        <div id="exchange">Sale Report</div>
  <table border="1" align="center" width="100%" style="border-collapse:collapse; font-size:12px;">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th title="Lead Id">L.Id</th>
                <th >Issue Date</th>
                <th>Time</th>
                <th title="Ticket No">T.N</th>
                <th title="Receipt No">R.N</th>
                <th title="Supplier Name">GDS/S.Name</th>
                <th>Passenger</th>
                <th>Sector</th>
                <th>A/c Details</th>
                <th>Spo</th>
                <th>Received</th>
                <th>Net</th>
                <th>PSF</th>
            </tr>
    </thead>
    <?php
	echo $account;
	?>
    </table>
<button style="margin-top:5px;" id="print_data" onClick="print_data()" type="button">Print</button>
</div>
</div>
