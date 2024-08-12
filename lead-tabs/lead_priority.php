<?php
require_once'../inc.func.php';
if(isset($_GET['lp']) && !empty($_GET['lp']))
{
	$leadId=$_GET['leadId'];
	$cm->update("lead","lp='".$_GET['lp']."'", "id=".$leadId."");
}
?>