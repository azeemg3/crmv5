<?php 
require_once'inc.func.php';
$cm->get_header("");
$id="";
if(!empty($_POST['message']) && !empty($_POST['reminder_date']))
{
	$data=$_POST;
	$id=$_POST['id'];
	if(empty($id) || $id==0)
	{
	$data['create_date']=$cm->current_dt();
	$data['status']='pending';
	$data['userId']=$_SESSION['sessionId'];
	$cm->insert_array("reminder", $data);
	}
	else
	{
		$data['create_date']=$cm->current_dt();
		$data['status']='pending';
		$data['userId']=$_SESSION['sessionId'];
		$cm->update_array("reminder", $data, "id=".$id."");
	}
	header("location:reminder");
	exit;
	
}
$row=NULL;
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$result=$cm->selectData("reminder", "id=".$id."");
	$row=$result->fetch_assoc();
}
?>
<script>
document.title='Create Reminder';
</script>
<body onLoad="loadpage()">
<div class="content-wrapper" id="loadpage">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
    <h2 style="margin:0px;padding:10px 0px;font-style:italic;"><span style="background: lightgray;
padding: 9px;" class="main-heading">Create Reminder</span></h2>
        <div class="panel panel-default col-lg-6 centered">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="panel-body">
            	<div class="col-md-4">
                	<div class="form-group">
                    	<label>Date</label>
                        <input type="text" name="reminder_date" class="form-control date input-sm" 
                        value="<?php echo $row['reminder_date']??"" ?>">
                    </div>
                </div>
                <!--col-lg-6-->
                <?php echo $cm->cron_time($row['reminder_time']??"", $row['reminder_min']??""); ?>
                <div class="col-md-6">
                	<div class="form-group">
                    	<label>Email</label>
                        <input type="text" name="rec_email" value="<?php echo $row['rec_email']??"" ?>" class="form-control input-sm" placeholder="Email">
                    </div>
                </div>
                <!--col-lg-6-->
                <div class="col-md-12">
                	<div class="form-group">
                    	<label>Reminder Message</label>
                        <textarea name="message" class="form-control input-sm"><?php echo $row['message']??"" ?></textarea>
                    </div>
                </div>
                <!--col-lg-6-->
                <div class="clearfix"></div>
                <div class="col-lg-12">
                	<input  type="submit" class="btn btn-success pull-right" 
                    value="<?php if(empty($id))echo 'Create'; else echo'Update' ?>" onClick="set_reminder()">
                    
                     <!--<input type="hidden" name="status" value="pending" />
                     <input  type="submit" class="btn btn-info pull-right" value="Update">--> 
 
              </div>
            </div>
            <!-- panel-body-->
            </form>
          </div>
          <!--panel-default-->
    </div>
    <!-- container-->
<?php 
$cm->get_footer("")
?>
