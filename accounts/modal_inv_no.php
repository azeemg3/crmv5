<div class="modal" id="inv_no">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Enter Invoice No:</h4>
      </div>
      <div class="modal-body">
        <p>
        <form id="invForm">
        <input type="hidden" name="sale_id">
        <input type="hidden" name="sale_type">
        	<div class="col-sm-3">
        	<input type="text" class="form-control input-sm" name="invoice_no">
            </div>
            <div class="col-sm-6">
        	<input type="button" class="btn btn-sm btn-success" onClick="inv_no()" value="Add">
            </div>
         </form>
            <div class="clearfix"></div>
        </p>
      </div>
      <div class="modal-footer"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
