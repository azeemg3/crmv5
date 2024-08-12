<?php
require_once'../../../inc.func.php';
session_start();
$data="";
if(isset($_POST) && $_POST['type']=='group_sms' && !empty($_POST['gId']))
{
	$mobiles="";
	$gId=$_POST['gId'];
	$message=$_POST['message'];
	$result=$cm->selectMultiData("ab_personal_info.mobile,address_book.branch_id", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "address_book.group_id=".$gId." AND address_book.branch_id=".$_SESSION['branch_id']."");
	while($row=$result->fetch_assoc())
	{
		$mobiles.=$row['mobile'].",";
	}
	$mr=$cm->message_api($mobiles, $message);
	
}
else
{
	$data=array("code"=>"201", "message"=>"Something Wrong with your request please try Again!");
}
echo json_encode($data);
?>