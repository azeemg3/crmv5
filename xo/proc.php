<?php
require_once'../common/acc_top.php';
require_once'nav.php';
require_once'../inc.functions.php';
require_once'../session.php';
$c_m=new crm();

if(isset($_POST['app']) && $_POST['app']=="approved")
{
	$xoId=$_POST['xoId'];
	$password=$c_m->u_value("user","password", "id=".$userSessionId." AND status='active'");
	if($password==md5($_POST['password'])){
	$c_m->update("xo_sale", "status='approved'", "id=".$xoId."");
	echo '
	<div class="clearfix"></div><br><br>
		<div class="alert alert-success col-lg-6 col-xs-offset-3">
   			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			<strong>Success!</strong> Xo No ('.$xoId.') Has been Approved 
				<a href="view_xo.php?xoId='.$xoId.'" target="_blank">View Xo</a>
  		</div>';
	}
	else 
	echo '<div class="col-lg-6 col-md-6 col-sm-4 col-xs-offset-4 login-erro">
 				<p> <span>Error:</span> You Entered  Wrong Password OR You are not Authorize 
				<a onclick="history.go(-1)">Go Back</a></p>   	
			</div>';
	
}
if(isset($_POST['void']) && $_POST['void']=="cancel")
{
	$xoId=$_POST['xoId'];
	$password=$c_m->u_value("user","password", "id=".$userSessionId." AND status='active'");
	if($password==md5($_POST['password'])){
	$c_m->update("xo_sale", "status='cancel'", "id=".$xoId."");
	echo '
	<div class="clearfix"></div><br><br>
		<div class="alert alert-success col-lg-6 col-xs-offset-3">
   			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			<strong>Success!</strong> Xo No ('.$xoId.') Has been Cancel 
				<a onclick="history.go(-2)">Go Back</a>
  		</div>';
	}
	else 
	echo '<div class="col-lg-6 col-md-6 col-sm-4 col-xs-offset-4 login-erro">
 				<p> <span>Error:</span> You Entered  Wrong Password OR You are not Authorize 
				<a onclick="history.go(-1)">Go Back</a></p>   	
			</div>';
}
require_once'../common/acc_footer.php';
?>