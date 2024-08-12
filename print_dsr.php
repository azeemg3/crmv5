<?php
require_once'inc.func.php';
session_start();
$query=$account->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$query->fetch_assoc();
?>
<link href="bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
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
if(!empty($_POST['dt_frm']) && !empty($_POST['dt_to']))
{
	$date_frm=$_POST['dt_frm'];
	$date_to=$_POST['dt_to'];
	$account=$account->search_reports("STR_TO_DATE(add_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND add_sale.branch=".$_SESSION['branch_id']." AND 
	add_sale.salesStaff=".$_SESSION['sessionId']."", 
	"STR_TO_DATE(other_sale.issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND other_sale.branch=".$_SESSION['branch_id']." AND other_sale.salesStaff=".$_SESSION['sessionId']."",
	 "STR_TO_DATE(ub_client_details.ub_issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND ub_client_details.branch=".$_SESSION['branch_id']." AND ub_client_details.salesStaff=".$_SESSION['sessionId']."", "STR_TO_DATE(issue_date, '%d-%m-%Y %H:%i:%s') BETWEEN  STR_TO_DATE('$date_frm', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_to', '%d-%m-%Y %H:%i:%s') AND branch=".$_SESSION['branch_id']." AND spo=".$_SESSION['sessionId']."");
	
}
else
{
	$account=$account->search_reports("add_sale.issue_date='".$cm->today()."' AND add_sale.branch='".$_SESSION['branch_id']."' AND add_sale.salesStaff=".$_SESSION['sessionId']."", "other_sale.issue_date='".$cm->today()."' AND other_sale.branch=".$_SESSION['branch_id']." AND other_sale.salesStaff=".$_SESSION['sessionId']."", "ub_client_details.ub_issue_date='".$cm->today()."' AND ub_client_details.branch=".$_SESSION['branch_id']." AND ub_client_details.salesStaff=".$_SESSION['sessionId']."", "issue_date='".$cm->today()."' AND branch=".$_SESSION['branch_id']." AND spo=".$_SESSION['sessionId']."");
}
?>
<title>Print Sale Report</title>
<div id="print">
<div id="wrapper">
<div id="header">
        	<div id="tvt"><img src="branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
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
                <th width="10%">Issue Date</th>
                <th width="10%">Time</th>
                <th width="10%" title="Ticket No">T.N</th>
                <th width="5%" title="Receipt No">R.N</th>
                <th width="10%" title="Supplier Name">S.Name</th>
                <th width="10%">Passenger</th>
                <th width="15%">Sector</th>
                <th width="10%">A/c Details</th>
                <th width="10%">Spo</th>
                <th width="5%">Received</th>
                <th width="5%">Net</th>
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
