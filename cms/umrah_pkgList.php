<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<body onLoad="call_ajax('ajax_call/get_umrah_pkgList', '', 'get_umrah_pkgList')">
<div class="content-wrapper">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="../index"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading">
     Umrah Packages List</span> </h2>
    <div class="panel panel-default panel-default-top-radius">
      <div class="panel-body">
      	<div class="col-md-2 pull-right row">
         <a href="addNewUmrah_pkg" class="btn btn-primary btn-flat pull-right">Add New</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Package Type</th>
                <th>Makkah Hotel</th>
                <th>Madina Hotel</th>
                <th width="10%">Thumb Image</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody class="get_umrah_pkgList"></tbody>
          </table>
        </div>
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
