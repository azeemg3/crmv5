<?php
require_once'../../inc.func.php';
session_start();
$tab=$_GET['tab'];
$data=array();
$data=$_POST;
$data['userId']=$_SESSION['sessionId'];
$db=$cm->db();
if($tab=='pros_tech')
{
	$data['branch_id']=$_SESSION['branch_id'];
	$query=$cm->insert_array("address_book", $data, "cur_date", "NOW()");
	$address_id=$cm->u_value("address_book", "address_id", "1 ORDER BY address_id DESC LIMIT 1");
	echo "address_id",",".$address_id;
}
elseif($tab=='personal_info')
{
	$data['address_id']=$_GET['address_id'];
	$query=$cm->insert_array("ab_personal_info", $data, "cur_date", "NOW()");
		echo $query,",Query Submitted Successfull";
}
elseif($tab=='bus_info')
{
	$data['address_id']=$_GET['address_id'];
	$query=$cm->insert_array("ab_bus_info",$data, "cur_date", "NOW()");
	echo $query,",Query Submitted Successfull";
}
elseif($tab=='travel_info')
{
	$data['address_id']=$_GET['address_id'];
	$pref_airline=implode(",",$_POST['pref_airline']);
	$data['pref_airline']=$pref_airline;
	$pref_class_travel=implode(",", $_POST['pref_class']);
	$data['pref_class']=$pref_class_travel;
	$pref_seat=implode(',', $_POST['pref_seat']);
	$data['pref_seat']=$pref_seat;
	$airline_membership=implode(',', $_POST['airline_membership']);
	$data['airline_membership']=$airline_membership;
	$query=$cm->insert_array("ab_travel_info", $data, "cur_date", "NOW()");
	echo $query,",Query Submitted Successfull";
}
elseif($tab=='qp-cp')
{
	$thisData=array();
	if(isset($_POST['ind_selected']))
	{
		$ind_selected=implode(",", $_POST['ind_selected']);
		$thisData['ind_selected']=$ind_selected;
	}
	if(isset($_POST['cp_size_loc_dep']))
	{
		$cp_size_loc_dep=implode(",", $_POST['cp_size_loc_dep']);
		$thisData['cp_size_loc_dep']=$cp_size_loc_dep;
	}
	$count_ofc_location=count($_POST['location']);
	$count_certification=count($_POST['certificaton']);
	for($i=0; $i<$count_ofc_location; $i++)
	{
		$cm->insertData_multi("qp_cp_offices_location", "location, wherehouse, manufacturing_unit, display_center, other_details,
		cur_date, userId, address_id", "'".$_POST['location'][$i]."', '".$_POST['wherehouse'][$i]."', 
		'".$_POST['manufacturing_unit'][$i]."', '".$_POST['display_center'][$i]."', '".$_POST['other_details'][$i]."', NOW(), ".$_SESSION['sessionId'].", ".$_GET['address_id']."");
	
	}
	// certification process
	for($j=0; $j<$count_certification; $j++)
	{
		$cm->insertData_multi("qp_cp_size_loc_certificate_license", "certificaton, license,other_det, cur_date, userId, address_id", "'".$_POST['certificaton'][$j]."', '".$_POST['license'][$j]."', '".$_POST['other_det'][$j]."', NOW(), 
		".$_SESSION['sessionId'].", ".$_GET['address_id']."");
	}
	$thisData['address_id']=$_GET['address_id'];
	$thisData['ind_base_on']=$_POST['ind_base_on'];
	$thisData['no_supplier']=$_POST['no_supplier'];
	$thisData['internal_employee']=$_POST['internal_employee'];
	$thisData['external_employee']=$_POST['external_employee'];
	$thisData['ind_other_details']=$_POST['ind_other_details'];
	$thisData['brand_val']=$_POST['brand_val'];
	$thisData['assets_val']=$_POST['assets_val'];
	$thisData['comp_finacial_wealth']=$_POST['comp_finacial_wealth'];
	$thisData['annual_turnover']=$_POST['annual_turnover'];
	$thisData['b2b_clients']=$_POST['b2b'];
	$thisData['b2c_clients']=$_POST['b2c'];
	$thisData['total_clients']=$_POST['total_clients'];
	$thisData['userId']=$_SESSION['sessionId'];
	$query=$cm->insert_array("qp_customer_profile", $thisData, "cur_date", "NOW()");
	echo $query,",Query Submitted Successfull";

}
elseif($tab=='qp-needs')
{
	echo $data['address_id']=$_GET['address_id'];
	$prospect_need=implode(",",$_POST['prospect_need']);
	$data['prospect_need']=$prospect_need;
	$query=$cm->insert_array("qp_needs", $data, "cur_date","NOW()");
	echo $query,",Query Submitted Successfull";
}
elseif($tab=='qp-decesion_mak')
{
	$thisData=array();
	$thisData['address_id']=$_GET['address_id'];
	$thisData['userId']=$_SESSION['sessionId'];
	$thisData['no_dep']=$_POST['no_dep'];
	$thisData['authorization']=$_POST['authorization'];
	$thisData['other_det']=$_POST['other_det'];
	$query=$cm->insert_array("qp_decision_making_process", $thisData, "cur_date", "NOW()");
	$count_dep=count($_POST['dep_name']);
	for($i=0; $i<$count_dep; $i++)
	{
		$cm->insertData_multi("qp_dec_making_proc_department", "total_person, dep_name,person_name, desigination,role,cur_date, address_id",
		"'".$_POST['total_person'][$i]."', '".$_POST['dep_name'][$i]."', '".$_POST['person_name'][$i]."', 
		'".$_POST['desigination'][$i]."', '".$_POST['role'][$i]."', NOW(),'".$_GET['address_id']."'");
	}
	echo $query,",Query Submitted Successfull";
}
elseif($tab=='qp_competetion')
{
	$data['address_id']=$_GET['address_id'];
	$query=$cm->insert_array("qp_competetion", $data, "cur_date", "NOW()");
	echo $query,",Query Submitted Successfull";
}
?>