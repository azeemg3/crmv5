<style>
table, tr, th, td{ text-align:center;}
</style>
<?php
require_once'../../inc.func.php';
$tourSale=new tourSale();
if(isset($_GET['uniqueId']))
{
	$uniqueId=$_GET['uniqueId'];
	echo $tourSale->acc_tour_inv_det($uniqueId);
}
?>