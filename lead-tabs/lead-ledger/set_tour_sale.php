<div class="box box-solid collapsed-box" style="border-top: 3px solid aqua;">
  <div class="box-header with-border">
    <h3 class="box-title">Tour Sales</h3>
    <div class="box-tools">
      <button class="btn btn-box-tool" data-widget="collapse" onclick="get_sale('tour_sale', 'get_tourSale_unique')">
      <i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body no-padding">
   <form id="search_tour_sale">
    	<div class="col-md-2">
        	<div class="form-group">
            	<input type="text" class="form-control input-sm fdate" name="dt_frm" placeholder="Posted Date From" />
            </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
            	<input type="text" class="form-control input-sm fdate" name="dt_to" placeholder="Posted Date To" />
            </div>
        </div>
        <div class="col-md-1 row">
        	<div class="form-group">
            	<button type="button" class="btn btn-sm btn-primary" onclick="get_sale('tour_sale', 'get_tourSale_unique')"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
    <div class="table-responsive">
      <div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
            <tr role="row">
              <th>#</th>
              <th>Issue Date</th>
              <th>inv No</th>
              <th>Posted By</th>
              <th>Visa Amount</th>
              <th>Hotel Amount</th>
              <th>Transport Amount</th>
              <th>Tour Amount</th>
              <th>Other Amount</th>
              <th>Net</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="get_tourSale_unique">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.box-body --> 
</div>
<!-- responsive-->