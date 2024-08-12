<?php
require_once'../../inc.func.php';
session_start();
if(!empty($_POST['doc_name']) && !empty($_POST['alert_date']))
{
	$post_data=$_POST;
	$post_data['status']='pending';
	$post_data['branch_id']=$_SESSION['branch_id'];
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$id=$_POST['id'];
		$cm->update_array("office_doc_alerts",$post_data, "id=".$id."");
	}
	else
	{

	 $query=$cm->insert_array("office_doc_alerts", $post_data);
	 if($query==1){}
	 else{echo "2"; exit(); }
	}
}
$data=""; $count=1; $docId="";
$result=$cm->selectData("office_doc_alerts","1");
while($row=$result->fetch_assoc())
{
	$docId=$row['id'];
	$data.='<tr id="'.$row['id'].'" class="'.(($row['status']=='process')?'warning':"").' '.(($row['status']=='pending')?'':"").'">
			 <td>'.$count++.'</td>
			 <td>'.$row['doc_name'].'</td>
			 <td>'.$row['doc_type'].'</td>
			 <td>'.$row['alert_date'].'</td>
			 <td>'.$row['due_date'].'</td>
			 <td>'.$row['exp_date'].'</td>
			 <td>'.$row['rec_email'].'</td>
			 <td>'.$row['status'].'</td>
			 <td>
              <a class="btn btn-app btn-xs" href="javascript::void(0)" onclick="edit_off_doc('.$row['id'].')"><i class="fa fa-edit"></i></a>
              <a class="btn btn-app btn-xs" href="javascript::void(0)" onclick="del_rec(\'../\', \'off_doc\', \''.$row['id'].'\')"><i class="fa fa-trash"></i></a>
			 </td>
		</tr>';
}
$data.=$cm->nothing_found($docId, 8);
echo $data;
?>