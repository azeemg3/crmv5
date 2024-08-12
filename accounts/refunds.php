<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
$id="";
if(!empty($_GET['st']) && $_GET['st']=="process")
{
	$head="Refund In Processs";
	$query=$cm->selectMultiData("user.name, refund.*", "refund INNER JOIN user ON refund.userId=user.id", "refund.status='process' AND branch=".$_SESSION['branch_id']." ORDER BY id DESC");
}
else
{
	$head="All Refunds";
	$query=$cm->selectMultiData("user.name, refund.*", "refund INNER JOIN user ON refund.userId=user.id", "branch=".$_SESSION['branch_id']." ORDER BY id DESC");
}
if(!empty($_POST['ref_id']) && !empty($_POST['amount']))
{
	$amount=$_POST['amount'];
	$leadId=$cm->u_value("refund", "leadId", "id=".$_POST['ref_id']."");
	$cm->update("refund", "net='$amount', status='approved', app_date='".$cm->today()."'", "id=".$_POST['ref_id']."");
	//$cm->succ_acc($leadId);
}
?>
<script>
document.title='<?php echo $head; ?>';
</script>
<body onLoad="loadpage()">
<div class="modal fade" id="add_payment" role="dialog">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <input type="hidden" name="ref_id" id="ref_id"  />
          <h4 class="modal-title">Add Refund Payment</h4>
        </div>
        <div class="modal-body">
          <p>
              <div class="form-inline">
                <label for="exampleInputName2">Add Payment</label>
                <input type="text" name="amount" class="form-control">
                <input type="submit" value="Add" class="btn btn-primary" />
              </div>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
    </form>
  </div>
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
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading"><?php echo $head; ?></span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php echo $cm->go_back(); ?>
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
            	<thead>
                	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                    	<td>#</td>
                    	<td>Lead Id</td>
                        <td>User</td>
                        <td>Passanger Name</td>
                        <td>Mobile No</td>
                        <td>Sector</td>
                        <td>Ticket No</td>
                        <th>Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                 <?php
				$count=1;
			while($row=$query->fetch_assoc())
			{
				$id=$row['id'];
				echo '
					<tr>
						<td>'.$count++.'</td>
						<td>'.$row['leadId'].'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['passName'].'</td>
						<td>'.$row['phone'].'</td>
						<td>'.$row['sector'].'</td>
						<td>'.$row['airline_code'].'-'.$row['ticket_no'].'</td>
						<td>'.$row['status'].'</td>
						<td>
						<a onclick="add_ref_pay('.$row['id'].')">Add Amount</a>
						</td>
					</tr>
				';
				//echo "always say this " .  . " Always say this at the end.";
 
			}
			echo $cm->nothing_found($id, 10);
				?>
            </table>
          </div>
          <!-- responsive-->  
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<script type="text/javascript">
function add_ref_pay(ref_id)
{
	$("#add_payment").modal();
	$("#ref_id").val(ref_id);
}
</script>
<?php 
$cm->get_footer("../");
?>
