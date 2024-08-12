<?php
require_once'../inc.functions.php';
require_once'../session.php';
$cm=new crm();
$data=$_POST;
if(!empty($_POST['job_title']) && !empty($_POST['description']))
{
$cm->insert_array("jobs", $data, "date, time, userId, branch, status", "'".$cm->today()."', '".date('h:i:s')."', '".$userSessionId."', '".$user_branch."', 'active'");

	echo '<script>
			alert("Operation Successfully");
			window.location="post_job";
		</script>
		';
}
else if(isset($_GET['dlt_rec']) && !empty($_GET['dlt_rec']))
{
	$dlt_rec=$_GET['dlt_rec'];
	$cm->delete("jobs","id=".$dlt_rec."");
}
else
{
echo '<script>
	alert("Something Wrong!")
	window.location="post_job";
</script>';
}

?>