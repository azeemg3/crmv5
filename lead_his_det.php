<?php
require_once'inc.func.php';
$cm->get_header("");
if(isset($_GET['leadId'])){$leadId=$cm->decodeData($_GET['leadId']);}
$res=$cm->selectMultiData("lead.created_by, lead.create_date, audit_lead.userId, audit_lead.takeover_date, audit_lead.status, audit_lead.proc_date, lead.spo, audit_lead.close_date, audit_lead.closed_by, audit_lead.close_reason, audit_lead.reopen_time, audit_lead.reopen_by, audit_lead.takeover_by", "audit_lead left join lead on audit_lead.leadId=lead.id", "lead.id=".$leadId." and audit_lead.status!=''");
//fetch lead details....
$result=$cm->selectMultiData("lead.id, lead.comment, user.name, lead.contact_name, lead.create_date", "lead inner join user on lead.created_by=user.id", "lead.id=".$leadId."");
$lrow=$result->fetch_assoc();
?>
<div class="wrapper">
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Lead History <small>Lead No: <?php echo $leadId; ?></small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">Timeline</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
         <!-- The time line -->
          <ul class="timeline">
           <?php 
			echo '
            <!-- timeline time label -->
            <li class="time-label"> <span class="bg-blue">Lead Id: '.$leadId.'</span> </li>
            <!-- /.timeline-label --> 
            <!-- timeline item -->
            <li> <i class="fa fa-pause bg-blue"></i>
              <div class="timeline-item"> 
                <h3 class="timeline-header"><a href="#" class="text-teal">Created By:</a>
				 <span style="font-size:12px;">'.$lrow['name'].' &nbsp;('.$lrow['create_date'].')</span></h3>
                <div class="timeline-body">'.$lrow['comment'].'</div>
                <div class="timeline-footer"> <strong>Contact Name:</strong> '.$lrow['contact_name'].' </div>
              </div>
            </li>
            <!-- END timeline item --> ';?>
            <!-- timeline item -->
          </ul>
          <!-- The time line --> 
          <!-- The time line -->
          <ul class="timeline">
           <?php while($row=$res->fetch_assoc()){
			echo '
            <!-- timeline time label -->
            <li class="time-label"> <span class="bg-'.(($row['status']=='pending')?'yellow':"").''.(($row['status']=='new')?'blue':"").''.(($row['status']=='process')?'teal':"").''.(($row['status']=='unsuccessfull')?'red':"").''.(($row['status']=='successfull')?'green':"").'">
			'.(($row['status']=='pending')?''.$row['reopen_time'].'':'').'
			'.(($row['status']=='new')?''.$row['takeover_date'].'':'').'
			'.(($row['status']=='process')?''.$row['proc_date'].'':'').'
			'.(($row['status']=='successfull' || $row['status']=='unsuccessfull')?''.$row['close_date'].'':'').'
			</span> </li>
            <!-- /.timeline-label --> 
            <!-- timeline item -->
            <li> <i class="'.(($row['status']=='pending')?'fa fa-pause bg-yellow':"").''.(($row['status']=='new')?'fa fa-phone bg-blue':"").''.(($row['status']=='process')?'fa fa-spinner bg-teal':"").''.(($row['status']=='unsuccessfull')?'fa fa-thumbs-o-down bg-red':"").''.(($row['status']=='successfull')?'fa fa-thumbs-o-up bg-green':"").'"></i>
              <div class="timeline-item"> 
                <h3 class="timeline-header"><a href="#" class="text-'.(($row['status']=='pending')?'yellow':"").''.(($row['status']=='new')?'blue':"").''.(($row['status']=='process')?'teal':"").''.(($row['status']=='unsuccessfull')?'red':"").''.(($row['status']=='successfull')?'green':"").'">'.$row['status'].' :</a>
				'.(($row['status']=='pending')?' Reopen By:':'').' '.(($row['status']=='new')?'Take Over By:':'').' '.(($row['status']=='process')?' Process By:':'').' '.(($row['status']=='successfull')?' Closed By:':'').' '.(($row['status']=='unsuccessfull')?'  Closed By:':'').'<span style="font-size:12px;">'.(($row['status']=='pending')?'
				'.$cm->u_value("user", "name", "id=".$row['reopen_by']."").'':'').'
				 '.(($row['status']=='process')?''.$cm->u_value("user", "name", "id=".$row['userId']."").'':'').'
				 '.(($row['status']=='new')?''.$cm->u_value("user", "name", "id=".$row['takeover_by']."").'':'').'
				 '.(($row['status']=='successfull')?''.$cm->u_value("user", "name", "id=".$row['userId']."").'':'').'
				 '.(($row['status']=='unsuccessfull')?''.$cm->u_value("user", "name", "id=".$row['userId']."").'':'').'
				</span></h3>
                <div class="timeline-body"> '.(($row['status']=='unsuccessfull')?''.$row['close_reason'].'':'').'</div>
                <!--<div class="timeline-footer"> <a class="btn btn-primary btn-xs">Read more</a> <a class="btn btn-danger btn-xs">Delete</a> </div>-->
              </div>
            </li>
            <!-- END timeline item --> ';
				}?>
            <!-- timeline item -->
          </ul>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper --> 
</div>
<!-- ./wrapper -->
<?php 
$cm->get_footer("")
?>
