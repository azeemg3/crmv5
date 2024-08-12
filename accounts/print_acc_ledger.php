<?php
require_once'../inc.func.php';
session_start();
$obRow="";
if(isset($_POST['trans_acc_id']) && !empty($_POST['trans_acc_id']))
{
	$trans_acc_id=$_POST['trans_acc_id'];
	$ob_result=$cm->selectData("trans_acc","trans_acc_id=".$trans_acc_id." LIMIT 1");
	$balance="";
	$array=array();	
	$arrayofArray=array();
	$whereArray=array();
	$sWhere="";
	if(!empty($_POST['dt_frm']) && !empty($_POST['dt_to']))
	{
		$dt_frm=$_POST['dt_frm'];
		$dt_to=$_POST['dt_to'];
		$whereArray[]="STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ') AND status='approved' AND trans_acc_id=".$trans_acc_id.""; 
		$sWhere = implode(" AND ", $whereArray);
	}
	while($ob_row=$ob_result->fetch_assoc())
	{
		$balance+=$administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id']);
		$obRow.='
				<tr>
					<td colspan="3" align="right">Opening Balance As At '.$dt_frm.'</td>
					<td>'.(($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])>0)?'
			'.number_format(abs($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"0.00").'</td>
					<td>'.(($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])<0)?'
			'.number_format(abs($administrator->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"0.00").'</td>
					<td>'.$cm->show_bal($balance).'</td>
				</tr>
			';
	}
	$bal="";
	$det="";
	$newArray=array();
	$result=$cm->selectData("trans","{$sWhere}");
	while($row=$result->fetch_assoc())
	{
	   if($row['dr_cr']=='dr'){$bal+=$row['amount'];}
	   elseif($row['dr_cr']=='cr'){$bal+='-'.$row['amount'];}
	   if($row['amount']>0)
	   {
	   $det.='
	   		<tr>
				<td>'.$row['trans_date'].'</td>
				<td>'.$row['vt'].'-'.$cm->serial($row['trans_code']).'</td>
				<td>'.$row['narration'].'</td>
				<td>'.(($row['dr_cr']=='dr')?''.$row['amount'].'':"0.00").'</td>
				<td>'.(($row['dr_cr']=='cr')?''.$row['amount'].'':"0.00").'</td>
				<td>'.$cm->show_bal($bal+$balance).'</td>
			</tr>
	   	';
	   }
	}
}
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
<title>Print Sale Report</title>
<body onLoad="print_data()">
<div id="print_data">
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
        <div id="exchange"><?php echo $cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$trans_acc_id.""); ?>' Ledger</div>
  <table border="1" align="center" width="100%" style="border-collapse:collapse; font-size:12px;">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
        <td width="10%">Date</td>
        <td>Voucher</td>
        <td>Description</td>
        <td>Debit</td>
        <td>Credit</td>
        <td width="10%">Balance</td>
    </tr>
    </thead>
    <?php echo $obRow;  ?>
    <?php echo $det  ?>
    </table>
    <br>
    <span style="float:left;">Printy By: <?php echo $cm->u_value("user","name","id=".$_SESSION['sessionId']."") ?></span>	
    <span style="float:right;">Print Date: <?php echo $cm->today(); ?></span>
</div>
</div>