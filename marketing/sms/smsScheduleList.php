<?php 
require_once'../../inc.func.php';
$cm->get_header("../../")
?>
<body onLoad="call_ajax('../ajax_call/get_smsScheduleList', '', 'get_smsScheduleList')">
<div class="content-wrapper" id="loadpage"> 
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading">Sms Schedules</span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Group Name</th>
                <th>Status</th>
                <th>Message</th>
                <th>Compaign By</th>
                <th>Total Sms</th>
                <th>Schedule Time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tr>
              <td class="load" align="center" colspan="10"></td>
            </tr>
            <tbody class="get_smsScheduleList">
            </tbody>
          </table>
        </div>
      </div>
      <!--panel panel-default--> 
    </div>
    <!--panel-body--> 
  </section>
</div>
<!-- container-->
<?php $cm->get_footer("../../") ?>
