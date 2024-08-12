<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Lead Reports';
</script>
<body onLoad="lead_rep(1)">
<div class="content-wrapper">
<?php echo $cm->loader("../"); ?>
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
	<h2 class="bg-green-gradient text-center" style="margin:0px;padding:10px 0px;"><span class="main-heading">Lead Reports</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <?php echo $cm->go_back(); ?>
        <form id="form">
        <div class="clearfix"></div>
        	<div class="col-lg-2">
            	<div class="form-group">
                    <input type="text" name="df" class="form-control date input-sm" placeholder="Date From">
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                    <input type="text" name="dt" class="form-control date input-sm"  placeholder="Date To">
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                    <input type="text" name="leadId" class="form-control input-sm" placeholder="Search with Lead No">
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                    <input type="text" name="contact_name" class="form-control input-sm" placeholder="Contact Name" >
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                    <input type="text" name="mobile" class="form-control input-sm" placeholder="Contact Number" >
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                    <select class="form-control input-sm" name="status" >
                    	<option value="">Lead Status</option>
                        <?php echo $cm->lead_status(); ?>
                    </select>
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                    <select class="form-control input-sm" name="branch" >
                    	<option value="0">Select...</option>
                        <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                    </select>
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
             <div class="col-lg-2">
            	<div class="form-group">
                    <select class="form-control input-sm" name="spo" id="spo" >
                    	<option value="">Select Spo</option>
                        <?php echo $cm->spo('', $_SESSION['branch_id']); ?>
                    </select>
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2 col-sm-3">
            <div class="form-group">
            <select class="form-control input-sm" name="per_page" >
				<option value="">Show Records</option>
                <?php echo $cm->show_rec(); ?>
			</select>
            </div>
        </div>
        <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<button type="button" class="btn btn-primary btn-sm" onClick="lead_rep(1)">
                    <i class="fa fa-search"></i> Search</button>
                    <button type="reset" class="btn btn-default btn-sm">Reset</button>
                    
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            <div class="col-lg-2">
            	<div class="form-group">
                	<button type="submit" class="btn btn-default btn-sm" name="excel" id="btnExport">
                    <i class="fa fa-fw fa-cloud-download"></i></button>
                    <button type="button" class="btn btn-default btn-sm"  onClick="PrintMe()">
                      <span class="glyphicon glyphicon-print"></span>
                    </button>
                </div>
                <!-- form-group-->
            </div>
            <!-- col-lg-2-->
            </form>
        	<div class="clearfix"></div>
        	<div class="table-responsive" id="dvData">
  			<table class="table table-bordered table-striped" id="lead_print">
            	<!--<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;">-->
                <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;margin-top:20px;color: #fff!important;">
                    <th>Sr#</th>
                    <th>Date</th>
                    <th>Lead ID</th>
                    <th>Contact</th>
                    <th>Client Name</th>
                    <th>Created By</th>
                    <th>Taken Over By Spo</th>
                    <th>Working Since</th>
                    <th>Status</th>
                </tr>
                <tbody class="get_lead_reports">
                </tbody>
                <tr><td colspan="10" id="pagination"></td></tr>
            </table>
            </div>
            <!-- table-responsive-->
		</div>
	<!--panel panel-default-->
    </form>
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<?php 
$cm->get_footer("../");
?>
<script language="javascript">
function PrintMe() {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=1000, height=800, left=100, top=25";
   var content_vlue = $(".get_lead_reports").html();
   var docprint=window.open("","",disp_setting);
   docprint.document.open();
   docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
   docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
   docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
   docprint.document.write('<head>');
   docprint.document.write('<link href="../bootstrap/css/printXo.css" type="text/css" rel="stylesheet">');
   docprint.document.write('<style type="text/css">body{ margin:0px;@page {size: auto;margin:1 auto;}');
   docprint.document.write('font-family:verdana,Arial;color:#000;');
   docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
   docprint.document.write('a{color:#000;text-decoration:none;} </style>');
   docprint.document.write('</head><body onLoad="self.print()"><center>');
   docprint.document.write('<div id="print"><div id="wrapper">');
   docprint.document.write('<div id="header">');
   docprint.document.write('<div id="tvt"><img src="../branch_logo/<?php echo $cm->u_value("branches","branch_logo","branch_id=".$_SESSION['branch_id']."") ?>"></div>');//images
    docprint.document.write('<div id="header-mid">');
	 docprint.document.write('<div id="txt"><?php echo $cm->u_value("branches","branch_name","branch_id=".$_SESSION['branch_id']."") ?></div>');
	 docprint.document.write('<p align="center"><?php echo $cm->u_value("branches","address","branch_id=".$_SESSION['branch_id']."") ?></p>');
	docprint.document.write('</div>');
   docprint.document.write('</div>');
   docprint.document.write('</div></div>');
   docprint.document.write('<table border="1" width="100%" style="text-align:center;">');
   docprint.document.write('<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;" id="printTr">');
   docprint.document.write('<th>Sr#</th><th>Date</th><th>Lead Id</th><th>Contact</th><th>Client Name</th><th>Created By</th><th>Taken Over By Spo</th><th>Work Since</th><th>Status</th>');
   docprint.document.write('</tr>');
   docprint.document.write(content_vlue);
   docprint.document.write('</table>');
   docprint.document.write('</center></body></html>');
   docprint.document.close();
   docprint.focus();
}
</script>