<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Spo Lead Reports';
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
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Spo Lead Reports</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
       	<?php echo $cm->go_back(); ?>
        	<div class="clearfix"></div>
        	<div class="table-responsive" id="dvData">
            <div class="col-lg-2">
            	<form id="form">
            	<div class="form-group">
                	 <select class="form-control input-sm" name="branch" >
                        <option value="0">Select...</option>
                        <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']) ?>
                    </select>
                </div>
                </form>
            </div>
  			<table class="table table-bordered table-striped" id="lead_print">
            	<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;">
                    <th>#</th>
                    <th>Spo Name</th>
                    <th>Pending</th>
                    <th>Taken Over</th>
                    <th>In Process</th>
                    <th>Successfull</th>
                    <th>UnSuccessfull</th>
                    <th>Total Leads</th>
                </tr>
                <tbody id="get_spo_lead_reports">
                </tbody>
            </table>
            </div>
            <!-- table-responsive-->
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
