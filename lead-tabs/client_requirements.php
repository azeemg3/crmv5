<?php if($row['comment']!="")
{
 ?>
<div class="box box-primary direct-chat direct-chat-primary collapsed-box" style="border-top: 3px solid salmon; display:block;">
  <div class="box-header with-border">
    <h3 class="box-title">Client Requirements</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" onClick="lead_conv()"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="display:block"> 
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages" style="height:auto;"> 
      <!-- Message. Default to the left -->
      <!--<h3><span class="main-heading" style="background:#f2dede; color:#a94442">Heading </span></h3>-->
      <div class="direct-chat-msg">
        <div class="direct-chat-text" style="border-radius:0px;"> <?php echo $row['comment'] ?>
        </div>
        <!-- /.direct-chat-text --> 
      </div>
      <div class="lead-chat-msg right"> 
        <!-- /.direct-chat-text --> 
      </div>
      <!-- /.direct-chat-msg --> 
    </div>
    <!--/.direct-chat-messages--> 
    
  </div>
  <!-- /.box-body --> 
  <!-- /.box-footer--> 
</div>
<?php } ?>