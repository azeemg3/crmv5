<?php
ini_set('max_execution_time', 0);
set_time_limit(0);
require_once'../inc.func.php';
session_start();
$db=$cm->db();
$values="";
if(isset($_FILES['file_name']['name']) && !empty($_FILES['file_name']['name']))
{
	$group_id=$_POST['group_id'];
	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	include 'Classes/PHPExcel/IOFactory.php';
	
	$file_name=$_FILES['file_name']['name'];
	move_uploaded_file($_FILES["file_name"]["tmp_name"],'exc_imp_files/'.$file_name);
	try {
	$objPHPExcel = PHPExcel_IOFactory::load('exc_imp_files/'.$file_name);
	} 
	catch(Exception $e) {
	die('Error loading file "'.pathinfo('exc_imp_files/'.$file_name,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$arrayCount = count($allDataInSheet);
	for($i=2;$i<=$arrayCount;$i++)
	{
		$name= trim($allDataInSheet[$i]["A"]);
		$phone=trim($allDataInSheet[$i]["B"]);
		$mobile=trim($allDataInSheet[$i]["C"]);
		$mobile=preg_replace('/[^A-Za-z0-9\-]/', '',$mobile);
		$mobile=ltrim($mobile, "092");
		if($mobile!=""){
		$mobile='92'.$mobile;
		}
		else
		{
			$mobile="";
		}
		$email=trim($allDataInSheet[$i]["D"]);
		$city=trim($allDataInSheet[$i]["E"]);
		if(!empty($mobile) || !empty($email))
		{
			$address_id=$cm->u_value("ab_personal_info", "address_id", "mobile='$mobile'");
			if(!empty($address_id))
			{
				$marketing->update("adress_book", "email='$email', first_name='$name', mobile='$mobile'", "address_id=".$address_id."");	
			}
			else
			{
				$cm->insertData_multi("address_book","group_id, userId, branch_id, cur_date", "'".$group_id."', 
				'".$_SESSION['sessionId']."', '".$_SESSION['branch_id']."', NOW()");
				$last_id = $cm->u_value("address_book","address_id","1 ORDER BY address_id DESC");
				//$colmuns=array("name,phone,  mobile, email, userId, area, address_id");
				$values.="('$name', '$phone', '$mobile', '$email','".$_SESSION['sessionId']."', '$city', '$last_id'),";
				//$marketing->insertData("ab_personal_info", $colmuns, $values);
			}
		}
	}//for end loop
	$values=rtrim($values, ",");
	$sql="INSERT INTO ab_personal_info (name,phone,  mobile, email, userId, area, address_id) VALUE $values";
	$db->query($sql);
	unlink("exc_imp_files/".$file_name);
	header("location:import_contacts?msg=2");
}
else
{
	header("location:import_contacts?msg=1");
}
?>