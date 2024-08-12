<?php
require_once'../common/acc_top.php';
require_once'rep_nav.php';
$status="";
if(isset($_GET['status']))
{
	$status=$_GET['status'];
}
$c_m->loader("../");
?>
<body onLoad="acc_call_ajax('get_spo_details_rep', 'form')">
<script>
document.title='Spo Lead Reports';
</script>
<div class="clearfix"></div>
<div class="container">
	<h2><span class="main-heading">Spo Lead Reports</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        	<?php $c_m->go_back(); ?>
        	<div class="clearfix"></div>
        	<div class="table-responsive" id="dvData">
            <form id="form">
            	<input type="hidden" name="spo" value="<?php echo $_GET['s'] ?>">
                <input type="hidden" name="status" value="<?php echo $status ?>">
                <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <select class="form-control" name="per_page" onChange="acc_call_ajax('get_spo_details_rep', 'form')">
				<option value="">Show Records</option>
				<?php $c_m->show_rec();  ?>
			</select>
            </div>
        </div>
        <!-- col-lg-2-->
            </form>
  			<table class="table table-bordered table-striped" id="lead_print">
            	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;">
                    <th>#</th>
                        <th>Lead Id</th>
                        <th>Spo Name</th>
                        <th>Contact Name</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Working Since</th>
                        <th>Service</th>
                        <th>View Details</th>
                </tr>
                <tbody id="get_spo_details_rep">
                </tbody>
            </table>
            </div>
            <!-- table-responsive-->
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
</div>
<!-- container-->
<?php require_once'../common/acc_footer.php'; ?>