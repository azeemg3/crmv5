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
	$branch=$_POST['branch'];
	$spo=$_POST['spo'];
	if(!empty($branch)) $whereArr[]="address_book.branch_id=".$branch."";
	if(!empty($spo)) $whereArr[]="address_book.userId=".$spo."";
	$sWhere = implode(" AND ", $whereArr);
}
$result=$cm->selectMultiData("address_book.*, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "{$sWhere} GROUP BY address_book.userId");
while($row=$result->fetch_assoc())
{
	$id=$row['address_id'];
	$total_rec=+$count;
	$data.='<tr>
				<td>'.$count++.'</td>
				<td>'.$cm->u_value("user", "name", "id=".$row['userId']."").'</td>
				<td>'.$cm->u_value("branches", "branch_name", "branch_id=".$row['branch_id']."").'</td>
				<td>'.$cm->count_val("ab_personal_info","personal_id", "userId=".$row['userId']."").'</td>
			</tr>
			
		';
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
<title>Print BDE Report</title>
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
  <table border="" align="center" width="100%" style="border-collapse:collapse; font-size:12px; text-align:center">
  	<thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
      	<td>#</td>
        <td>BDE</td>
        <th>Branch</th>
        <td>Total Record</td>
    </tr>
  </thead>
    <?php echo $data; ?>
    </table>
</div>
</div>