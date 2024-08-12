<?php
require_once'../inc.func.php';
session_start();
$data="";$count=1; $id=""; $total_rec=0;
$whereArr=array();
$sWhere="";
if(isset($_GET['page']))
{
	$page=$_GET['page'];
}
else
{
	$page=1;
}
if(isset($_POST['per_page']) && !empty($_POST['per_page']))
{
	$per_page=$_POST['per_page'];
}
else{ 
$per_page=10;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
if(isset($_POST))
{
	$spo=$_POST['spo'];
	if(isset($_POST['branch'])){
	$branch=$_POST['branch'];}
	if(!empty($_POST['date_frm']) && !empty($_POST['date_to']))
	{
		$df=date('Y-m-d', strtotime( $_POST['date_frm'] ));
		$dt=date('Y-m-d', strtotime( $_POST['date_to'] ));
	}
	if(!empty($spo)) $whereArray[]="address_book.userId=".$spo."";
	if(!empty($branch)) $whereArray[]="address_book.branch_id=".$branch."";
	if(!empty($df) && !empty($dt)) $whereArray[]="STR_TO_DATE(address_book.cur_date, '%Y-%m-%d') BETWEEN  STR_TO_DATE('$df', '%Y-%m-%d') AND STR_TO_DATE('$dt', '%Y-%m-%d')";
	$sWhere=implode(" AND ", $whereArray);
}
$result=$cm->selectMultiData("address_book.cur_date AS add_date, address_book.pros_tech, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "{$sWhere} ORDER BY address_book.address_id DESC LIMIT $start, $per_page");
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$total_rec=+$count;
	$data.='<tr>
				<td>'.$count++.'</td>
				<td>'.$row['add_date'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$cm->emptyWord($row['mobile']).'</td>
				<td>'.$cm->emptyWord($row['email']).'</td>
				<td>'.$cm->emptyWord($row['pros_tech']).'</td>
				<td>'.$cm->emptyWord(ucwords($row['gender'])).'</td>
				<td>'.$cm->emptyWord($cm->u_value("ab_bus_info", "bus_type", "address_id=".$row['address_id']."")).'</td>
				<td>'.$cm->emptyWord($row['area']).'</td>
			</tr>
		';
}$query=$cm->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
$branch_data=$query->fetch_assoc();
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
  margin:1 auto;
       }
table{ font-size:12px;}
</style>
<title>Print BDE Report (<?php echo $cm->u_value("user", "name", "id=".$spo.""); ?>)</title>
<body onLoad="print_data()">
<br><br>
<div id="print_data">
<div id="wrapper">
<div id="header">
        	<div id="tvt"><img src="../branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
            <div id="header-mid">
            	<div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
                <p align="center"><?php echo nl2br($branch_data['address']) ?>
                      
    			</p>
            </div>
            <!--<div id="iata"></div>-->
        </div>
        <h3 align="center">BDE Report (<?php echo $cm->u_value("user", "name", "id=".$spo.""); ?>)</h3>
        <?php if(!empty($_POST['date_frm']) && !empty($_POST['date_to'])){ ?>
        <div align="center">Date From: <?php echo $_POST['date_frm'] ?> To: <?php echo $_POST['date_to'] ?></div>
        <?php } ?>
        <hr />
        <div id="exchange"></div>
        <span>Total Records: <?php echo $total_rec; ?></span>
        <span style="float:right;">Print Date: <?php echo $cm->current_dt(); ?></span>
  <table border="" align="center" width="100%" style="border-collapse:collapse; font-size:13px; text-align:center">
  	<thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
      	<td>#</td>
        <td>Date</td>
        <th>Name</th>
        <td>Phone</td>
        <td>Email</td>
        <td>Tech</td>
        <td>Gender</td>
        <td>Customer Type</td>
        <td>Area</td>
    </tr>
  </thead>
    <?php echo $data; ?>
    </table>
</div>
</div>