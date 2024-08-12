<?php
require_once'inc.func.php';
$cm->get_header("");
$lrow=NULL;
$res=$cm->selectMultiData("lead.created_by, lead.id AS leadId, lead.create_date, lead.spo, lead.contact_name", "lead", "1 order by lead.id DESC limit 100");
?>
<div class="wrapper">
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Lead's Follow Up <small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lead's Follow Up</li>
        <li style="text-align: center"><?php echo $cm->today(); ?></li>
      </ol>
    </section>
    <div class="box-header">
      <div class="col-md-2">
         <div class="form-group">
          <input type="text" class="form-control date input-sm" placeholder="Date From">
		 </div>
	  </div>
	  <div class="col-md-2">
         <div class="form-group">
          <input type="text" class="form-control date input-sm" placeholder="Date To">
		 </div>
	  </div>
	  <div class="col-md-2">
         <div class="form-group">
			 <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
			 <button class="btn btn-sm btn-danger"><i class="fa fa-file-word-o""></i></button>
			 <button class="btn btn-sm btn-success"><i class="fa fa-file-excel-o""></i></button>
		 </div>
		</div>
    </div>
    <!-- Main content -->
    <section class="content"> 
      <!-- row -->
      <div class="row">
        <div class="col-md-12"> 
         <!-- The time line -->
         <?php while($row=$res->fetch_assoc()){ ?>
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label"> <span class="bg-blue">Lead Id: <?php echo($row['leadId']) ?></span> </li>
            <!-- /.timeline-label --> 
            <!-- timeline item -->
            <li> <i class="fa fa-pause bg-blue"></i>
              <div class="timeline-item"> 
                <h3 class="timeline-header"><a href="#" class="text-teal">Created By:</a>
				 <span style="font-size:12px;"><?php echo strtoupper($cm->u_value('user', 'name', 'id='.$row['created_by'].'')) ?> &nbsp;(<?php echo($row['create_date']) ?>)</span> &emsp;&emsp;&emsp; |&emsp; <a href="#" class="text-teal">Takenover By:</a> <span style="font-size:12px;"><?php echo strtoupper($cm->u_value('user', 'name', 'id='.$row['spo'].'')) ?> &nbsp;(12-02-2019)</span> &emsp;|&emsp; Contact Name:<span style="font-size:12px;">
               <?php echo(strtoupper($row['contact_name'])) ?></span> </h3>
                <div class="timeline-body">
				<table class="table table-border">
					<tr style="background:#5C5556;color:white;border:1px solid">
						<th width="15%" style="text-align: left;">Date</th>
						<th width="35%" style="text-align: center">Spo Conversation</th>
						<th width="15%" style="text-align: left">Date</th>
						<th width="35%" style="text-align: center">Client Feed Back</th>
					</tr>
					<?php 
				$lcon_q=$cm->selectMultiData("lead_conservation.comment, client_feedback.feedback, lead_conservation.con_date, client_feedback.feedback_date", "lead_conservation left join client_feedback on lead_conservation.lead_id=client_feedback.leadId", "lead_id=".$row['leadId']."");
				while($lRow=$lcon_q->fetch_assoc()){
						echo '<tr style="border-top:1px solid #000">
							<td>'.$lRow['con_date'].'</td>
							<td>'.$lRow['comment'].'</td>
							<td>'.$lRow['feedback_date'].'</td>
							<td>'.$lRow['feedback'].'</td>
						</tr>';
					} ?>
				</table>
				</div>
                <!--<div class="timeline-footer"> <strong>Contact Name:</strong> '.$lrow['contact_name'].' </div>-->
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
          </ul>
          <?php } ?>
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
