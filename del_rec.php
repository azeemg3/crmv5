<?php
require_once'inc.func.php';
$id=$_GET['del_rec']; 
$db=$cm->db();
if(isset($_GET['type']) && $_GET['type']=="users")
{
	$cm->update("user", "status='inactive'", "id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="country")
{
	$cm->delete("countries", "country_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="del_lead")
{
	$cm->delete("lead", "id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="city")
{
	$cm->delete("cities", "city_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="airlinelist")
{
	$cm->delete("airline_list", "airline_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="airlineSeat")
{
	$cm->delete("airline_seat", "seat_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="travel_class")
{
	$cm->delete("travel_class", "class_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="airline_member")
{
	$cm->delete("airline_membership", "member_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="transacc")
{
	$cm->update("trans_acc","status='inactive'","trans_acc_id=".$id."");
}
elseif(isset($_GET['type']) && $_GET['type']=="address_book")
{
	$cm->delete("address_book", "address_id=".$id."");
	$cm->delete("ab_personal_info", "address_id=".$id."");
	$cm->delete("ab_bus_info", "address_id=".$id."");
	$cm->delete("ab_travel_info", "address_id=".$id."");
	$cm->delete("qp_competetion", "address_id=".$id."");
	$cm->delete("qp_cp_offices_location", "address_id=".$id."");
	$cm->delete("qp_cp_size_loc_certificate_license", "address_id=".$id."");
	$cm->delete("qp_customer_profile", "address_id=".$id."");
	$cm->delete("qp_decision_making_process", "address_id=".$id."");
	$cm->delete("qp_dec_making_proc_department", "address_id=".$id."");
	$cm->delete("qp_needs", "address_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=="att_doc")
{
	unlink("lead-tabs/lead-details/".$cm->u_value("att_document","doc_name", "doc_id=".$id.""));
	$cm->delete("att_document","doc_id=".$id."");
}
elseif(isset($_GET['type']) && $_GET['type']=='reminder')
{
	$cm->delete("reminder", "id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=='e-group')
{
	$cm->delete("e_mark_groups", "group_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=='off_doc')
{
	$cm->delete("office_doc_alerts", "id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=='receipt')
{
	$trans_code=$cm->u_value("payment_reciept", "trans_code", "id=".$id."");
	$data=array();
	$data['details']='Deleted Id='.$id.',Trans Code='.$trans_code.' Payment Receipt';
	$data['file_type']='Payment Receipt';
	$data['deleted_id']=$id;
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$cm->insert_array("deleted_history", $data, "create_date", "NOW()");
	$cm->update("trans", "status='cancel'", "trans_code=".$trans_code."");
	$cm->delete("payment_detail", "id=".$id."");
	$cm->delete("sale_inv_aging", "id=".$id."");
	$cm->delete("payment_reciept", "id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=='rp')
{
	$trans_code=$cm->u_value("refund_payment", "trans_code", "id=".$id."");
	$data=array();
	$data['details']='Deleted Id='.$id.',Trans Code='.$trans_code.' Refund Payment';
	$data['file_type']='Refund Payment';
	$data['deleted_id']=$id;
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['branch_id'];
	$cm->insert_array("deleted_history", $data, "create_date", "NOW()");
	$cm->update("trans", "status='cancel'", "trans_code=".$trans_code."");
	$cm->delete("refund_payment", "id=".$id."");
	$cm->delete("sale_inv_aging", "ref_id=".$id."");
	$cm->delete("payment_detail", "ref_id=".$id."");
	exit;
}
elseif(isset($_GET['type']) && $_GET['type']=='latest_pkg')
{
	$cm->delete("lates_packages", "id=".$id."");
	exit();
}
elseif(isset($_GET['type']) && $_GET['type']=='web-video')
{
	$cm->delete("web_videos", "id=".$id."");
	exit();
}
elseif(isset($_GET['type']) && $_GET['type']=='tour-sale')
{
	$cm->delete("tour_sale_invoice", "uniqueId='".$id."'");
	$cm->delete("trans","trans_code=".$cm->u_value("tour_visa","trans_code", "uniqueId='".$id."'")."");
	$cm->delete("tour_visa", "uniqueId='".$id."'");
	$cm->delete("trans","trans_code=".$cm->u_value("tour_hotel","trans_code", "uniqueId='".$id."'")."");
	$cm->delete("tour_hotel", "uniqueId='".$id."'");
	$cm->delete("trans","trans_code=".$cm->u_value("tour_other","trans_code", "uniqueId='".$id."'")."");
	$cm->delete("tour_other", "uniqueId='".$id."'");
	$cm->delete("trans","trans_code=".$cm->u_value("tour_pkg","trans_code", "uniqueId='".$id."'")."");
	$cm->delete("tour_pkg", "uniqueId='".$id."'");
	$cm->delete("trans","trans_code=".$cm->u_value("tour_tour","trans_code", "uniqueId='".$id."'")."");
	$cm->delete("tour_tour", "uniqueId='".$id."'");
	exit();
}
else if(isset($_GET['type']) && $_GET['type']=='ticket-sale')
{
	$str=$id;
	$str=strstr($str, '-');
	$id=ltrim($str,"-");
	$q="DELETE add_sale,trans FROM `add_sale` INNER JOIN trans ON add_sale.trans_code=trans.trans_code WHERE add_sale.id=".$id."";
	$db->query($q);
	exit();
}
elseif(isset($_GET['type']) && $_GET['type']=='smsScheduleList')
{
	$cm->delete("sms_schedule", "id=".$id."");
	exit();
}
elseif(isset($_GET['type']) && $_GET['type']=='web_slider')
{
	$sId=crm::u_value("web_sliders", "slider_images", "id=".$id."");
	$path=dirname(__FILE__).'/cms/'.$sId;
	unlink($path);
	$cm->delete("web_sliders", "id=".$id."");
	exit();
}
elseif(isset($_GET['type']) && $_GET['type']=='umrah-pkg')
{
	$cm->delete("web_umrah_pkg", "pkg_id=".$id."");
	exit();
}
elseif(isset($_GET['type']) && $_GET['type']=='pak_tour-pkg'){
	$thumb_img=crm::u_value("pak_tour_pkgs", "thumb_img", "id=".$id."");
	$path=dirname(__FILE__).'/cms/thumb_img/'.$thumb_img;
	$gimg=$thumb_img=crm::u_value("pak_tour_pkgs", "pkg_images", "id=".$id."");
	$gimg=explode("}", $gimg);
	foreach($gimg as $img){
		unlink(dirname(__FILE__).'/cms/pak-tour-pkg-images/'.$img);
	}
	unlink($path);
	$cm->delete("pak_tour_pkgs", "id=".$id."");
	
}
elseif(isset($_GET['type']) && $_GET['type']=='pk_tour_dest')
{
	$cm->delete("pak_tour_dest", "id=".$id."");
	exit();
}
?>