<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<body onLoad="call_ajax('marketing/ajax_call/get_sh_emails', '', 'get_sh_emails')">
<div class="content-wrapper" id="loadpage"> 
  <!--=====================Bulk Email sending pop up--================================-->
  <div class="modal fade bulk_email_pop_up"  role="dialog">
    <div class="modal-dialog" style="width:80%;"> 
      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Email Details</h4>
          </div>
          <div class="modal-body">
           <p class="email_content"></p>
          </div>
          <!--modal-body-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ok</button>
          </div>
        </div>
    </div>
  </div>
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;margin:0px;padding:10px 0px;background:#cdcccc;"><span class="main-heading">Schedule Emails</span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Subject</th>
                <th>Date</th>
                <td>Status</td>
                <th>Created By</th>
                <th>Branch</th>
                <th>Action</th>
              </tr>
            </thead>
            <tr>
              <td class="load" align="center" colspan="10"></td>
            </tr>
            <tbody class="get_sh_emails">
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
<?php $cm->get_footer("") ?>
