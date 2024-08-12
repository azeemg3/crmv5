<?php require_once'inc.func.php';
date_default_timezone_set('Asia/karachi');
$result=$cm->selectData("user","branch_id=1 AND status='active'");
 ?>
<!DOCTYPE html>
<html>
<head>
<style media="all">
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
	text-align:center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>
<?php
	$data=""; $total=0; $tt=0;$tv=0; $ttour=0; $tref=0; $tpsf=0; $ttotal=0; $Emessaage_spo="";
	while($row=$result->fetch_assoc())
	{
		$ticket=$cm->u_total("add_sale","recieved","salesStaff=".$row['id']." AND STR_TO_DATE(issue_date, '%d-%m-%Y') 
				 BETWEEN  STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y')");
		$visa=$cm->u_total("other_sale","recieved","STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') 
		AND salesStaff=".$row['id']."");
		$tourSale=$tour->spo_t_t_inv($cm->today(),$cm->today(), $row['id']);
		$tr=$cm->u_total("refund", "net", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND STR_TO_DATE('".$cm->today()."', '%d-%m-%Y') AND userId=".$row['id']." 
		AND status='approved'")+$lead->spo_prev_psf($cm->today(), $cm->today(), $row['id']);
		$total=$ticket+$visa+$tourSale-$tr;
		if($total!=0)
		{
		$data.= '
				<tr style="text-align:center;">
				 <td>'.$row['name'].'</td>
				 <td>'.$cm->show_bal_format($ticket).'</td>
				 <td>'.$cm->show_bal_format($visa).'</td>
				 <td>'.$cm->show_bal_format($tourSale).'</td>
				 <td>'.$cm->show_bal_format($tr).'</td>
				 <td>'.number_format($total).'</td>
				</tr>			
			';
		}
		$tt+=$ticket;
		$tv+=$visa;
		$ttour+=$tourSale;
		$tref+=$tr;
		$ttotal+=$total;
		// spo wise dailsy sale report
		$Emessaage_spo='
		<html><body>
		 <head>
		 <style>
			#customers {
			    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			    border-collapse: collapse;
			    width: 100%;
			}

			#customers td, #customers th {
			    border: 1px solid #ddd;
			    padding: 8px;
				text-align:center;
			}

			#customers tr:nth-child(even){background-color: #f2f2f2;}

			#customers tr:hover {background-color: #ddd;}

			#customers th {
			    background-color: #4CAF50;
			    color: white;
			}
         </style>
		</head>
		<div style="width:100%; margin:auto; height:auto; font-family:Calibri;">
				<img src="https://crmv4.groupoperation.com/branch_logo/'.$cm->u_value("branches", "email_header", "status='active' AND branch_id=1").'" align="center" />
				<table rules="all" style="border-color: #666;" cellpadding="10" width="100%" border="1">
					<caption><h3>SPO DAILY SALE REPORT</h3></caption>
				  <tr style="background-color: #4CAF50;color: white;padding-top: 12px;padding-bottom: 12px;text-align:center;">
					<th>Spo Name ('.$total.')</th>
					<th>Ticket</th>
					<th>Visa</th>
					<th>Tour</th>
					<th>Refund</th>
					<th>Total</th>
				  </tr>
				 <tr style="text-align:center;">
					 <td>'.$row['name'].'</td>
					 <td>'.$cm->show_bal_format($ticket).'</td>
					 <td>'.$cm->show_bal_format($visa).'</td>
					 <td>'.$cm->show_bal_format($tourSale).'</td>
					 <td>'.$cm->show_bal_format($tr).'</td>
					 <td>'.number_format($total).'</td>
				</tr>
				'.(($total==0)?'
				    <tr>
				 <td colspan="6" align="center"><strong style="color:red;">Dear '.$row['name'].', Your Sale Balance is 0, Please Focus on Your performance and follow up to your pending Quries.........</strong></td>
				</tr>
				':"").'
				</table>

				</div>';
		if($cm->user_access("email_dsr",$row['id']))
		{
				$Eto_spo =$row['email'];
				$Esubject_spo="Daily Spo Sale Report";
				$Eheaders_spo="From: \"Sales\" <sales@toursvision.com>\r\n";
				$Eheaders_spo.="Reply-To:azeemkhalidg3@gmail.com,sales@toursvision.com\r\n";
				$Eheaders_spo.="MIME-Version: 1.0\r\n";
				$Eheaders_spo.="Content-Type: text/html; charset=ISO-8859-1\r\n";
				if(date('G')==23)
				{
					mail($Eto_spo, $Esubject_spo, $Emessaage_spo, $Eheaders_spo);
				}
		}//daily_der_auth
			
	}//while loop
	$data.='
		<tr style="text-align:center;">
		 <td></td>
		 <td><strong>'.$cm->show_bal_format($tt).'</strong></td>
		 <td><strong>'.$cm->show_bal_format($tv).'</strong></td>
		 <td><strong>'.$cm->show_bal_format($ttour).'</strong></td>
		 <td><strong>'.crm::show_bal_format($tref).'</strong></td>
		 <td><strong>'.crm::show_bal_format($ttotal).'</strong></td>
		</tr>
		';
$Emessage = '<html><body>
<head>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
	text-align:center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
';
$Emessage .= '
				<div style="width:100%; margin:auto; height:auto; font-family:Calibri;">
				<img src="https://crmv4.groupoperation.com/branch_logo/'.$cm->u_value("branches", "email_header", "status='active' AND branch_id=1").'" align="center" />
				<table rules="all" style="border-color: #666;" cellpadding="10" width="100%" border="1">
					<caption><h3>SPO DAILY SALE REPORT</h3></caption>
				  <tr style="background-color: #4CAF50;color: white;padding-top: 12px;padding-bottom: 12px;text-align:center;">
					<th>Spo Name</th>
					<th>Ticket</th>
					<th>Visa</th>
					<th>Tour</th>
					<th>Refund</th>
					<th>Total</th>
				  </tr>
				  '.$data.'
				</table>

</div>'.'<br>';
/*$Eto ='azeemkhalidg3@gmail.com,mazhar@toursvision.com';
$Esubject ="Daily Spo Sale Report";
$Eheaders ="From: \"Sales\" <sales@toursvision.com>\r\n";
$Eheaders .= "Reply-To:azeemkhalidg3@gmail.com,sales@toursvision.com\r\n";
$Eheaders .= "MIME-Version: 1.0\r\n";
$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if(date('G')==23)
{
	mail($Eto, $Esubject, $Emessage, $Eheaders);
}*/
	
?>

</body>
</html>
