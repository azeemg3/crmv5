<div class="modal fade in" id="feedback-modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" style="height:450px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Client Feedback:</h3>
			</div>
			<form id="feedback-form">
				<div class="col-md-10">
					<div class="form-group">
						<label>Feed Back Details</label>
						<textarea class="form-control input-sm" name="feedback"></textarea>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<button type="button" class="btn btn-sm btn-success pull-right" style="margin-top:60%;" onclick="client_feedback(<?php echo $leadId ?>)">
						Send
						</button>
					</div>
				</div>
			</form>
			<div class="clearfix"></div>
			<div class="box-body">
				<div class="direct-chat-messages feedback_msg" style="overflow:scroll !important;">
					
					
				<!--/.direct-chat-messages-->
			</div>
		</div>
		<!--modal-content-->
	</div>
</div>