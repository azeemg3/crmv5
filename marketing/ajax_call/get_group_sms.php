<?php
require_once'../../inc.func.php';
if(isset($_GET['gId']) && !empty($_GET['gId']))
{
	$gId=$_GET['gId'];
	$result=$cm->selectMultiData("count(ab_personal_info.mobile) AS tmobile", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "address_book.group_id=".$gId."");
		$row=$result->fetch_assoc();
		echo $row['tmobile'];
}
?>