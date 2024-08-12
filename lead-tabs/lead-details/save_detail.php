<?php
require_once'../../inc.func.php';
session_start();
if(isset($_GET['type']) && $_GET['type']=="ticket")
{
	$data=$_POST;
	$leadId=$_GET['leadId'];
	if(!empty($_POST['airline_code']) && !empty($_POST['ticket_no']) && !empty($_POST['passName']))
	{
		if(isset($_POST['id']) && !empty($_POST['id']))
		{
			$data['last_update_at']=$cm->current_dt();
			if(!isset($_PSOT['vendor_id']) && empty($_POST['vendor_id'])){$data['vendor_id']="";}
			// updated transacton according to the sale udpattion
			$trans_code=$cm->u_value("add_sale","trans_code","id=".$_POST['id']."");
			$dataArray['amount']=$_POST['netCost'];
			$dataArray['narration']=$_POST['passName']." ".$_POST['accDetails'];
			$dataArray['trans_acc_id']=$_POST['vendor_id'];
			$query=$cm->update_array("add_sale", $data, "id=".$_POST['id']."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
		}
		else
		{
			$data['leadId']=$leadId;
			$data['userId']=$_SESSION['sessionId'];
			$data['create_date']=$cm->current_dt();
			$data['trans_code']=$administrator->trans_code();
			$query=$cm->insert_array("add_sale",$data);
			// transaction account
			$dataArray['amount']=$_POST['netCost'];
			$dataArray['narration']=$_POST['passName']." ".$_POST['accDetails'].'('.$_POST['airline_code'].'-'.$_POST['ticket_no'].')';
			$dataArray['dr_cr']='cr';
			$dataArray['trans_date']=$cm->today();
			$dataArray['status']='approved';
			if(isset($_POST['vendor_id']) && !empty($_POST['vendor_id'])){
			$dataArray['trans_acc_id']=$_POST['vendor_id'];}
			$dataArray['userId']=$_SESSION['sessionId'];
			$dataArray['branch_id']=$_SESSION['branch_id'];
			$dataArray['vt']='TR';
			$dataArray['trans_code']=$administrator->trans_code();
			$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
			$lead->c_l_s($leadId);
		}
	}
		if($query==1){$query=1;}
		else{$query= 2;}
		$result=$cm->selectData("add_sale", "leadId=".$leadId." ORDER BY id DESC");
		echo $query,"~",$lead->ticket_sale($result);
}
else if(isset($_GET['type']) && $_GET['type']=="other_sale")
{
	$data=$_POST;
	$leadId=$_GET['leadId'];
	if(!empty($_POST['passName']))
	{
		if(isset($_POST['id']) && !empty($_POST['id']))
		{
			$data['last_update_at']=$cm->current_dt();
			if(!isset($_PSOT['vendor_id']) && empty($_POST['vendor_id'])){$data['vendor_id']="";}
			$trans_code=$cm->u_value("other_sale","trans_code","id=".$_POST['id']."");
			// updated transacton according to the sale udpattion
			$dataArray['amount']=$_POST['netCost'];
			$dataArray['narration']=$_POST['passName']." ".$_POST['sales_detail'];
			$dataArray['trans_acc_id']=$_POST['vendor_id'];
			$query=$cm->update_array("other_sale", $data, "id=".$_POST['id']."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
		}
		else
		{
			$data['leadId']=$leadId;
			$data['userId']=$_SESSION['sessionId'];
			$data['create_date']=$cm->current_dt();
			$data['trans_code']=$administrator->trans_code();
			$query=$cm->insert_array("other_sale",$data);
			// transaction account
			$dataArray['amount']=$_POST['netCost'];
			$dataArray['narration']=$_POST['passName']." ".$_POST['sales_detail'];
			$dataArray['dr_cr']='cr';
			$dataArray['trans_date']=$cm->today();
			$dataArray['status']='approved';
			$dataArray['trans_acc_id']=$_POST['vendor_id'];
			$dataArray['userId']=$_SESSION['sessionId'];
			$dataArray['branch_id']=$_SESSION['branch_id'];
			$dataArray['vt']='DN';
			$dataArray['trans_code']=$administrator->trans_code();
			$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
			$lead->c_l_s($leadId);
		}
		if($query==1){$query=1;}
		else{$query= 2;}
	}
	$result=$cm->selectData("other_sale", "leadId=".$leadId." ORDER BY id DESC");
	echo $query,"~",$lead->other_sale($result);
}
else if(isset($_GET['type']) && $_GET['type']=="receipt" && !empty($_SESSION['sessionId']) && !empty($_SESSION['branch_id']))
{
	if($_POST['total_inv_amount']>0)
	{
		$leadId=$_GET['leadId'];
		$data['recieve']=$_POST['recieve'];
		$data['refrence']=implode(",", $_POST['refrence']);
		$data['sector']=$_POST['sector'];
		$data['amount']=$_POST['total_inv_amount'];
		$data['payment_type']=$_POST['payment_type'];
		$data['remarks']=$_POST['remarks'];
		$data['leadId']=$leadId;
		$data['userId']=$_SESSION['sessionId'];
		$data['branch']=$_SESSION['branch_id'];
		$data['status']='pending';
		$data['create_date']=$cm->current_dt();
		$data['trans_acc_id']=$_POST['bank_id'];
		$data['trans_code']=$administrator->trans_code();
		$data['desk_alert']='no';
		$query=$cm->insert_array("payment_reciept",$data);
		$lastId=$cm->u_value("payment_reciept", "id", "leadId=".$leadId." ORDER BY id DESC");
		// Aging Sale invoice
		$countRefNo=count($_POST['refrence']);
		for($i=0; $i<$countRefNo; $i++)
		{
			if(!empty($_POST['refrence'][$i]))
			{
			$cm->insertData_multi("sale_inv_aging", "invoice_number, amount, status, userId, branch_id, rec_id", "'".$_POST['refrence'][$i]."', '".$_POST['amount'][$i]."','pending','".$_SESSION['sessionId']."', '".$_SESSION['branch_id']."', '".$lastId."'");
			}
		}
		// insert payment details
		// cash payment transaction
		if(isset($_POST['payment_type']) && $_POST['payment_type']=='cash')
		{
			$bank_det['narration']=$_POST['remarks'].'...From:'.$cm->u_value("lead","contact_name","id=".$leadId."");
		}
		elseif(isset($_POST['payment_type']) && $_POST['payment_type']=='online' || $_POST['payment_type']=='cheque' || $_POST['payment_type']=='pay_order' || $_POST['payment_type']=='demand_draft')
		{
			$bank_det['narration']='Bank Branch:'.$_POST['bank_branch']." ,Ref Number: ".$_POST['ref_number'].'.........
		From:'.$cm->u_value("lead","contact_name","id=".$leadId."");
		}
		elseif(isset($_POST['payment_type']) && $_POST['payment_type']=='card')
		{
			$bank_det['narration']='Card Company:'.$_POST['card_type']." ,Company Card: ".$_POST['card_comp'].', Card Number:
			'.$_POST['ref_number'].''.'.........
		From:'.$cm->u_value("lead","contact_name","id=".$leadId."");
		}
		if(isset($_POST['bank_id']) && !empty($_POST['bank_id'])){
		$payment_det['trans_acc_id']=$_POST['bank_id'];
		if(!empty($_POST['bank_branch']))
		{
			$payment_det['bank_branch']=$_POST['bank_branch'];
		}
		if(!empty($_POST['ref_number']))
		{
			$payment_det['ref_number']=$_POST['ref_number'];
		}
		// bank transacton 
		$bank_det['trans_acc_id']=$_POST['bank_id'];
		$bank_det['trans_date']=$cm->today();
		$bank_det['amount']=$_POST['total_inv_amount'];
		$bank_det['dr_cr']='dr';
		$bank_det['status']='pending';
		$bank_det['branch_id']=$_SESSION['branch_id'];
		$bank_det['userId']=$_SESSION['sessionId'];
		}
		if(isset($_POST['card_type'])){
		$payment_det['card_type']=$_POST['card_type'];
		$payment_det['card_comp']=$_POST['card_comp'];
		//$payment_det['ref_number']=$_POST['ref_number'];
		}
		if(isset($_POST['bank_id']) && !empty($_POST['bank_id']))
		{
			$bank_det['trans_code']=$administrator->trans_code();
			$bank_det['vt']='RV';
			$cm->insert_array("trans",$bank_det, "create_date","NOW()");
		}
		$payment_det['rec_id']=$lastId;
		$cm->insert_array("payment_detail", $payment_det);
		if($query==1){$query=1;}
		else{$query= 2;}
	}
	$result=$cm->selectData("payment_reciept", "leadId=".$leadId." AND status='approved'");
	echo $query,"~",$lead->payment_receipt($result);
}
else if(isset($_GET['type']) && $_GET['type']=="refund")
{
	if(!empty($_POST['airline_code']) && !empty($_POST['ticket_no']) || !empty($_POST['passName']))
	{
		$data=$_POST;
		$leadId=$_GET['leadId'];
		if(isset($_POST['id']) && !empty($_POST['id']))
		{
			$data['last_update_at']=$cm->current_dt();
			$query=$cm->update_array("refund", $data, "id=".$_POST['id']."");
		}
		else
		{
			$data['leadId']=$leadId;
			$data['userId']=$_SESSION['sessionId'];
			$data['branch']=$_SESSION['branch_id'];
			$data['create_date']=$cm->current_dt();
			$data['status']='pending';
			$query=$cm->insert_array("refund",$data);
			$lead->c_l_s($leadId);
			mail("ahmad@toursvision.com,waqas.ahmed@toursvision.com", "Refund Posted", "Refund Posted Against Ticket No: 
				".$_POST['airline_code']."-".$_POST['ticket_no']."");
		}
			if($query==1){$query=1;}
			else{$query= 2;}
			$result=$cm->selectData("refund", "leadId=".$leadId." ORDER BY id DESC");
			echo $query,"~",$lead->refund($result);
		}
}
else if(isset($_GET['type']) && $_GET['type']=="refundPayment")
{
	$total_inv_amount=str_replace("-","","".$_POST['total_inv_amount']."");
	if($total_inv_amount>0)
	{
		$leadId=$_GET['leadId'];
		$data['payment_to']=$_POST['payment_to'];
		$data['refrence']=implode(",", $_POST['refrence']);
		$data['detail']=$_POST['detail'];
		$data['amount']=$total_inv_amount;
		$data['payment_type']=$_POST['payment_type'];
		$data['remark']=$_POST['remark'];
		$data['leadId']=$leadId;
		$data['userId']=$_SESSION['sessionId'];
		$data['create_date']=$cm->current_dt();
		$data['status']='pending';
		$data['branch']=$_SESSION['branch_id'];
		$data['trans_acc_id']=$_POST['bank_id'];
		$data['trans_code']=$administrator->trans_code();
		$query=$cm->insert_array("refund_payment",$data);
		$lastId=$cm->u_value("refund_payment", "id", "leadId=".$leadId." ORDER BY id DESC");
		// Aging Sale invoice
		$countRefNo=count($_POST['refrence']);
		for($i=0; $i<$countRefNo; $i++)
		{
			if(!empty($_POST['refrence'][$i]))
			{
			$cm->insertData_multi("sale_inv_aging", "invoice_number, amount, status, userId, branch_id, ref_id", "'".$_POST['refrence'][$i]."', '".$_POST['amount'][$i]."','pending','".$_SESSION['sessionId']."', '".$_SESSION['branch_id']."',".$lastId."");
			}
		}
		// insert payment details
		if(isset($_POST['payment_type']) && $_POST['payment_type']=='cash')
		{
			
			$bank_det['narration']=$_POST['remark'].'...From:'.$cm->u_value("lead","contact_name","id=".$leadId."");
		}
		elseif(isset($_POST['payment_type']) && $_POST['payment_type']=='online' || $_POST['payment_type']=='cheque' || $_POST['payment_type']=='pay_order' || $_POST['payment_type']=='demand_draft')
		{
			$bank_det['narration']='Bank Branch:'.$_POST['bank_branch']." ,Ref Number: ".$_POST['ref_number'].'.........
		From:'.$cm->u_value("lead","contact_name","id=".$leadId."");
		}
		elseif(isset($_POST['payment_type']) && $_POST['payment_type']=='card')
		{
			$bank_det['narration']='Card Company:'.$_POST['card_type']." ,Company Card: ".$_POST['card_comp'].', Card Number:
			'.$_POST['ref_number'].''.'.........
		From:'.$cm->u_value("lead","contact_name","id=".$leadId."");
		}
		if(isset($_POST['bank_id']) && !empty($_POST['bank_id']))
		{
			$payment_det['trans_acc_id']=$_POST['bank_id'];
			if(isset($_POST['bank_branch']))
			{
				$payment_det['bank_branch']=$_POST['bank_branch'];
			}
		// bank transacton 
		$bank_det['trans_acc_id']=$_POST['bank_id'];
		$bank_det['trans_date']=$cm->today();
		$bank_det['amount']=$total_inv_amount;
		$bank_det['dr_cr']='cr';
		$bank_det['status']='pending';
		$bank_det['branch_id']=$_SESSION['branch_id'];
		$bank_det['userId']=$_SESSION['sessionId'];
		$bank_det['userId']=$_SESSION['sessionId'];
		}
		if(!empty($_POST['ref_number']))
		{
			$payment_det['ref_number']=$_POST['ref_number'];
		}
		if(isset($_POST['card_type'])){
		$payment_det['card_type']=$_POST['card_type'];
		$payment_det['card_comp']=$_POST['card_comp'];
		//$payment_det['ref_number']=$_POST['ref_number'];
		}
		if(isset($_POST['bank_id']) && !empty($_POST['bank_id']))
		{
			$bank_det['trans_code']=$administrator->trans_code();
			$bank_det['vt']='PV';
			$cm->insert_array("trans",$bank_det, "create_date","NOW()");
		}
		$payment_det['ref_id']=$lastId;
		$cm->insert_array("payment_detail", $payment_det);
		if($query==1){$query=1;}
		else{$query= 2;}
	}
	$result=$cm->selectData("refund_payment", "leadId=".$leadId." AND status='approved'");
	echo $query,"~",$lead->refund_payment($result);
}
else if(isset($_GET['type']) && $_GET['type']=="att_doc")
{
	$msg="";
	echo $filePath='documents/'.$_FILES["doc_name"]["name"];
	$alreadExist=$cm->u_value("att_document", "doc_name", "doc_name='$filePath'");
	if(!empty($_FILES["doc_name"]["name"])){
	if(empty($alreadExist))
	{
	move_uploaded_file($_FILES['doc_name']['tmp_name'], $filePath);
	$data=$_POST;
	$data['doc_name']=$filePath;
	$data['leadId']=$_GET['leadId'];
	$data['userId']=$_SESSION['sessionId'];
	$data['create_date']=$cm->current_dt();
	$data['branch_id']=$_SESSION['branch_id'];
	$cm->insert_array("att_document", $data);
	$msg=2;
	}
	else
	{
		echo $msg=1;
	}
	}
	$result=$cm->selectData("att_document", "leadId=".$_GET['leadId']." ORDER BY doc_id DESC");
	echo $lead->att_document($result),"~".$msg;
}
?>