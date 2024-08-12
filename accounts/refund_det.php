<?php
require_once'../inc.func.php';
$cm->get_header('../');
$row=NULL;
if(isset($_GET['ref_id']) && !empty($_GET['ref_id']))
{
	$ref_id=$_GET['ref_id'];
	$query=$cm->selectMultiData("user.name, branches.branch_name, lead.contact_name, refund.*", "refund INNER JOIN user ON refund.userId=user.id
	INNER JOIN branches ON refund.branch=branches.branch_id
	INNER JOIN lead ON refund.leadId=lead.id
	", "refund.status='pending' AND refund.id=".$ref_id." AND refund.branch=".$_SESSION['branch_id']."");
	$row=$query->fetch_assoc();
}
?>
<script>
document.title='Receipt Detail';
</script>
<div class="clearfix"></div>
<div class="content-wrapper" id="loadpage">

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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Refund Details</span></h2>
	<div class="panel panel-default col-lg-6">
  		<div class="panel-body">
        <form action="pending_refunds" method="post">
            <input type="hidden" name="ref_id" value="<?php echo $ref_id ?>">
    	<div class="col-lg-5">
        	<div class="form-group">
            	<label>Enter Password:</label>
                <input type="password" name="password" class="form-control input-sm" autocomplete="off" >
            </div>
        </div>
        <!-- col-lg-5-->
        <div class="col-lg-5">
        	<div class="form-group">
                <input type="submit" value="Authorize Payment" name="approved" class="btn btn-sm" style="margin-top: 25px;">
            </div>
        </div>
        <!-- col-lg-5-->
        </form>
        <div class="clearfix"></div>
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
                <tr>
                	<td>Date:</td>
                    <td><?php echo $row['create_date'] ?></td>
                </tr>
                <tr>
                	<td>Branch:</td>
                    <td><?php echo $row['branch_name'] ?></td>
                </tr>
                <tr>
                	<td>Receive From:</td>
                    <td><?php echo $row['contact_name'] ?></td>
                </tr>
                <tr>
                	<td>Phone:</td>
                    <td><?php echo $row['phone'] ?></td>
                </tr>
                <tr>
                	<td>Sector:</td>
                    <td><?php echo $row['sector'] ?></td>
                </tr>
                	<td>Remarks:</td>
                    <td>
					<?php $row['remark']; ?>
                    </td>
                </tr>
                <tr>
                	<td>Issued By:</td>
                    <td><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                	<td>Action By:</td>
                    <td>Not Authorize</td>
                </tr>
            </table>
          </div>
          <!-- responsive--> 
          <form action="pending_refunds" method="post">
            <input type="hidden" name="ref_id" value="<?php echo $ref_id ?>">
          <div class="col-lg-6">
        	<div class="form-group">
            	<label>Enter Password:</label>
                <input type="password" name="password" class="form-control input-sm">
            </div>
        </div>
        <!-- col-lg-6--> 
        <div class="col-lg-5">
        	<div class="form-group">
                <input type="submit" value="Void Receipt" name="void" class="btn tbn-sm" style="margin-top: 25px;">
            </div>
        </div>
        <!-- col-lg-5-->
    </form>
		</div>
	<!--panel panel-default-->
	</div>
    </section>
</div>
<!-- container-->
<?php $cm->get_footer("../"); ?>