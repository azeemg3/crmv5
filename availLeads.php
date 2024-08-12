<?php
require_once'inc.func.php';
$cm->get_header("");
	$result=$cm->selectData("lead", "status='pending' AND spo=".$_SESSION['sessionId']." or spo='0' 
	AND branch_id=".$_SESSION['branch_id']."");
?>
<script>
    document.title = 'My Leads';
</script>
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Available Leads</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
             	<tr>
                	<th>Lead Id</th>
                    <th>Mobile No</th>
                    <th>Contact Name</th>
                    <th>Travel Date</th>
                    <th>Sector</th>
                    <th>Services</th>
                    <th>Take Over</th>
                    <th>View Lead</th>
                </tr>
                <?php 
               while($row=$result->fetch_assoc())
				{
					echo'
					<tr>
						<td>'.$row['id'].'</td>
						<td>'.$row['mobile'].'</td>
						<td>'.$row['contact_name'].'</td>
						<td>'.$row['travel_datefrm'].'</td>
						<td>'.$row['sector'].'</td>
						<td>'.$row['services'].'</td>
						<td><a href="myLeads?leadId='.$cm->encodeData($row['id']).'">Take Over</a></td>
						<td><a href="lead_details?leadId='.$cm->encodeData($row['id']).'">View Lead</a></td>
					</tr>
					';	
				}	
			?>
             </table>
      </div>
    </div>
    <!--panel panel-default--> 
  </div>
  <!--panel-body--> 
</div>
<!-- container-->
<?php $cm->get_footer("") ?>         