<?php
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
document.title='Deleted History';
</script>
<body onLoad="call_ajax('ajax_call/get_deleted_history', '', 'get_deleted_history')">
<div class="content-wrapper">
  <section class="content-header" style="padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12"> 
        <!-- /.box-header -->
        <div class="box-body">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Deleted History</h3>
            </div>
            <!-- /.box-header -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;margin-top:20px;">
                    <th>#</th>
                    <th>Date</th>
                    <th>File Type</th>
                    <th>Deleted Id</th>
                    <th>Deleted By</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody class="get_deleted_history">
                </tbody>
              </table>
            </div>
            <!-- /.box-body --> 
          </div>
        </div>
        <!-- /.box-body --> 
      </div>
      <!--col-xs-12--> 
    </div>
    <!--row--> 
  </section>
</div>
<?php
$cm->get_footer("../");
?>
