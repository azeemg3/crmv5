<?php
require_once'../inc.func.php';
$cm->get_header('../');
?>
<script>
document.title='Umrah Package';
</script>
<body onLoad="call_ajax('ajax_call/get_umrah_pkg', '', 'get_umrah_pkg')">
<div class="content-wrapper">
<section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="../index"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="">Dashboard</li>
      <li>CMS</li>
      <li>Umrah Package</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading">
     Umrah Package</span> </h2>
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
                <th>Package Name</th>
                <th>Package Type</th>
                <th>Valid From-To</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody class="get_umrah_pkg"></tbody>
          </table>
        </div>
      </div>
      <!--panel panel-default--> 
    </div>
    <!--panel-body--> 
  </section>
</div>

<?php $cm->get_footer('../'); ?>