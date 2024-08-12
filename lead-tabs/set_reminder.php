<div class="modal fade" id="set_reminder" role="dialog">
		<div class="modal-dialog"> 
		  <!-- Modal content-->
		  <div class="modal-content" style="height:350px;">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">×</button>
              <h3>Set Reminder:</h3>
			</div>
            <form id="reminderForm">
			<div class="col-md-12">
            	<div class="col-md-6">
                	<div class="form-group">
                    	<label>Set Date</label>
                        <input type="text" class="form-control input-sm date" name="reminder_date">
                    </div>
                </div>
                <?php echo $cm->cron_time() ?>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Email</label>
                        <input type="email" class="form-control input-sm" name="rec_email">
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Mobile</label>
                        <input type="mobile" class="form-control input-sm" name="mobile">
                    </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                    	<label>Reminder Message</label>
                        <textarea class="form-control input-sm lead-reminder-msg" name="message"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                    	<input type="button" value="Create" class="btn btn-sm btn-success pull-right" onClick="set_reminder()">
                    </div>
                </div>
            </div>
            </form>
			<div class="clearfix"></div>
		  </div>
		  <!--modal-content--> 
		</div>
		</div>