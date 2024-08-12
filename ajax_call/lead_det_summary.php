<?php
require_once'../inc.func.php';
if(isset($_GET['leadId']) && !empty($_GET['leadId']))
{
	$leadId=$_GET['leadId'];
	$allData=array();
	$result=$cm->selectData("lead", "id=".$leadId."");
	while($row=$result->fetch_assoc())
	{
		$allData['created_by']=$cm->u_value("user","name","id=".$row['created_by']."");
		$allData['taken_overby']=$cm->u_value("user","name","id=".$row['spo']."");
		$allData['leadData']=$row;
		echo json_encode($allData);
	}
	
}
?>