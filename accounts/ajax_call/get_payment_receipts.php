<?php
require_once'../../inc.func.php';
session_start();
if(!empty($_POST))
{
	$idf=$ids="";
$frm_dt=$_POST['frm_dt'];
$to_dt=$_POST['to_dt'];
$whereArr = array();
$whereArr_2=array();
if($frm_dt && $to_dt != ""){ $whereArr[] = "STR_TO_DATE(payment_reciept.app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$frm_dt', '%d-%m-%Y') AND STR_TO_DATE('$to_dt', '%d-%m-%Y ') AND payment_reciept.branch=".$_SESSION['branch_id']."";
/*$search=$account->adv_filt("$frm_dt, $to_dt", "STR_TO_DATE(payment_reciept.create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$frm_dt', '%d-%m-%Y') AND STR_TO_DATE('$to_dt', '%d-%m-%Y ')");*/
$whereArr_2[] = "STR_TO_DATE(refund_payment.app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$frm_dt', '%d-%m-%Y') AND STR_TO_DATE('$to_dt', '%d-%m-%Y ') AND refund_payment.branch=".$_SESSION['branch_id']."";
}
else
{
	$whereArr[]="branch=".$_SESSION['branch_id']." ORDER BY id DESC LIMIT 10";
	$whereArr_2[]="branch=".$_SESSION['branch_id']." ORDER BY id DESC LIMIT 10";
}
$whereStr = implode(" AND ", $whereArr);
$whereStr_2 = implode(" AND ", $whereArr_2);
$r_query=$cm->selectMultiData("user.name,lead.contact_name,  payment_reciept.*", "payment_reciept INNER JOIN user ON payment_reciept.userId=user.id
INNER JOIN lead ON payment_reciept.leadId=lead.id", "{$whereStr}");
$r_p_query=$cm->selectMultiData("user.name,lead.contact_name,  refund_payment.*", "refund_payment INNER JOIN user ON refund_payment.userId=user.id
INNER JOIN lead ON refund_payment.leadId=lead.id", "{$whereStr_2}");
}
while($row=$r_query->fetch_assoc())
{
	$idf=$row['id'];
	echo'
		<tr id="'.$row['id'].'">
			<td>'.$row['app_date'].'</td>
			<td>'.$row['name'].'</td>
			<td>RV-'.$row['TPRV'].'</td>
			<td>'.$row['contact_name'].'</td>
			<td>'.$row['payment_type'].'</td>
			<td>'.$row['amount'].'</td>
			<td>'.$row['status'].'</td>
			<td>
			 <a href="print_receipt?id='.$row['id'].'" target="_blank"><i class="fa fa-print"></i></a> 
			 <a  style="margin-left:10px;" href="javascript::void(0)" onclick="del_rec(\'../\', \'receipt\', \''.$row['id'].'\')"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		';
}
while($row=$r_p_query->fetch_assoc())
{
	$ids=$row['id'];
	echo'
		<tr>
			<td>'.$row['app_date'].'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['id'].'</td>
			<td>'.$row['contact_name'].'</td>
			<td>'.$row['payment_type'].'</td>
			<td>'.$row['amount'].'</td>
			<td>'.$row['status'].'</td>
			<td>
			 <a href="print_receipt?refId='.$row['id'].'" target="_blank"><i class="fa fa-print"></i></a>
			  <a  style="margin-left:10px;" href="javascript::void(0)" onclick="del_rec(\'../\', \'rp\', \''.$row['id'].'\')"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		';
}
if(empty($idf) && empty($ids)){$cm->nothing_found(0, 10);}
?>