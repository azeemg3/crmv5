<div class="modal fade" id="tour_email_det" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Emain In Details</h4>
        </div>
        <form id="form_email_det">
        <div class="modal-body">
          <div class="form-group">
          	<input type="text" placeholder="Subject OF Email" name="subject" class="form-control input-sm">
          </div>	
          <div class="form-group">
          	<input type="text" name="email" placeholder="Write Receiver Email" class="form-control input-sm">
          </div>
          <div class="form-group">
          	<input type="text" name="description" placeholder="Write Email Description" class="form-control input-sm">
          </div>
          <div class="form-group">
          	<input type="button" name="" value="Send Email" class="btn-info form-control input-sm" onclick="send_tour_email('tour_email_det')">
          </div>
        </div>
        <!--modal-body-->
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="tour_email_summery" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Emain In Summery</h4>
        </div>
        <form id="form_email_summry">
        <div class="modal-body">
          <div class="form-group">
          	<input type="text" placeholder="Subject OF Email" name="subject" class="form-control input-sm">
          </div>	
          <div class="form-group">
          	<input type="text" name="email" placeholder="Write Receiver Email" class="form-control input-sm">
          </div>
          <div class="form-group">
          	<input type="text" name="description" placeholder="Write Email Description" class="form-control input-sm">
          </div>
          <div class="form-group">
          	<input type="button" value="Send Email" class="btn-info form-control input-sm" onclick="send_tour_email('tour_email_summery')">
          </div>
        </div>
        <!--modal-body-->
        </form>
      </div>
      
    </div>
  </div>