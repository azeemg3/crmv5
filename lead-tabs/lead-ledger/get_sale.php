<?php
require_once'../../inc.func.php';
session_start();
$sWhere="";
$whereArray=array();
if(isset($_GET['leadId']) && !empty($_GET['leadId']))
{
	$leadId=$_GET['leadId'];
	if($_GET['type']=="ticket")
	{
		if(isset($_POST))
		{
			$dt_frm=$_POST['dt_frm'];
			$dt_to=$_POST['dt_to'];
			if(!empty($dt_frm) && !empty($dt_to)) $whereArray[]="STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ')";
			else $whereArray[]="leadId=".$leadId." AND status!='done'"; 
			$whereArray[]="leadId=".$leadId."";
			$sWhere = implode(" AND ", $whereArray);
		}
		$result=$cm->selectData("add_sale", "{$sWhere} ORDER BY id DESC");
		echo $lead->ticket_sale($result);
		exit;
	}
	elseif($_GET['type']=="other_sale")
	{
		if(isset($_POST))
		{
			$dt_frm=$_POST['dt_frm'];
			$dt_to=$_POST['dt_to'];
			if(!empty($dt_frm) && !empty($dt_to)) $whereArray[]="STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ')";
			else $whereArray[]="leadId=".$leadId." AND status!='done'";
			$whereArray[]="leadId=".$leadId."";
			$sWhere = implode(" AND ", $whereArray);
		}
		$result=$cm->selectData("other_sale", "{$sWhere} ORDER BY id DESC");
		echo $lead->other_sale($result);
		exit;
	}
	elseif($_GET['type']=="refund")
	{
		$result=$cm->selectData("refund", "leadId=".$leadId." ORDER BY id DESC");
		echo $lead->refund($result);
		exit;
	}
	elseif($_GET['type']=="receipt")
	{
		$result=$cm->selectData("payment_reciept", "leadId=".$leadId." AND status='approved' ORDER BY id DESC");
		echo $lead->payment_receipt($result);
		exit;
	}
	elseif($_GET['type']=="refundPayment")
	{
		$result=$cm->selectData("refund_payment", "leadId=".$leadId." AND status='approved' ORDER BY id DESC");
		echo $lead->refund_payment($result);
		exit;
	}
	elseif($_GET['type']=="tour_sale")
	{
		$tourSale=new tourSale();
		$list=""; $total=0;
		$id="";
		$count=1;
		if(isset($_GET['leadId']) && !empty($_GET['leadId']))
			{
			if(isset($_POST))
			{
				$dt_frm=$_POST['dt_frm'];
				$dt_to=$_POST['dt_to'];
				if(!empty($dt_frm) && !empty($dt_to)) $whereArray[]="STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ')";
				else $whereArray[]="leadId=".$leadId." AND leadId!='' AND status!='done'";
				$whereArray[]="leadId=".$leadId."";
				$sWhere = implode(" AND ", $whereArray);
			}
			$query=$tourSale->selectData("tour_sale_invoice", "{$sWhere} ORDER BY id DESC");
			while($tourSale->fetcol=$tourSale->fetchData($query))
			{
				$id=$tourSale->col('id');
				$tVisa=$tourSale->u_total("tour_visa", "t_visaSp", "uniqueId='".$tourSale->col('uniqueId')."'");
				$tHotel=$tourSale->u_total("tour_hotel", "t_hotelSp", "uniqueId='".$tourSale->col('uniqueId')."'");
				$tTrans=$tourSale->u_total("tour_transport", "t_transSp", "uniqueId='".$tourSale->col('uniqueId')."'");
				$tTour=$tourSale->u_total("tour_tour", "t_tourSp", "uniqueId='".$tourSale->col('uniqueId')."'");
				$tOther=$tourSale->u_total("tour_other", "t_serSp", "uniqueId='".$tourSale->col('uniqueId')."'");
				$net=$tVisa+$tHotel+$tTrans+$tTour+$tOther;
				$total+=$net;
				$list.= '
						<tr id="'.$tourSale->col('uniqueId').'">
							<td>'.$count++.'</td>
							<td>'.$tourSale->col('issue_date').'</td>
							<td>'.$tourSale->col('invoice_no').'</td>
							<td>'.$tourSale->u_value('user', "name", "id=".$tourSale->col('userId')."").'</td>
							<td>'.$cm->amount_format($tVisa).'</td>
							<td>'.$cm->amount_format($tHotel).'</td>
							<td>'.$cm->amount_format($tTrans).'</td>
							<td>'.$cm->amount_format($tTour).'</td>
							<td>'.$cm->amount_format($tOther).'</td>
							<td>'.$cm->show_bal($net).'</td>
							<td>
							'.((date('d-m-Y', strtotime($tourSale->col('issue_date')))==$cm->today())?'
							<a href="javascript:void(0)" onClick="del_rec(\'\', \'tour-sale\', \''.$tourSale->col('uniqueId').'\')"><span class="glyphicon glyphicon-remove"></span></a> | 
								 <a onclick="v_ts_inv_det(\''.$tourSale->col('uniqueId').'\')">
								 <span class="glyphicon glyphicon-open"></span>View Details</a>
							':'
							'.(($cm->user_access('edit', ''.$_SESSION['sessionId'].''))?'
							<a href="javascript:void(0)" onclick="del_rec(\'\', \'tour-sale\', \''.$tourSale->col('uniqueId').'\')">
							<span class="glyphicon glyphicon-remove"></span></a> | 
								 <a onclick="v_ts_inv_det(\''.$tourSale->col('uniqueId').'\')">
								 <span class="glyphicon glyphicon-open"></span>View Details</a>
							':'N/A').'
							').'
							</td>
						</tr>
				';
			}
			$list.='
					<tr>
					 <td colspan="9" align="right"><strong>Total</strong></td>
					 <td colspan="2">'.$cm->show_bal($total).'</td>
					</tr>
				';
			$list.=$tourSale->nothing_found($id, 12);
			echo $list;
		}
		
	}
	elseif($_GET['type']=="att_doc")
	{
		if(isset($_POST))
		{
			$passName=$_POST['passName'];
			$eNumber=$_POST['e_number'];
			if(!empty($passName)) $whereArray[]="passName LIKE '%".$passName."%'";
			if(!empty($eNumber)) $whereArray[]="e_number='".$eNumber."'";
			$whereArray[]="leadId=".$leadId."";
			$sWhere = implode(" AND ", $whereArray);
		}
		$result=$cm->selectData("att_document", "{$sWhere} ORDER BY doc_id DESC LIMIT 5");
		echo $lead->att_document($result);
		exit;
	}
}
?>