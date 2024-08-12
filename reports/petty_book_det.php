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
	$queryAI=$reports->selectData("pettycashin", "STR_TO_DATE(pettycashin.pettyIn_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$date', '%d-%m-%Y') AND STR_TO_DATE('$date', '%d-%m-%Y ') AND branch=".$branch."");
	while($row=mysql_fetch_array($queryAI))
	{
		$amountIN_data.='
						<tr>
							<td>'.$reports->u_value("user", "name", "id=".$row['userId']."").'</td>
							<td>'.$row['pettyIn_date'].'</td>
							<td>'.$row['payment_type'].'</td>
							<td>'.$row['recieve'].' C/O '.$row['refrence'].' RN:'.$row['id'].' LID:'.$row['leadId'].'</td>
							<td>'.$row['amount'].'</td>
						</tr>
						';
	}
	// cash out
	$queryAO=$reports->selectData("pettycashout", "STR_TO_DATE(pettycashout.pettyOut_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$date', '%d-%m-%Y') AND STR_TO_DATE('$date', '%d-%m-%Y ' ) AND  branch=".$branch."");
	while($row=mysql_fetch_array($queryAO))
	{
		$amountOUT_data.='
						<tr>
							<td>'.$reports->u_value("user", "name", "id=".$row['userId']."").'</td>
							<td>'.$row['pettyOut_date'].'</td>
							<td></td>
							<td>'.$row['pettyOut_details'].'</td>
							<td>'.$row['pettyOut_amountOut'].'</td>
						</tr>
						';
	}
	$queryDB=$reports->selectData("close_pettycashbook", "close_date='".$date."' AND branch=".$branch."");
	$rowDB=mysql_fetch_array($queryDB);
	$closeDB.='
				<tr>
					<td>'.$rowDB['brought_farword'].'</td>
					<td>'.$rowDB['petty_cashIn'].'</td>
					<td>'.$rowDB['petty_cashOut'].'</td>
					<td>'.$rowDB['petty_clsoingAmount'].'</td>
				</tr>
				';
	
echo $date,",".$branchName,",".$amountIN_data,",".$amountOUT_data,",".$closeDB;
}
else 
{
	echo "<h3>Day Book Does Not Exist</h3>";
}
?>
