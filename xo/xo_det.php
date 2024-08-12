<?php
require_once'../common/acc_top.php';
require_once'nav.php';
require_once'../inc.functions.php';
require_once'../session.php';
$c_m=new crm();
if(isset($_GET['xoId']))
{
	$xoId=$_GET['xoId'];
	$query=$c_m->selectMultiData("xo_sale.*, branches.branch_name", "xo_sale INNER JOIN branches ON 
	xo_sale.branch=branches.branch_id", "branch_id=".$user_branch."");
	$row=mysql_fetch_array($query);
	
}
?>
<script>
document.title="Xo Details";
</script>
<div class="clearfix"></div>
<div class="container">
<h2><span class="main-heading">Xo Details</span></h2>
<div class="panel panel-default col-lg-6">
  <div class="panel-body">
  	<div class="form-inline">
    <form action="proc" method="post">
    <input type="hidden" name="app" value="approved" />
    <input type="hidden" name="xoId" value="<?php echo $xoId ?>" />
    	<label>Enter Password: </label>
        <input type="password" name="password" class="form-control" />
        <input type="submit" class="btn btn-info" value="Authorize Paymetn" />
    </form>
    </div>
  	<!-- form-inline-->
    <hr />
    <table class="table table-condensed"  width="100%">
        	<tr>
            	<td>Date:</td><td><?php echo $row['date_issue'] ?></td>
            </tr>
            <tr>
            	<td>Branch:</td><td><?php echo $row['branch_name'] ?></td>
            </tr>
            <tr>
            	<td>Supplier Name:</td><td><?php echo $row['suppl_name'] ?></td>
            </tr>
            <tr>
            	<td>Total Amount:</td><td><?php echo $row['total'] ?></td>
            </tr>
            <tr>
            	<td>Net Payable:</td><td><?php echo $row['net_payable'] ?></td>
            </tr>
            <tr>
            	<td>Action By:</td><td>Not Authorize</td>
            </tr>
    </table>
    <div class="form-inline">
    <form action="proc" method="post">
     <input type="hidden" name="void" value="cancel" />
    <input type="hidden" name="xoId" value="<?php echo $xoId ?>" />
    	<label>Enter Password: </label>
        <input type="password" name="password" class="form-control" />
        <input type="submit" class="btn btn-info" value="Void Xo" />
    </form>
    </div>
  	<!-- form-inline-->
	</div>
	<!--panel-body-->
	</div>
    <!--panel panel-default-->
</div>
<!-- container-->
<?php
 require_once'../common/acc_footer.php';
?> 
