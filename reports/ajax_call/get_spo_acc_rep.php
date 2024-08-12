<?php
require_once'../../inc.func.php';
$sWhere="";
$whereArray=array();
if(isset($_POST) && !empty($_POST['branch']) && !empty($_POST['spo']))
{
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	/*$df=$_POST['df'];
	$dt=$_POST['dt'];*/
	if(!empty($branch) && !empty($spo)) $whereArray[]='lead.spo='.$spo.'';
	$sWhere=implode("AND", $whereArray);
}
$query=$cm->selectMultiData("lead.id AS leadId, lead.contact_name, user.name AS userName", 
	"lead INNER JOIN user ON lead.spo=user.id", "{$sWhere}");
	while($row=$query->fetch_assoc())
	{
		$ob=$lead->lead_ob($cm->today(),"", $row['leadId']);
		$arrayOfArray['all_data']=array("leadId"=>$row['leadId'], "client_name"=>$row['contact_name'],"spo"=>$row['userName'], 
		"ob"=>$ob
		);
		$array[]=$arrayOfArray;
	}
	echo json_encode($array);
?>