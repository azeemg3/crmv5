<?php
require_once'../inc.func.php';
session_start();
$tourSale=new tourSale();
if(isset($_GET['tour']) && !empty($_GET['tour']))
{
	$tour=$_GET['tour'];
	$uniqueId=$_GET['uniqueId'];
}
?>
<title>Print Tour Invoice</title>
<script type="text/javascript">
	function print_inv() {
     var printContents = document.getElementById("container").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
<style media="all">
body{ font-family:Verdana, Geneva, sans-serif}
@page 
{
    size: auto;   /* auto is the initial value */
    margin: 5mm;  /* this affects the margin in the printer settings */
}
.container
{
	margin:auto;
	width:1000px;
}
.print_data{ width:100% !important;}
.logo{ width:20%; float:left;}
.main-head{ float:left; text-align:center; width:80%;}
.clearfix{ clear:both;}
.print-btn{ padding:10px; border-radius:4px; border:1px; float:right;}
</style>
<div class="container" id="container">
	<div class="logo">
    	<?php $logo=$tourSale->u_value("branches", "branch_logo", "branch_id=".$_SESSION['branch_id'].""); ?>
    	<img src="../branch_logo/<?php echo $logo ?>" />
    </div>
    <div class="main-head">
    	<h2><?php echo $tourSale->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id'].""); ?></h2>
        <p><?php echo $tourSale->u_value("branches", "address", "branch_id=".$_SESSION['branch_id'].""); ?></p>
    </div>
    <hr />
    	<?php
		if($tour=='det'){ 
		echo $tourSale->tour_det_inv($uniqueId);
		}
		else if($tour=='summ') {echo $tourSale->tour_summery_inv($uniqueId); }
		 ?>
    <div class="clearfix"></div>
    <br />
</div>
<div class="container">
<input type="button" value="Print" onclick="print_inv()" class="print-btn" />
</div>
