<?php
require_once'../inc.func.php';
session_start();
$query=$cm->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$query->fetch_assoc();
?>
<link href="../bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function print_data() {
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
if($_POST['file']=='spo_position')
{
$sWhere="";
$whereArray=array();
// add_sale, other_sale, tour_sale
$sWhereSale="";
$whereArraySale=array();
//refund, refund payment, payment receipts
$sWhereRP="";
$whereArrayRP=array(); $array=array();
if(isset($_POST) && !empty($_POST['branch']) && !empty($_POST['spo']))
{
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	$df=$_POST['df'];
	$dt=$_POST['dt'];
	if(!empty($branch) && !empty($spo))
	{
		$whereArray[]='lead.spo='.$spo.'';
		$sWhere=implode("AND", $whereArray);
		if(!empty($df) && !empty($dt))
		{
			$whereArraySale[]="AND STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$dt."', '%d-%m-%Y')";
			$sWhereSale=implode("AND",$whereArraySale);
			//***************************************
			$whereArrayRP[]="AND STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$dt."', '%d-%m-%Y')";
			$sWhereRP=implode("AND", $whereArrayRP);
		}
		
	}
	$query=$cm->selectMultiData("lead.id AS leadId, lead.contact_name", 
	"lead INNER JOIN user ON lead.spo=user.id", "{$sWhere}");
	while($row=$query->fetch_assoc())
	{
		$ob=$lead->lead_ob($df, $dt, $row['leadId']);
		$inv=$cm->u_total("add_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}");
		$refund=$cm->u_total("refund", "net", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}")+$lead->l_psf($row['leadId'], $df, $dt)-$cm->u_total("refund", "services_charges", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$dn=$cm->u_total("other_sale", "recieved", "leadId=".$row['leadId']." {$sWhereSale}")+$tour->lead_tour_ledger($df, $dt,$row['leadId']);
		$rec=$cm->u_total("payment_reciept","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$payment=$cm->u_total("refund_payment","amount", "leadId=".$row['leadId']." AND status='approved' {$sWhereRP}");
		$cb=$ob+$inv+$dn-$refund-$rec+$payment;
		$arrayOfArray['all_data']=array("leadId"=>$row['leadId'], "client_name"=>$row['contact_name'], 
		"ob"=>$ob,
		"invoices"=>$inv, 
		"refund"=>$refund,
		"debit_note"=>$dn,
		"receipts"=>$rec,
		"payments"=>$payment,
		"cb"=>$cb
		);
		$array[]=$arrayOfArray;
	}
}

?>
<title>Spo Position Reports</title>
<body onLoad="print_data()">
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
        <h4 align="center">SPO Position Report for the period From <?php echo $df ?> To <?php echo $dt ?></h4>
  <table border="1" align="center" width="100%" style="border-collapse:collapse; font-size:12px;">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
          <th>Lead Id</th>
          <th>Client Name</th>
          <th>Opening Balance</th>
          <th>Invoice</th>
          <th>Void Refund</th>
          <th>Debit Note</th>
          <th>Receipts</th>
          <th>Payments</th>
          <th>Closing Balance</th>
      </tr>
    </thead>
    <?php
	$opening_bal=0; $t_inv=0; $t_refund=0; $t_dn=0; $t_rec=0; $t_payment=0; $closing_bal=0;
	foreach($array as $data)
	{
		if($data['all_data']['cb']!=0)
		{
	echo '
		<tr>
		 <td>'.$cm->serial($data['all_data']['leadId']).'</td>
		 <td>'.$data['all_data']['client_name'].'</td>
		 <td>'.number_format($data['all_data']['ob']).'</td>
		 <td>'.number_format($data['all_data']['invoices']).'</td>
		 <td>'.number_format($data['all_data']['refund']).'</td>
		 <td>'.number_format($data['all_data']['debit_note']).'</td>
		 <td>'.number_format($data['all_data']['receipts']).'</td>
		 <td>'.number_format($data['all_data']['payments']).'</td>
		 <td>'.number_format($data['all_data']['cb']).'</td>
		</tr>
		';
		$opening_bal+=$data['all_data']['ob'];
		$t_inv+=$data['all_data']['invoices'];
		$t_refund+=$data['all_data']['refund'];
		$t_dn+=$data['all_data']['debit_note'];
		$t_rec+=$data['all_data']['receipts'];
		$t_payment+=$data['all_data']['payments'];
		$closing_bal+=$data['all_data']['cb'];
		}
	}
	    echo'
		<tr>
		 <td colspan="3" align="right">'.number_format($opening_bal).'</td>
		 <td><strong>'.number_format($t_inv).'</strong></td>
		 <td><strong>'.number_format($t_refund).'</strong></td>
		 <td><strong>'.number_format($t_dn).'</strong></td>
		 <td><strong>'.number_format($t_rec).'</strong></td>
		 <td><strong>'.number_format($t_payment).'</strong></td>
		 <td><strong>'.number_format($closing_bal).'</strong></td>
		</tr>
		';
	?>
    </table>
</div>
</div>
<?php } ?>
