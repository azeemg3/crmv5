<?php
require_once'../../inc.func.php';
if(isset($_GET['type']) && !empty($_GET['type']))
{
	$type=$_GET['type']; $id=$_GET['id'];
	if($type=='ticket')
	{
		$result=$cm->selectData("add_sale", "id=".$id."");
		$row=$result->fetch_assoc();
		echo '
			<tr><th>Branch</th><td>'.$cm->u_value('branches', 'branch_name', 'branch_id='.$row['branch'].'').'</td></tr>
			<tr><th>Sale Staff</th><td>'.$cm->u_value('user', 'name', 'id='.$row['salesStaff'].'').'</td></tr>
			<tr><th>Date Of Issue</th><td>'.$row['issue_date'].'</td></tr>
			<tr><th>Gds</th><td>'.$row['gds'].'</td></tr>
			<tr><th>Other Stock</th><td>'.$row['stock_used'].'</td></tr>
			<tr><th>Vendor</th><td>'.$cm->u_value('vendors', 'vendor_name', 'vendor_id='.$row['vendor_id'].'').'</td></tr>
			<tr><th>Other Stock Details</th><td>'.$row['other_stack'].'</td></tr>
			<tr><th>Ticket No</th><td>'.$row['airline_code'].'-'.$row['ticket_no'].'</td></tr>
			<tr><th>Sector</th><td>'.$row['sector'].'</td></tr>
			<tr><th>Passenger Name</th><td>'.$row['passName'].'</td></tr>
			<tr><th>Phone</th><td>'.$row['phone'].'</td></tr>
			<tr><th>Passenger Type</th><td>'.$row['passType'].'</td></tr>
			<tr><th>Received</th><td>'.$row['recieved'].'</td></tr>
			<tr><th>Net Cost</th><td>'.$row['netCost'].'</td></tr>
			<tr><td colspan="2">A/c Details: '.$row['accDetails'].'</td></tr>
			';
	}
	elseif($type=='other_sale')
	{
		$result=$cm->selectData("other_sale", "id=".$id."");
		$row=$result->fetch_assoc();
		echo'
			<tr>
				<th>Branch</th><td>'.$cm->u_value("branches","branch_name", "branch_id=".$row['branch']."").'</td>
			</tr>
			<tr>
				<th>Spo</th><td>'.$cm->u_value("user","name","id=".$row['userId']."").'</td>
			</tr>
			<tr>
				<th>Date Of Issue</th><td>'.$row['issue_date'].'</td>
			</tr>
			<tr>
				<th>Stock Used</th><td>'.$row['stock_used'].'</td>
			</tr>
			<tr>
				<th>Service Type</th><td>'.$row['ser_type'].'</td>
			</tr>
			<tr>
				<th>Passport Number</th><td>'.$cm->emptyWord($row['passport_num']).'</td>
			</tr>
			<tr>
				<th>Sales Details</th><td>'.$cm->emptyWord($row['sales_detail']).'</td>
			</tr>
			<tr>
				<th>Passenger Name</th><td>'.$cm->emptyWord($row['passName']).'</td>
			</tr>
			<tr>	
				<th>Phone Number</th><td>'.$cm->emptyWord($row['phone']).'</td>
			</tr>
			<tr>
				<th>Passenger Type</th><td>'.$cm->emptyWord($row['passType']).'</td>
			</tr>
			<tr>
				<th>Received</th><td>'.$cm->emptyWord($row['recieved']).'</td>
			</tr>
			<tr>
				<th>Net Cost</th><td>'.$cm->emptyWord($row['netCost']).'</td>
			</tr>
			<tr>
				<th>A/C Details</th><td>'.$cm->emptyWord($row['accDetails']).'</td>
			</tr>
			';
	}
	elseif($type=='refund')
	{
		$result=$cm->selectData("refund", "id=".$id."");
		$row=$result->fetch_assoc();
		echo '
			<tr>
				<th>Received From</th><td>'.$cm->emptyWord($row['recFrm']).'</td>
			</tr>
			<tr>
				<th>Phone</th><td>'.$cm->emptyWord($row['phone']).'</td>
			</tr>
			<tr>
				<th>Ticket No</th><td>'.$cm->emptyWord($row['airline_code'].'-'.$row['ticket_no']).'</td>
			</tr>
			<tr>
				<th>Passenger Name</th><td>'.$cm->emptyWord($row['passName']).'</td>
			</tr>
			<tr>
				<th>Sectors</th><td>'.$cm->emptyWord($row['sector']).'</td>
			</tr>
			<tr>
				<th>Refund Sector</th><td>'.$cm->emptyWord($row['refund_sec']).'</td>
			</tr>
			<tr>
				<th>Airline Vendor</th>
				<td>'.$cm->emptyWord($cm->u_value("airline_list","airline_name","airline_id=".$row['airline_id']."")).'</td>
			</tr>
			<tr>
				<th>Refund Type</th><td>'.$cm->emptyWord($row['ref_type']).'</td>
			</tr>
			<tr>
				<th>Refund Amount</th><td>'.$cm->emptyWord($row['net']).'</td>
			</tr>
			<tr>
				<th>Services Charges</th><td>'.$cm->emptyWord($row['services_charges']).'</td>
			</tr>
			<tr>
				<th>Remarks</th><td>'.$cm->emptyWord($row['remark']).'</td>
			</tr>
			';
	}
}
?>