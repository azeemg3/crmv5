<div class="box box-solid collapsed-box" style="border-top: 3px solid chocolate;">
  <div class="box-header with-border">
    <h3 class="box-title">Other Sales</h3>
    <div class="box-tools">
      <button class="btn btn-box-tool" data-widget="collapse" onClick="get_sale('other_sale', 'get_other_sale')"> <i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="overlay" style="display:none;"> <i class="fa fa-refresh fa-spin"></i> </div>
  <div class="box-body no-padding">
   <!---=======================Search Form==================-->
    <br />
    <form id="search_other_sale">
    	<div class="col-md-2">
        	<div class="form-group">
            	<input type="text" class="form-control input-sm fdate" name="dt_frm" placeholder="Posted Date From" autocomplete="off" />
            </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
            	<input type="text" class="form-control input-sm fdate" name="dt_to" placeholder="Posted Date To" autocomplete="off" />
            </div>
        </div>
        <div class="col-md-1 row">
        	<div class="form-group">
            	<button type="button" class="btn btn-sm btn-primary" onclick="get_sale('other_sale', 'get_other_sale')"><i class="fa fa-search"></i></button>
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
              <th>Inv No.</th>
              <th>Passport</th>
              <th>Service Type</th>
              <th>Posted By</th>
              <th>Passenger</th>
              <th>SaleDetails</th>
              <th>A/c Details</th>
              <th>Net</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="get_other_sale">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.box-body --> 
</div>
