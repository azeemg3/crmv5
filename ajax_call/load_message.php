<?php
require_once'../inc.func.php';
session_start();
echo '
		<!-- inner menu: contains the actual data -->
		<ul class="menu">
		  '.$lead->desk_lead_msg($_SESSION['sessionId']).'
		</ul>
';
?>