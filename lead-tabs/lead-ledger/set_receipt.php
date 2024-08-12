<div class="box box-solid collapsed-box" style="border-top: 3px solid gold;">
  <div class="box-header with-border">
    <h3 class="box-title">Receipts</h3>
    <div class="box-tools">
      <button class="btn btn-box-tool" data-widget="collapse" onClick="get_sale('receipt', 'get_receipt')"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="overlay" style="display:none;"> <i class="fa fa-refresh fa-spin"></i> </div>
  <div class="box-body no-padding">
    <div class="table-responsive">
      <div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
            <tr role="row">
              <th>Date</th>
              <th>Branch</th>
              <th>Spo</th>
              <th>TP-RV</th>
              <th>Receive From</th>
              <th>A/c Details</th>
              <th>FOP</th>
              <th>Debit</th>
              <th>Credit</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="get_receipt">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.box-body --> 
</div>
<!-- responsive-->