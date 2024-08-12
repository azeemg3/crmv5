<?php
require_once'../inc.func.php';
session_start();
if(!empty($_POST))
{
	if(!empty($_POST['spo'])) $whereArray[]="address_book.userId=".$_POST['spo']."";
	if(!empty($_POST['name'])) $whereArray[]="ab_personal_info.name LIKE '%".$_POST['name']."%'";
	if(!empty($_POST['phone'])) $whereArray[]="ab_personal_info.mobile= '".$_POST['phone']."'";
	if(!empty($_POST['email'])) $whereArray[]="ab_personal_info.email= '".$_POST['email']."'";
	$whereArray[]="ab_personal_info.mobile!=0 || ab_personal_info.email!=0 AND address_book.userId!=0";
	$sWhere = implode(" AND ", $whereArray);
}
else
{
	$sWhere="address_book.userId=".$_SESSION['sessionId']."";
}
$result=$cm->selectMultiData("address_book.*, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id","{$sWhere} LIMIT 500");
$data=""; $count=1;
$id="";
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$data.='<tr>
			<td>'.$row['cur_date'].'</td>
			<td>'.$cm->u_value("user","name","id=".$row['userId']."").'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['mobile'].'</td>
			<td>'.$row['email'].'</td>
			<td>'.$row['pros_tech'].'</td>
			<td>'.ucwords($row['gender']).'</td>
			<td>'.ucwords($row['area']).'</td>
		</tr>';
}
$query=$cm->selectData("branches", "branch_id=".$_SESSION['branch_id']."");
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
<title>Print Sale Report</title>
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
        <hr />
        <div id="exchange"></div>
  <table border="1" align="center" width="100%" style="border-collapse:collapse; font-size:12px;">
  	<thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
        <td>Date</td>
        <th>BDE</th>
        <td>Name</td>
        <td>Phone</td>
        <td>Email</td>
        <td>Tech</td>
        <td>Gender</td>
        <td>Area</td>
    </tr>
  </thead>
    <?php echo $data; ?>
    </table>
</div>
</div>