<?php
require_once'../inc.func.php';
session_start();
$branch_data=Null; $data="";
$sWhere=""; $whereArr=array(); $id="";
if(isset($_POST['per_page']) && !empty($_POST['per_page']))
{
	$per_page=$_POST['per_page'];
}
else{ 
$per_page=10;
}
$page=1;
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
if(isset($_POST))
{
	if(!empty($_POST['df'])) $whereArr[]="STR_TO_DATE(client_feedback.feedback_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$_POST['df']."', '%d-%m-%Y') AND STR_TO_DATE('".$_POST['dt']."', '%d-%m-%Y ')";
	if(!empty($_POST['spo'])) $whereArr[]="lead.spo=".$_POST['spo']."";
	else $whereArr[]="1";
	$sWhere=implode(" AND ", $whereArr);
}
$result=$cm->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$result->fetch_assoc();
//===============fetch feedback data
$query=$cm->selectMultiData("client_feedback.id,client_feedback.feedback, client_feedback.feedback_date,client_feedback.lead_to,lead.contact_name,lead.status,client_feedback.leadId, lead.create_date,  user.name", "client_feedback 
INNER JOIN lead ON client_feedback.leadId=lead.id
INNER JOIN user ON client_feedback.lead_to=user.id
", "{$sWhere} ORDER BY id DESC");
while ($row=$query->fetch_assoc()) 
{
	$id=$row['id'];
	$data.='<tr>
			<td>'.$row['leadId'].'</td>
			<td>'.strtoupper($row['contact_name']).'</td>
			<td>'.strtoupper($row['name']).'</td>
			<td>'.ucfirst($row['status']).'</td>
			<td>'.$row['create_date'].'</td>
			<td>'.$row['feedback'].'</td>
			<td>'.$row['feedback_date'].'</td>
			<td>'.$cm->work_sicne($row['create_date']).'</td>
	</tr>';
}
?>
<link href="../bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function print_data() {
		window.print();
		setTimeout(function() {window.close();},0);
	};
</script>
<style media="print">
@page {
 size: auto;
 margin:0;
}
table {
	font-size: 12px;
}
tr{ background-color:#006; }
</style>
<title>Print Feedbacks</title>
<body onLoad="print_data()">
<div id="print_data">
	<div id="wrapper">
		<div id="header">
      		<div id="tvt"><img src="../branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
      		<div id="header-mid">
        	<div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
        	<p align="center"><?php echo nl2br($branch_data['address']) ?> </p>
      		</div>
    	</div><!--header-->
    <hr />
    <p align="center">
    	Feedbacks for the period From: <?php echo $_POST['df'] ?> <strong>To</strong>  <?php echo $_POST['dt'] ?>
    </p>
    <div id="exchange"></div>
    <br>
    <span style="float:left;">Printy By: <?php echo $cm->u_value("user","name","id=".$_SESSION['sessionId']."") ?></span> <span style="float:right;">Print Date: <?php echo $cm->current_dt(); ?></span>
    <table border="1" align="center" width="95%" style="border-collapse:collapse;1px solid #f4f4f4; font-size:12px; text-align:center;">
        <thead>
          <tr role="row">
            <th>Lead Id</th>
            <th>Customer Name</th>
            <th>Spo</th>
            <th>Status</th>
            <th>Create Date</th>
            <th>Feedback</th>
            <th>Feedback Time</th>
            <th>Working Since</th>
          </tr>
        </thead>
        <tbody><?php echo $data; ?></tbody>                  
      </table>
	</div>
    <br><br>
     <p style="float:left">Created By:______________________</p>
     <p style="float:right">Checked By:______________________</p>
</div>