<?php
require_once'../inc.functions.php';
$reports=new account();
$amountIN_data="";
$amountOUT_data="";
$closeDB="";
if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_GET['branch']))
{
	$date=$_GET['date'];
	$branch=$_GET['branch'];
	$branchName=$reports->u_value("branches", "branch_name", "branch_id=".$branch."");
	//cash in 
	$queryAI=$reports->selectData("payment_reciept", "app_date='".$date."' AND branch=".$branch."");
	$queryAI2=$reports->selectData("paymentin", "STR_TO_DATE(paymentin.create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$date', '%d-%m-%Y') AND STR_TO_DATE('$date', '%d-%m-%Y ') AND branch=".$branch."");
	while($row=mysql_fetch_array($queryAI))
	{
		$amountIN_data.='
						<tr>
							<td>'.$reports->u_value("user", "name", "id=".$row['app_by']."").'</td>
							<td>'.$row['create_date'].'</td>
							<td>'.$row['payment_type'].'</td>
							<td>'.$row['recieve'].' C/O '.$row['refrence'].' RN:'.$row['id'].' LID:'.$row['leadId'].'</td>
							<td>'.$row['amount'].'</td>
						</tr>
						';
	}
	while($row=mysql_fetch_array($queryAI2))
	{
		$amountIN_data.='
						<tr>
							<td>'.$reports->u_value("user", "name", "id=".$row['userId']."").'</td>
							<td>'.$row['create_date'].'</td>
							<td>'.$row['pay_type'].'</td>
							<td>'.$row['details'].'</td>
							<td>'.$row['amount'].'</td>
						</tr>
						';
	}
	// cash out
	$queryAO=$reports->selectData("refund_payment", "app_date='".$date."' AND  branch=".$branch."");
	$queryAO2=$reports->selectData("paymentout", "STR_TO_DATE(paymentout.pay_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$date', '%d-%m-%Y') AND STR_TO_DATE('$date', '%d-%m-%Y ' ) AND  branch=".$branch."");
	while($row=mysql_fetch_array($queryAO))
	{
		$amountOUT_data.='
						<tr>
							<td>'.$reports->u_value("user", "name", "id=".$row['app_by']."").'</td>
							<td>'.$row['pay_date'].'</td>
							<td>'.$row['payment_to'].' C/O '.$row['refrence'].' RN:'.$row['id'].' LID:'.$row['leadId'].'</td>
							<td>'.$row['recieve'].' C/O '.$row['refrence'].' RN:'.$row['id'].' LID:'.$row['leadId'].'</td>
							<td>'.$row['amount'].'</td>
						</tr>
						';
	}
	while($row=mysql_fetch_array($queryAO2))
	{
		$amountOUT_data.='
						<tr>
							<td>'.$reports->u_value("user", "name", "id=".$row['userId']."").'</td>
							<td>'.$row['pay_date'].'</td>
							<td>'.$row['pay_type'].'</td>
							<td>'.$row['detail'].'</td>
							<td>'.$row['amount'].'</td>
						</tr>
						';
	}
	$queryDB=$reports->selectData("day_book", "closing_date='".$date."' AND branch=".$branch."");
	$rowDB=mysql_fetch_array($queryDB);
	$closeDB.='
				<tr>
					<td>'.$rowDB['brought_farword'].'</td>
					<td>'.$rowDB['amountIn'].'</td>
					<td>'.$rowDB['amountOut'].'</td>
					<td>'.$rowDB['closing_balance'].'</td>
				</tr>
				';
	
echo $date,",".$branchName,",".$amountIN_data,",".$amountOUT_data,",".$closeDB;
}
else 
{
	echo "<h3>Day Book Does Not Exist</h3>";
}
?>
