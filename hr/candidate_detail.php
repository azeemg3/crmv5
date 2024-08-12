<div class="modal fade" id="reject_reason" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="close_modal('form')">&times;</button>
          <h4 class="modal-title">Reject Reason</h4>
          	<div class="panel panel-default">
            <form id="form_reason">
      			<div class="panel-body">
            		<div class="col-lg-12 col-sm-12 col-xs-12 row">
                    	<div class="form-group col-lg-10">
                    		<textarea name="add_reason" id="add_reason" class="form-control input-sm"></textarea>
                      	</div>
                        <button type="button" id="rejected_id" value="" onClick="candidate_reject(this.value)" class="btn btn-info btn-sm" style="margin-top:5%;">Add</button>
                    </div>
                    <!-- col-lg-12-->
            	</div>
                </form>
          </div>
          <!--panel-default-->
        </div>
      </div>
      
    </div>
  </div>
<div class="modal fade" id="candidate_detail" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="close_modal('form')">&times;</button>
          <h4 class="modal-title">Candidate Detail</h4>
          	<div class="panel panel-default">
            <form id="form">
      			<div class="panel-body">
            		<div class="col-lg-12 col-sm-12 col-xs-12 row">
                    	<table class="table">
                        	<tr>
                            	<td><strong>Candidate Name</strong>: <span id="cn"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Mobile</strong>: <span id="cmobile"></span></td>
                            </tr>
                             <tr>
                            	<td><strong>Job Title</strong>: <span id="cjob_title"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Education</strong>: <span id="ceducation"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Experience</strong>: <span id="cexperience">Year</span></td>
                            </tr>
                            <tr>
                            	<td><strong>Location</strong>: <span id="clocation"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Apply Date</strong>: <span id="apply_date"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Skills</strong>: <span id="cskill"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Short Listed Date</strong>: <span id="shorList_date"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Hire Date</strong>: <span id="hire_date"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Status</strong>: <span id="cstatus"></span></td>
                            </tr>
                            <tr>
                            	<td><strong>Refrence</strong>: <span id="crefrence"></span></td>
                            </tr>
                            <tr>
                            	<td><div id="reason"></div></td>
                            </tr>
                        </table>
                        <button type="button" id="shortlist_id" class="btn btn-defautl btn-sm" onClick="short_list(this.value)" value="">Short List</button>
                        <button type="button" id="reject_id"  class="btn btn-defautl btn-sm" onClick="candidate_reject()" value="">Reject</button>
                        <button type="button" id="hire_id"  class="btn btn-defautl btn-sm" onClick="candidate_hire(this.value)" value="">Hire</button>
                    </div>
                    <!-- col-lg-12-->
            	</div>
                </form>
          </div>
          <!--panel-default-->
        </div>
      </div>
      
    </div>
  </div>