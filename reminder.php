<?php 
require_once'inc.func.php';
$cm->get_header("")
?>
<script>
document.title='Reminder';
</script>
<div class="content-wrapper">
<section class="content-header" style="padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
<section class="content">
<h2 class="text-center bg-green-gradient" style="margin:0px;padding:10px 0px;">
<span class="main-heading">Reminder List</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  <div class="table-responsive">
  <table class="table table-bordered table-striped test">
      <tr class="bg-green-gradient" style="box-shadow:0px 0 1px #777 inset;">
            	<th>#</th>
                <th width="15%">Receipient Emai</th>
                <th width="15%">Reminder Time</th>
                <th width="15%">Date Created</th>
                <th>Status</th>
                <th>Message</th>
                <th>Created By</th>
                <th width="10%">Action</th>
            </tr>
    </thead>
    <tr>
    <td class="load" align="center" colspan="10"></td>
    </tr>
   <?php
	$query=$cm->selectMultiData("user.name, reminder.*", " reminder INNER JOIN user ON user.id=reminder.userId", "userId=".$_SESSION['sessionId']."");
	$count=1;
	while($row=$query->fetch_assoc())
	{
	echo "
		<tr id='".$row['id']."'>
			<td>".$count++."</td>
			<td>".$row['rec_email']."</td>
			<td>".$row['reminder_date']." ".$row['reminder_time']." ".$row['reminder_min']. " " .$row['reminder_format']."</td>
			<td>".$row['create_date']."</td>
			<td>".$row['status']."</td>
			<td>".$row['message']."</td>
			<td>".$row['name']."</td>
			<td>
			<a class='btn btn-default btn-sm' href='create_reminder?id=".$row['id']."'>
				<span class='glyphicon glyphicon-edit'></span>
			</a> 
			<a class='btn btn-default btn-sm' onclick='del_rec(\"\",\"reminder\", \"".$row['id']."\")')>
				<span class='glyphicon glyphicon-remove'></span>
			</a></td>
		</tr>
		";
	}
	?>
    </table>
    </form>
  </div>
</div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<?php $cm->get_footer("") ?>