<?php
require_once('../inc.func.php');
function total_lead($status){
	$total_lead=crm::count_val("lead", "id", "{$status}");
	return($total_lead);
}
?>