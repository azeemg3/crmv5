<?php
require_once'../../inc.func.php';
if(isset($_POST) && !empty($_FILES['file']['name']))
{
	$img=$_FILES['file']['name'];
	$file_tmp =$_FILES['file']['tmp_name'];
	move_uploaded_file($file_tmp,"../emails_images/".$img);
	echo $img;
}
?>