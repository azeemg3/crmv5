<?php
require_once'../../inc.func.php';
$result=$cm->selectMultiData("sms_schedule.*, e_mark_groups.group_name, user.name AS userName", "sms_schedule INNER JOIN  e_mark_groups ON sms_schedule.group_id=e_mark_groups.group_id
INNER JOIN user ON sms_schedule.userId=user.id
", "1");
$data=""; $count=1; $id="";
while($row=$result->fetch_assoc())
{
	$id=$row['id'];
	$data.='
		<tr id="'.$row['id'].'">
		 <td>'.$count++.'</td>
		 <td>'.$row['group_name'].'</td>
		 <td>'.$row['status'].'</td>
		 <td>'.$row['message'].'</td>
		 <td>'.$row['userName'].'</td>
		 <td>'.$row['total_sms'].'</td>
		 <td>'.$row['schedule_date'].' '.$row['schedule_hour'].':  '.$row['schedule_minute'].' '.$row['schedule_format'].'</td>
		 <td>
		 	<a class="btn btn-default btn-sm" onClick="del_rec(\'../../\', \'smsScheduleList\', \''.$row['id'].'\')"><i class="fa fa-trash"></i></a>
		 </td>
		</tr>
	';
}
$data.=$cm->nothing_found($id, 7);
echo $data;
?>