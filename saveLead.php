<?php
session_start();
// ob_start();
// ob_clean();
require_once'inc.func.php';
$c_m=new crm();
$lead=new lead();
$id="";
$branch=$c_m->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."");
if(isset($_POST['id']) && !empty($_POST['id']))
{
	$id=$_POST['id'];
}
$contact_name=$_POST['contact_name'];
if(isset($_POST['take']) && !empty($_POST['take']))
{
	$status='new';
	$spo=$_SESSION['sessionId'];
	$takeover_date=$c_m->current_dt();
}
else
{
	if(!empty($_POST['spo']))
	{
		$spo=$_POST['spo'];
	}
	else
	{
		$spo='';
	}
	$status="pending";
	$takeover_date="";
}
$columns=array("`mobile`, `sec_mobile`, `contact_name`, `email`, `sector`, `services`, `travel_datefrm`, `travel_dateto`, `comment`, `status`, created_by, create_date, userId, branch_id, takeover_date, spo, `sec_email`, `country_id`, `city_id`, `cr_limit`, `birth_date`");
 $values=array($_POST['mobile'],$_POST['sec_mobile'],$_POST['contact_name'], $_POST['email'], $_POST['sector'], $_POST['services'] ,$_POST['travel_datefrm'], $_POST['travel_dateto'], $_POST['comment'],$status, $_SESSION['sessionId'], $c_m->current_dt(), 
 $_SESSION['sessionId'],$_POST['branch_id'], $takeover_date,$spo, $_POST['sec_email'], $_POST['country_id'], $_POST['city_id'], 
 $_POST['cr_limit'],$_POST['birth_date']);
 if(isset($_POST['take']) && !empty($_POST['take']))
{
	if($id=="" || $id==0)
	{
	$message="Thanks You ".strtoupper($_POST['contact_name']).",\n".strtoupper($branch)." thankfull and appreciates your support and trust on us.\nYou can be confident that we are committed to your satisfaction. For further details & query please do'nt hesitate to call +92 42-111-381-888 or visit ".$c_m->u_value("branches", "web", "branch_id=".$_SESSION['branch_id']."")."";
	$lead->saveLead($columns, $values, $contact_name, $_POST['mobile'], $message, $_POST['email']);
	// address boook data while lead creatin if not exist
	$cm->insertData_multi("address_book","other_det,userId,cur_date,branch_id","'".$_POST['pros_tech']."',
	'".$_SESSION['sessionId']."',NOW(), '".$_SESSION['branch_id']."'");
	$cm->insertData_multi("address_book","pros_tech,userId,cur_date,branch_id","'".$_POST['pros_tech']."',
	'".$_SESSION['sessionId']."',NOW(), '".$_SESSION['branch_id']."'");
	$address_id=$cm->u_value("address_book","address_id","1 ORDER BY address_id DESC LIMIT 1");
	$thisData=array();
	$thisData['cnic_number']=$_POST['cnic_number'];
	$thisData['name']=$_POST['contact_name'];
	$thisData['mobile']=$_POST['mobile'];
	$thisData['email']=$_POST['email'];
	$thisData['country']=$_POST['country_id'];
	$thisData['city']=$_POST['city_id'];
	$thisData['userId']=$_SESSION['sessionId'];
	$thisData['address_id']=$address_id;
	$thisData['birth_date']=$_POST['birth_date'];
	$cm->insert_array("ab_personal_info",$thisData, "cur_date","NOW()");
	header("location:myLeads");
	exit;
	}
	  
}
else if(isset($_POST['for_other']) && !empty($_POST['for_other']))
{
	$message="Thanks You ".strtoupper($_POST['contact_name']).",\n".strtoupper($branch)." warmly thankfull and appreciates your support and trust on us.\nYou can be confident that we are committed to your satisfaction. For further details & query please do'nt hesitate to call +92 42-111-381-888 or visit www.toursvision.com";
	$lead->saveLead($columns, $values, $contact_name, $_POST['mobile'], $message, $_POST['email']);
	$cm->insertData_multi("address_book","pros_tech,userId,cur_date,branch_id","'".$_POST['pros_tech']."',
	'".$_SESSION['sessionId']."',NOW(), '".$_SESSION['branch_id']."'");
	$address_id=$cm->u_value("address_book","address_id","1 ORDER BY address_id DESC LIMIT 1");
	$thisData=array();
	$thisData['cnic_number']=$_POST['cnic_number'];
	$thisData['name']=$_POST['contact_name'];
	$thisData['mobile']=$_POST['mobile'];
	$thisData['email']=$_POST['email'];
	$thisData['country']=$_POST['country_id'];
	$thisData['city']=$_POST['city_id'];
	$thisData['userId']=$_SESSION['sessionId'];
	$thisData['address_id']=$address_id;
	$thisData['birth_date']=$_POST['birth_date'];
	$cm->insert_array("ab_personal_info",$thisData, "cur_date","NOW()");
	  header("location:availLeads");
}
else
	{
		$data=array("mobile"=>$_POST['mobile'], "sec_mobile"=>$_POST['sec_mobile'], "contact_name"=>$_POST['contact_name'], "email"=>$_POST['email'], 
		"services"=>$_POST['services'], "sector"=>$_POST['sector'] ,"travel_datefrm"=>$_POST['travel_datefrm'],
		"`travel_dateto`"=>$_POST['travel_dateto'],  "`comment`"=>$_POST['comment'], "create_date"=>$c_m->current_dt(), 
		"country_id"=>$_POST['country_id'], "city_id"=>$_POST['city_id'], "sec_email"=>$_POST['sec_email'], "birth_date"=>$_POST['birth_date']);
		foreach($data as $columns=>$values)
		{
			$query.=$columns."='".$values."',";
		}
		$query=rtrim($query, ",");
		$c_m->update("lead", $query, "id=".$id."");
		header("location:allLeads?status=update&leadId=".$id."");
		exit;
	}
?>