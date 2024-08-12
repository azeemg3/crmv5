<?php
require_once'../inc.func.php';
$cm->get_header("../");
?>
<script>
    document.title = 'Email Marketing Groups';
</script>
<body onLoad="call_ajax('ajax_call/get_e_marketing_groups', '', 'get_e_marketing_groups')">
<div class="content-wrapper">
<div class="modal fade" id="email-mar-group" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Creat New A/C:</h4>
        </div>
         <form id="edit_eForm">
         <input type="hidden" name="group_id" value="0">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
             <div class="col-md-12">
              <div class="from-group">
               <label>Group Name</label>
               <input type="text" name="group_name" class="form-control input-sm">
              </div>
             </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="e_mar_group('edit_eForm')" >Update</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('edit_eForm')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="">Administrator</li>
      <li class="">Airline Travel Class</li>
    </ol>
  </section>
  <section class="content">
    <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;background:#cdcccc;"> <span class="main-heading">E-Marketing Groups</span></h2>
    <div class="panel panel-default">
      <div class="panel-body">
        <form id="eForm">
          <div class="col-md-3">
            <div class="form-group">
              <input type="text" name="group_name" class="form-control input-sm" required placeholder="Group Name">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <button type="button" class="btn btn-sm btn-success" onClick="e_mar_group('eForm')">Add</button>
            </div>
          </div>
        </form>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped dataTable">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                <th>#</th>
                <th>Group Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="get_e_marketing_groups">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--panel panel-default--> 
  </section>
</div>
<!-- container-->
<?php $cm->get_footer("../") ?>
