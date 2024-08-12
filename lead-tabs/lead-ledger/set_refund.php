<div class="box box-solid collapsed-box" style="border-top: 3px solid darkgreen;">
  <div class="box-header with-border">
    <h3 class="box-title">Refunds</h3>
    <div class="box-tools">
      <button class="btn btn-box-tool" data-widget="collapse" onClick="get_sale('refund', 'get_refund')"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="overlay" style="display:none;"> <i class="fa fa-refresh fa-spin"></i> </div>
  <div class="box-body no-padding">
    <div class="table-responsive">
      <div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
            <tr role="row">
              <th>#</th>
              <th>Passanger Name</th>
              <th>Mobile No</th>
              <th>Sector</th>
              <th>Ticket No</th>
              <th>Date</th>
              <th>Charges</th>
              <th>Ref Amount</th>
              <th>Net</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="get_refund">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.box-body --> 
</div>
