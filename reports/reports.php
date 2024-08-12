<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Payment & Refunds';
</script>
<div class="content-wrapper">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">View Reports</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
  			<h3>Lead Reports:</h3>
            <ul class="list-group">
                <li class="list-group-item">
                <a href="lead_reports">Open Lead Reports <span class="glyphicon glyphicon-folder-open"></span></a>
                </li>
                <li class="list-group-item">
                <a href="spo_lead_reports">Spo Lead Reports <span class="glyphicon glyphicon-folder-open"></span></a>
                </li>
            </ul>
            <h3>Account Reports:</h3>
            <ul class="list-group">
                <li class="list-group-item">
                <a href="spo_acc_reports">Spo Account Reports <span class="glyphicon glyphicon-folder-open"></span></a></li>
                <li class="list-group-item">
                <a href="payViewCB">Cash Book Reports <span class="glyphicon glyphicon-folder-open"></span></a></li>
                <li class="list-group-item">
                <a href="payViewPB">Petty Cash Book Reports <span class="glyphicon glyphicon-folder-open"></span></a></li>
            </ul>
             <h3>E Marketing Reports:</h3>
            <ul class="list-group">
                <li class="list-group-item">
                <a href="cash_book">Email Sent Reports <span class="glyphicon glyphicon-folder-open"></span></a></li>
                <li class="list-group-item"><a href="">Sms Sent Reports <span class="glyphicon glyphicon-folder-open"></span></a></li>
            </ul>
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
 <?php 
$cm->get_footer("../");
?>
