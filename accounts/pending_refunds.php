<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
$password="";
$msg="";
if(isset($_POST['ref_id']))
{
	$ref_id=$_POST['ref_id'];
	$password=md5($_POST['password']);
	if(isset($_POST['approved']) && $password==$cm->password_app($_SESSION['sessionId']))
	{
		$query=$cm->update("refund", "status='process', proc_date='".$cm->today()."'", "id=".$ref_id."");
		if($query=1)
		{
			$msg='<div class=" col-md-4 col-md-offset-4 alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>	<i class="icon fa fa-check"></i> Alert!</h4>
					Refund Has been Added In Process! 
         		  </div>'; 
		}
	}
elseif(isset($_POST['void']) && $password==$cm->password_app($_SESSION['sessionId']))
{
	$query=$cm->update("refund", "status='cancel'", "id=".$ref_id."");
	if($query==1)
	{
		$msg='<div class=" col-md-4 col-md-offset-4 alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>	<i class="icon fa fa-check"></i> Alert!</h4>
				Refund Has been Void Successfully! 
			  </div>'; 
	}
}
	else
	{
		$msg='<div class="col-md-5 col-md-offset-3 alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
				You Entered  Wrong Password OR You are not Authorize 
				 <a onClick="history.go(-1)">Go Back</a></p>
		 </div>';
	}
}
else if(isset($_POST['ref_id']) && !empty($_POST['ref_id']))
{
	$ref_id=$_POST['ref_id'];
	$cm->update("refund_payment", "status='approved'", "id=".$ref_id."");
}
//************************//
$query=$cm->selectMultiData("user.name, refund.*", "refund INNER JOIN user ON refund.userId=user.id", "refund.status='pending' AND refund.branch=".$_SESSION['branch_id']." ORDER BY id DESC");
?>
<script>
document.title='Pending Refund';
</script>
<body onLoad="loadpage()">
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
          <?php echo $msg; ?>
          <div class="clearfix"></div>
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Pending</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php $cm->go_back(); ?>
          <div class="table-responsive">
          <?php echo $cm->go_back(); ?>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
					$count=1;
					$id="";
					while($row=$query->fetch_assoc())
					{
						$id=$row['id'];
						echo'
							<tr>
								<td>'.$count++.'</td>
								<td>'.$row['leadId'].'</td>
								<td>'.$row['name'].'</td>
								<td>'.$row['passName'].'</td>
								<td>'.$row['phone'].'</td>
								<td>'.$row['sector'].'</td>
								<td>'.$row['airline_code'].'-'.$row['ticket_no'].'</td>
								<td>'.$row['status'].'</td>
								<td><a href="refund_det?ref_id='.$row['id'].'">View Refuned</a></td>
							</tr>
						';
					}
					$cm->nothing_found($id, "8");
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
<?php 
$cm->get_footer("../");
?>
