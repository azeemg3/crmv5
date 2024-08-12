<?php
require_once'../../inc.func.php';
ob_start();
ob_clean();
session_start();
$db=$cm->db();
if(isset($_POST))
{
	$pkg_id=$_POST['pkg_id'];
	$data['cat_id']=$_POST['cat_id'];
	$data['thumb_details']=$_POST['thumb_details'];
	$data['makkah_hotels']=$_POST['makkah_hotels'];
	$data['madina_hotels']=$_POST['madina_hotels'];
	$data['terms_condtions']=mysqli_real_escape_string($db,$_POST['terms_condtions']);
	$data['status']='active';
	$data['create_date']=$cm->current_dt();
	$data['userId']=$_SESSION['sessionId'];
	$data['branch_id']=$_SESSION['sessionId'];
	$data['currency_type']=$_POST['currency_type'];
	if($pkg_id=='0' || $pkg_id=="")
	{
		$sql=$cm->u_insert_array("web_umrah_pkg", $data);
		$query=$db->query($sql);
		$insertId=$db->insert_id;
	}
	else
	{
		$query=$cm->update_array("web_umrah_pkg", $data, "pkg_id=".$pkg_id."");
		$cm->delete("web_umrah_pkg_det", "pkg_id=".$pkg_id."");
		$insertId=$pkg_id;
	}
	$count=count($_POST['pkg_duration']);
	$val="";
	if($query==1)
	{
		for($i=0; $i<$count; $i++)
		{
			if(!empty($_POST['pkg_duration'][$i]))
			{
			$val.="('".$_POST['pkg_duration'][$i]."', '".$_POST['makkah_night'][$i]."', '".$_POST['madina_night'][$i]."', '".$_POST['r_makkah_night'][$i]."',
			'".$_POST['sharing_price'][$i]."', '".$_POST['quad_price'][$i]."', '".$_POST['triple_price'][$i]."', '".$_POST['double_price'][$i]."', 
			'".$_POST['single_price'][$i]."', ".$insertId.")".",";
			}
		}
		$values=rtrim($val,",");
		$sql_det="INSERT INTO web_umrah_pkg_det (`pkg_duration`, `makkah_night`, `madina_night`, `r_makkah_night`, `sharing_price`, `quad_price`, `triple_price`, `double_price`, `single_price`, `pkg_id`) VALUES ".$values."";
		$result=$db->query($sql_det);
	}
}
if($query==1){ $_SESSION['msg']= $query;}
	elseif( $query==1062) { $_SESSION['msg']=$query; }
	else { $_SESSION['msg']='2'; }
	header("location:../addNewUmrah_pkg");
?>