<?php
session_start();
require_once'../inc.func.php';
$data=$_POST;
$uniqueId=$_GET['uniqueId'];
$branch=$_GET['branch'];
$spo=$_GET['spo'];
$leadId=$_GET['leadId'];
//$cm->insert_array("tour_visa", $data, "", "");
$file=$_GET['tour'];
$id="";
if($file=='tourVisa')
{
	$ltu=$cm->ltu($leadId);// taken over lead user
	if(!empty($_POST['visaPassName']) && !empty($_POST['visaQty']))
	{
		// Add Transaction record 
		$dataArray['amount']=$_POST['t_visaPp'];
		$dataArray['narration']=$_POST['visaPassName']." ---  ".$_POST['visaType']." --- ".$_POST['visa_passportNo'];
		$dataArray['dr_cr']='cr';
		$dataArray['trans_date']=$cm->today();
		$dataArray['trans_acc_id']=$_POST['vendor'];
		$dataArray['userId']=$_SESSION['sessionId'];
		$dataArray['branch_id']=$_SESSION['branch_id'];
		$dataArray['vt']='DN';
		if(!empty($_POST['id'])){$id=$_POST['id'];}
		if($id==0 || $id=="")
		{
		$data['trans_code']=$administrator->trans_code();
		$cm->insert_array("tour_visa", $data, "uniqueId, branch, spo, userId, date, time, leadId", "'".$uniqueId."', ".$branch.", 
		".$spo.",".$ltu.", NOW(), NOW(), ".$leadId."");
		$dataArray['status']='pending';
		$dataArray['trans_code']=$administrator->trans_code();
		$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
		echo "Query Submitted Successfull";
		}
		else
		{
			$cm->update_array("tour_visa", $data, "id=".$id."");
			// updated transacton according to the sale udpattion
			$trans_code=$cm->u_value("tour_visa","trans_code","id=".$id."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
			echo "Query Updated Successfully";
			
		}
	}
	else 
	{
		echo "Something Wrong While your entering Data";
	}
	
}
else if($file=='tourHotel')
{
	$values=$_POST;
	if(!empty($_POST['hotelPassName']) && !empty($_POST['hotelQty']))
	{
		// Add Transaction record 
		$dataArray['amount']=$_POST['t_hotelPp'];
		$dataArray['narration']=$_POST['hotelPassName']." ".$_POST['hotelName']." ,".$_POST['hotel_desc'];
		$dataArray['dr_cr']='cr';
		$dataArray['trans_date']=$cm->today();
		$dataArray['trans_acc_id']=$_POST['vendor'];
		$dataArray['userId']=$_SESSION['sessionId'];
		$dataArray['branch_id']=$_SESSION['branch_id'];
		$dataArray['vt']='DN';
		if(!empty($_POST['id'])){$id=$_POST['id'];}
		if($id==0 || $id=="")
		{
		$values['trans_code']=$administrator->trans_code();
		$cm->insert_array("tour_hotel", $values, "uniqueId, userId, date, spo, leadId, branch", "'".$uniqueId."', 
		".$_SESSION['sessionId'].", NOW(), ".$spo.", ".$leadId.", ".$branch."");
		$dataArray['status']='pending';
		$dataArray['trans_code']=$administrator->trans_code();
		$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
		echo "Query Submited Successfully";
		}
		else
		{
			$cm->update_array("tour_hotel", $values, "id=".$id."");
			// updated transacton according to the sale udpattion
			$trans_code=$cm->u_value("tour_hotel","trans_code","id=".$id."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
			echo "Query Updated Successfully";
		}
	}
	else
	{
		echo "Something Wrong While your entering Data";
	}
	
}
else if($file=='tourTrans')
{
	$values=$_POST;
	if(!empty($_POST['transPassName']) && !empty($_POST['transQty']))
	{
		// Add Transaction record 
		$dataArray['amount']=$_POST['t_transPp'];
		$dataArray['narration']=$_POST['transPassName']." ".$_POST['transSector']." ,".$_POST['trans_desc'];
		$dataArray['dr_cr']='cr';
		$dataArray['trans_date']=$cm->today();
		$dataArray['trans_acc_id']=$_POST['vendor'];
		$dataArray['userId']=$_SESSION['sessionId'];
		$dataArray['branch_id']=$_SESSION['branch_id'];
		$dataArray['vt']='DN';
	if(!empty($_POST['id'])){$id=$_POST['id'];}
		if($id==0 || $id=="")
		{
			$values['trans_code']=$administrator->trans_code();
			$cm->insert_array("tour_transport", $values, "uniqueId, userId, branch, leadId, date", "'".$uniqueId."', ".$_SESSION['sessionId'].", 
			".$branch.", ".$leadId.", NOW()");
			$dataArray['status']='pending';
			$dataArray['trans_code']=$administrator->trans_code();
			$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
			echo "Query Submited Successfully";
		}
		else
		{
			$cm->update_array("tour_transport", $values, "id=".$id."");
			// updated transacton according to the sale udpattion
			$trans_code=$cm->u_value("tour_transport","trans_code","id=".$id."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
			echo "Query Updated Successfully";
			
		}
	}
	else
	{
		echo "Something Wrong While your entering Data";
	}
}
else if($file=="tourTour")
{
	$values=$_POST;
	if(!empty($_POST['tourPassName']) && !empty($_POST['tourQty']))
	{
		// Add Transaction record 
		$dataArray['amount']=$_POST['t_tourPp'];
		$dataArray['narration']=$_POST['tourPassName']." ".$_POST['tourName']." ,".$_POST['tour_desc'];
		$dataArray['dr_cr']='cr';
		$dataArray['trans_date']=$cm->today();
		$dataArray['trans_acc_id']=$_POST['vendor'];
		$dataArray['userId']=$_SESSION['sessionId'];
		$dataArray['branch_id']=$_SESSION['branch_id'];
		$dataArray['vt']='DN';
		if(!empty($_POST['id'])){$id=$_POST['id'];}
		if($id==0 || $id=="")
		{
			$values['trans_code']=$administrator->trans_code();
	$cm->insert_array("tour_tour", $values, "uniqueId, userId, branch, leadId, date", "'".$uniqueId."', ".$_SESSION['sessionId'].", 
	".$branch.", ".$leadId.", NOW() ");
	$dataArray['status']='pending';
	$dataArray['trans_code']=$administrator->trans_code();
	$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
	echo "Query Submited Successfully";
		}
		else
		{
			$cm->update_array("tour_tour", $values, "id=".$id."");
			// updated transacton according to the sale udpattion
			$trans_code=$cm->u_value("tour_tour","trans_code","id=".$id."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
			echo "Query Updated Successfully";
		}
	}
	else
	{
		echo "Something Wrong While your entering Data";
	}
}
else if($file=="tourOther")
{
	$values=$_POST;
	if(!empty($_POST['otherPassName']) && !empty($_POST['serQty']))
	{
		// Add Transaction record 
		$dataArray['amount']=$_POST['t_serPp'];
		$dataArray['narration']=$_POST['otherPassName']." ".$_POST['serviceName']." ,".$_POST['other_desc'];
		$dataArray['dr_cr']='cr';
		$dataArray['trans_date']=$cm->today();
		$dataArray['trans_acc_id']=$_POST['vendor'];
		$dataArray['userId']=$_SESSION['sessionId'];
		$dataArray['branch_id']=$_SESSION['branch_id'];
		$dataArray['vt']='DN';
		if(!empty($_POST['id'])){$id=$_POST['id'];}
		if($id==0 || $id==""){
			$values['trans_code']=$administrator->trans_code();
		$cm->insert_array("tour_other", $values, "uniqueId, userId, branch, leadId", "'".$uniqueId."', ".$_SESSION['sessionId'].", 
		".$branch.", ".$leadId."");
		$dataArray['status']='pending';
		$dataArray['trans_code']=$administrator->trans_code();
		$cm->insert_array("trans",$dataArray, "create_date", "NOW()");
		echo "Query Submited Successfully";
		}
		else
		{
			$cm->update_array("tour_other", $values, "id=".$id."");
			// updated transacton according to the sale udpattion
			$trans_code=$cm->u_value("tour_other","trans_code","id=".$id."");
			$cm->update_array("trans",$dataArray, "trans_code='".$trans_code."'");
			echo "Query Updated Successfully";
		}
	}
	else
	{
		echo "Something Wrong While your entering Data";
	}
}

?>