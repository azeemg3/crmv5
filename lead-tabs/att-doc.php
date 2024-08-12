<div class="modal fade" id="document-modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <form id="new-city">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<img id="view-donc-img" src="" style="min-width:30%; max-width:100%;" />
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
        	<a id="download-doc-img" class="btn btn-sm bnt-success" download>Download</a>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>

<div id="att-doc" class="tab-pane fade">
  <h3>Attach Document</h3>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="uploadimage" enctype="multipart/form-data">
        <div class="col-md-3">
          <div class="form-group">
            <label>Document Type</label>
            <select class="input-sm form-control" name="doc_type">
              <option value="passport">Passport</option>
              <option value="Picutre">Picutre</option>
              <option value="idcard">Id Card</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>E-Number</label>
            <input type="text" name="e_number" class="form-control input-sm" />
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Passenger Name</label>
            <input type="text" name="passName" class="form-control input-sm" />
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Attach File</label>
            <input type="file" name="doc_name" class="form-control input-sm" />
          </div>
        </div>
        <div class="col-md-2 pull-right">
          <div class="form-group">
            <input type="submit" value="Upload" class="submit" style="margin-top:28px;" />
          </div>
        </div>
      </form>
    </div>
    <div class="clearfix"></div>
    <div class="box box-solid collapsed-box" style="border-top: 3px solid #3c8dbc;">
      <div class="box-header with-border">
        <h3 class="box-title">Attached Document</h3>
        <div class="box-tools">
          <button class="btn btn-box-tool" data-widget="collapse" onclick="get_sale('att_doc', 'get_document')"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="overlay" style="display:none;"> <i class="fa fa-refresh fa-spin"></i> </div>
      <div class="box-body no-padding">
      <form id="s_attDocForm">
      	<div class="col-md-2">
      	<div class="form-group">
        	<input type="text" name="passName" class="form-control input-sm" placeholder="Passanger Name" />
        </div>
      </div>
      <!--col-md-2--->
      <div class="col-md-2">
      	<div class="form-group">
        	<input type="text" name="e_number" class="form-control input-sm" placeholder="E-Number" />
        </div>
      </div>
      <!--col-md-2--->
      <div class="col-md-2">
      	<div class="form-group">
        	<button type="button" class="btn-sm btn btn-info" onclick="get_sale('att_doc', 'get_document')"><i class="fa fa-search"> Search</i></button>
        </div>
      </div>
      <!--col-md-2--->
      </form>
      <div class="clearfix"></div>
        <div class="table-responsive">
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th>#</th>
                  <th>Lead Id</th>
                  <th>Document Type</th>
                  <th>E-Number</th>
                  <th>Passenger</th>
                  <th>View Document</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="get_document"></tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.box-body --> 
    </div>
  </div>
  <!--panel-default--> 
</div>
