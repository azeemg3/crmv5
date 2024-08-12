 <!-- Modal -->
  <div class="modal fade" id="un-reason" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <form action="lead_details">
       <input type="hidden" name="leadId" value="<?php echo $cm->encodeData($leadId) ?>" />
       <input type="hidden" name="closeLead" value="unsuccessfull" />
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reason:</h4>
        </div>
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<div class="col-sm-6">
                	<div class="form-group">
                    	<select class="form-control input-sm" name="un_Succ_reason" onChange="add_reason(this.value)">
                        	<option value="">Select Reason</option>
                            <option value="Fake Lead">Fake Lead</option>
                            <option value="Without Info">Without Info</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                	<div class="form-group">
                    	<div id="add-reason"></div>
                    </div>
                </div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>