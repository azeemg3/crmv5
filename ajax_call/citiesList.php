<?php
require_once'../inc.func.php';
if(isset($_GET['country_id']) && !empty($_GET['country_id']))
{
	echo $cm->cities($_GET['country_id']);
}
?>