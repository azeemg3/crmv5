<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<?php $cm->loader("../"); ?>
<body>
<div class="content-wrapper">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Spo Account Reports</span></h2>
    <div class="panel panel-default">
      <div class="panel-body"> <?php echo $cm->go_back(); ?>
        <div class="clearfix"></div>
        <form id="form" action="print" target="_blank" method="post">
        <!--<div class="col-md-2">
          <div class="form-group">
            <input type="text" class="date form-control input-sm" placeholder="Date From">
          </div>
        </div>-->
        <!--col-md-2-->
        <!--<div class="col-md-2">
          <div class="form-group">
            <input type="text" class="date form-control input-sm" placeholder="Date From">
          </div>
        </div>-->
        <!--col-md-2-->
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control input-sm selected_branch_rep" name="branch" >
                    <option value="0">Select Branch</option>
                    <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
                </select>
            </div>
            <!-- form-group-->
        </div>
        <!-- col-md-2-->
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control input-sm fetch_spo_rep" name="spo" id="spo" >
             <option value="">Select Spo</option>
             <?php echo $cm->spo('', $_SESSION['branch_id']); ?>
            </select>
          </div>
        </div>
        <!--col-md-2-->
        <div class="col-md-2">
          <button type="button" class="btn btn-sm btn-primary" onClick="get_spo_acc_rep()"><i class="fa fa-search"></i></button>
           <button type="button" onClick="PrintMe()" class="btn btn-sm btn-default"><i class="fa fa-print"></i></button>
        </div>
        <!--col-md-2-->
        </form>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="lead_print">
            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;" id="printTr">
              <th>#</th>
              <th>Spo Name</th>
              <th>Client Name</th>
              <th>Outstanding Balance</th>
            </tr>
            <tbody class="get_spo_acc_reports"></tbody>
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
<script language="javascript">
function PrintMe() {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=1000, height=800, left=100, top=25";
   var content_vlue = $(".get_spo_acc_reports").html();
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
   docprint.document.write('<table border="1" width="100%" style="text-align:center">');
   docprint.document.write('<tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; margin-top:20px;" id="printTr">');
   docprint.document.write('<th>#</th><th>Spo Name</th><th>Client Name</th><th>Outstanding Balance</th>');
   docprint.document.write('</tr>');
   docprint.document.write(content_vlue);
   docprint.document.write('</table>');
   docprint.document.write('</center></body></html>');
   docprint.document.close();
   docprint.focus();
}
</script>