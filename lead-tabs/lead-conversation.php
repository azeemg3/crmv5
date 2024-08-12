<div class="box box-primary direct-chat direct-chat-primary collapsed-box" style="border-top: 3px solid salmon;">
  <div class="box-header with-border">
    <h3 class="box-title">Lead Conversation</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" onClick="lead_conv()"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="display:block;">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages" style="overflow-y:scroll !important; height:auto; max-height:250px;"> 
      <!-- Message. Default to the left -->
      <?php if($cm->u_value("lead", "status", "id=".$leadId."")=='unsuccessfull'){ ?> 
      <h3><span class="main-heading" style="background:#f2dede; color:#a94442">UnsuccessFull Reason </span></h3>
      <div class="direct-chat-msg">
      	<div class="direct-chat-text" style="border-radius:0px;">
        <?php echo $cm->u_value("lead", "unSucc_reason", "id=".$leadId.""); ?>
        </div>
        <!-- /.direct-chat-text --> 
      </div>
      <?php } ?>
      <div class="lead-chat-msg right">
        <!-- /.direct-chat-text --> 
      </div>
      <!-- /.direct-chat-msg -->
    </div>
    <!--/.direct-chat-messages--> 
    
  </div>
  <!-- /.box-body -->
  <div class="box-footer" style="display:block;">
    <form id="lead_conv">
    <div class="col-md-3">
    	<div class="form-group">
        <label>Reminder Date</label>
         <input type="text" class="date form-control input-sm" placeholder="Reminder Date" name="reminder_date" />
        </div>
    </div>
    <!--col-md-3-->
    <?php echo $cm->cron_time() ?>
    <div class="clearfix"></div>
    <div class="col-md-10">
      <div class="form-group">
        <textarea name="comment" class="form-control lead-comment"></textarea>
      </div>
     </div>
     <div class="col-md-2">
     <input  type="button" class="btn btn-success btn-flat" onClick="lead_conv()" value="Send"  style="margin-top:5%;">
     </div>
    </form>
  </div>
  <!-- /.box-footer--> 
</div>
