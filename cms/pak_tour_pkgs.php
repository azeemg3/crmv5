<?php 
require_once'../inc.func.php';
$cm->get_header("../");
?>
<body onLoad="call_ajax('ajax_call/get_pak_tour_pkg', '', 'get_pak_tour_pkg')">
<div class="content-wrapper">
  <section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading">
     Pakistan Tours Packages List</span> </h2>
     <?php echo $msg->return_msg() ?>
    <div class="panel panel-default panel-default-top-radius">
      <div class="panel-body">
      	<div class="col-md-2 pull-right row">
         <a href="add_new_pk_pkg" class="btn btn-primary btn-flat pull-right">Add New</a>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Package Name</th>
                <th>Destination Name</th>
                <th width="10%">Thumb Image</th>
                <th>Date</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody class="get_pak_tour_pkg"></tbody>
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
