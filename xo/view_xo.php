<?php
require_once'../inc.functions.php';
require_once'../session.php';
$c_m=new crm();
$query=$c_m->selectData("branches", "branch_id=".$user_branch."");
$branch_data=mysql_fetch_array($query);
if(isset($_GET['xoId']))
{
	$xoId=$_GET['xoId'];
	//xo sale query 
	$x_s_q=$c_m->selectData("xo_sale", "id=".$xoId."");
	$row=mysql_fetch_array($x_s_q);
	
}
?>
<link href="../css/printXo.css" type="text/css" rel="stylesheet">
<style type="text/css" media="print">
@media print{

		table { width:95% !important;}
body{ font-size:12px; width:100%; margin:0 auto;}
.tr{ border-bottom:1px dotted black;}
.tr td{ text-align:center !important;}
.tr:last-child{ border-bottom:none;}
th{ padding:2px !important; background:#999; font-weight:normal;}
.in_table{ border:0px !important;}
button{ display:none;}
#wrapper

{
	width:900px;

	height:auto;

	margin:auto;

}
}
</style>
<style>
#myDiv {
    width: 300px;
    height: 100px;
    position: absolute;
    font-size: 60px;
    font-weight: bold;
    top: 42%;
    left: 46%;
    opacity: 0.2;
}
#myDiv {
    -webkit-transform: rotateZ(90deg); /* Safari */
    transform: rotateZ(50deg); /* Standard syntax */
}
</style>
<script type="text/javascript">
function prit_div()
{
	window.location=window.print();
	setTimeout(function() {window.close();},1);
}
</script>
<title>View Xo</title>
<div id="print">
<div id="wrapper">
<?php if($row['status']=="approved") { ?>
<div id="myDiv">Approved</div>
<?php } else { ?>
<div id="myDiv">unapproved</div>
<?php } ?>
<div id="header">
        	<div id="tvt"><img src="../branch_logo/<?php echo $branch_data['branch_logo'] ?>"></div>
            <div id="header-mid">
            	<div id="txt"><?php echo strtoupper($branch_data['branch_name']) ?></div>
                <p align="center"><?php echo nl2br($branch_data['address']) ?>
                      
    			</p>
            </div>
            <!--<div id="iata"></div>-->
        </div>
        <!--header-->
        <hr />
        <div id="exchange">Exchange Order</div>
        <div>
        </div>
        <div class="content">
        	<table align="center">
            	<tbody><tr height="30px">
                	<td width="80px">M / s &nbsp;:</td>
                    <td width="420px" bgcolor="#CCCCCC"><?php echo $row['suppl_name'] ?> </td>
                    <td width="80px">Serial No.</td>
                    <td width="420px" bgcolor="#CCCCCC"><?php echo $row['id'] ?></td>
                </tr>
                <tr height="30px">
                	<td>Date &nbsp;:</td>
                    <td><?php echo $c_m->today(); ?></td>
                </tr>
            </tbody></table><br><hr><br>
            <span>Please issue Tickets to the following Passanger's</span><br><br>
            	<div class="passcontainer" style="height:">
                	<!-- passanger name-->
                    <?php $p_x_q=$c_m->selectData("xo_passenger", "xoId=".$row['id'].""); 
					while($p_row=mysql_fetch_array($p_x_q))
					{
					?>
					<div class="passName"><?php echo $p_row['id'] ?>.&nbsp;<?php echo $p_row['passName'] ?></div>
                    <?php } ?>
		        </div>
                <!-- passcontainer -->
        </div>
        <!--content-->
        <div id="content_main">
        	<table border="1px" style="text-align:center;">
        		<tbody><tr height="40px" style="font-size:18px;">
            		<td width="150px">Routing</td>
                    <td>Date</td>
                    <td>Fare Basis</td>
                    <td>Dep Time</td>
                    <td>Arrival Time</td>
                	<td width="100px">Carrier</td>
                	<td width="100px">Flight No</td>
                	<td width="100px">Class</td>
                	<td width="100px">Airline Data</td>
                	<td width="100px">STATUS</td>
            	</tr>
                <?php
					// xo flight details
					$x_f_q=$c_m->selectData("xo_flight_detail", "xoId=".$row['id']."");
					while($f_row=mysql_fetch_array($x_f_q))
					{
				  ?>
                    <tr height="30px">
                            <td><?php echo $f_row['flight_frm'] ?>-<?php echo $f_row['flight_to'] ?></td>
                            <td><?php echo $f_row['xo_date'] ?></td>
                            <td><?php echo $f_row['fare_bais'] ?></td>
                            <td><?php echo $f_row['dep_time'] ?></td>
                            <td><?php echo $f_row['ar_time'] ?></td>
                            <td><?php echo $f_row['carrier'] ?></td>
                            <td><?php echo $f_row['flightNo'] ?></td>
                            <td><?php echo $f_row['class'] ?></td>
                            <td><?php echo $f_row['airLine_data'] ?></td>
                            <td><?php echo $f_row['status'] ?></td>
                   </tr>
                   <?php } ?>
	        	</tbody></table><br><br>
           <table border="1px" style="text-align:center; width:100%;">
            	<tbody><tr height="40px" bgcolor="#CCCCCC">
                    <td colspan="8" style="font-size:24px;">TAXES</td>
                </tr>
                <tr height="40px" style="font-size:18px;">
                	<td>TAX 1 / SP</td>
                    <td>TAX 2 / RG</td>
                    <td>TAX 3 / YQ</td>
                    <td>TAX 4 / YR</td>
                    <td>TAX 5 / XT</td>
	                <td>Total Taxes</td>
                </tr>
               <tr height="30px">
                	<td><?php echo $row['tax1'] ?></td>
                    <td><?php echo $row['tax2'] ?></td>
                    <td><?php echo $row['tax3'] ?></td>
                    <td><?php echo $row['tax4'] ?></td>
                    <td><?php echo $row['tax5'] ?></td>
                    <td><?php echo $row['tax1']+$row['tax2']+$row['tax3']+$row['tax4']+$row['tax5'] ?></td>
                </tr>
                <tr height="40px" bgcolor="#CCCCCC">
                	<td colspan="6" style="font-size:24px;">FARES</td>
                </tr>
                <tr>
                	<td>BASIC FARE</td>
                	<td width="167.67px">TOTAL</td>
                    <td width="167.67px">INCENTIVE</td>
                    <td width="167.67px">COMM</td>
                    <td width="167.67px">NET PAYABLE</td>
                    <td colspan="2" style="font-size:18px;">GRAND TOTAL:</td>
                </tr>
                <tr height="30px">
                	<td><?php echo $row['basic_fare'] ?></td>
                	<td><?php echo $row['total'] ?></td>
                    <td><?php echo $row['incentive'] ?></td>
                    <td><?php echo $row['commission'] ?></td>
                    <td><?php echo $row['net_payable'] ?></td>
                    <td colspan="2"><?php echo $row['net_payable']  ?></td>
                </tr>
            </tbody></table>
        </div>
        <br><br>
        <button type="submit" class="btn btn-default btn-sm button" onClick="prit_div()" style="margin-top:25px;">
          	<span class="glyphicon glyphicon-print"></span> Print
        	</button>
        <!-- content-main-->
	</div>
    <!--wrapper-->
</div>
<!--pirnter-->
