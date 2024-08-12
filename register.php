<?php 
require_once'inc.func.php';
$cm->get_header("");
$cm->user_auth("accounts",$_SESSION['sessionId'], "");
$row=NULL;
$actions[]="";
$query="";
$email="";
if(isset($_POST) && !empty($_POST))
{
	$id=$_POST['id'];
	$actions=$_POST['actions'];
	$date_time=date("d-m-Y G:i:s");
	if(isset($_POST['password'])){ $password=md5($_POST['password']); }
	else { $password=$cm->u_value("user","password", "email='".$_POST['email']."'"); }
	$data=array("name, password, email, phone,skype_id, dep_id, date_created, status, branch_id, team_id, team_leader, spo_sale_target");
	$values=array($_POST['name'], $password, $_POST['email'], $_POST['mobile'], $_POST['skype_id'], 
	$_POST['dep_id'],date('d-m-Y G:i:s'),'active',$_POST['branch'], $_POST['team_id'], $_POST['team_leader'], $_POST['spo_sale_target']);
	$check_user_query=$cm->selectData("user", "email='".$_POST['email']."'");
	if($id=="" || $id==0){
		if($check_user_query->num_rows>=1)
	{
		echo '<div class="col-lg-5 col-md-6 col-sm-5 col-xs-offset-4" style="padding:2%;">
				<div class="alert alert-danger">
				<strong>Error!</strong> Thsis User Name is Already Exists.<a onclick=history.go(-1)>Go Back</a>
			  </div>  	
			</div>';
			exit();
	}
	$cm->insertData("user", $data, $values );
	$user_id=$cm->u_value("user", "id", "1 ORDER BY id DESC");
	foreach($actions as $actions)
	{
		//mysql_query("INSERT INTO action (action, date_created, user_id) VALUES('$actions', '$date_time', '$user_id')");
		$cm->insertData_multi("action", "action, date_created, user_id", "'$actions', '$date_time', '$user_id'");
	}
		$Ename = "Toursvision";
		$Emessage = '<html><body>';
		$Emessage .= '
		<h2>New user has been created.</h2>
		 User name = '.$_POST['email'] .'. <br> Password = '. $_POST['password'];
		$Emessage .= ' <br>
		Time: '.$date_time.' 
		</body></html>';
		$Eto = "muzhar@toursvision.com, azeemkhalidg3@gmail.com," . $_POST['email'];
		//$Eto = "m.imran.tariq@gmail.com";
		$Esubject = $Ename;
		$Eheaders = "From: \"toursvision.com\" <support@toursvision.com>\r\n";
		$Eheaders .= "Reply-To: \"toursvision.com\" <muzhar@toursvision.com>\r\n";
		$Eheaders .= "MIME-Version: 1.0\r\n";
		$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($Eto, $Esubject, $Emessage, $Eheaders);
	echo 
		"
			<script>alert('User Added Successfully Please visit your email for user name and Password');
			window.location='userlist';
			</script>
		";
		exit;
	}
	else
	{
		$values=array("name"=>$_POST['name'], "password"=>$password, "email"=>$_POST['email'],
		"phone"=>$_POST['mobile'], "skype_id"=>$_POST['skype_id'], "dep_id"=>$_POST['dep_id'], "date_modified"=>date('d-m-Y G:i:s'), "status"=>'active',  "branch_id"=>$_POST['branch'], "team_id"=>$_POST['team_id'], "team_leader_id"=>$_POST['team_leader_id'],"team_leader"=>$_POST['team_leader'], 
    "dep_id"=>$_POST['dep_id'], "spo_sale_target"=>$_POST['spo_sale_target']);
		foreach($values as $values=>$columns)
		{
			$query.=$values."='".$columns."',";
		}
		$query=rtrim($query, ",");
		$cm->update("user", $query, "id=".$id."");
		$cm->delete("action", "user_id=".$id."");
		foreach($actions as $actions)
	{
		//mysql_query("INSERT INTO action (action, date_created, user_id) VALUES('$actions', '$date_time', '$id')");
		$cm->insertData_multi("action", "action, date_created, user_id", "'$actions', '$date_time', '$id'");
	}
	echo '
	<script type="text/javascript">
				function move() {
			window.location = "userlist";
			$(".login-erro").fadeIn(fast).fadeOut(slow);
		}
			</script>
			<body onload="move()">
			<div class="col-lg-4 col-md-6 col-sm-4 col-xs-offset-4" style="padding:2%;">
				<div class="alert alert-success">
				  <strong>Success!</strong> User Updated Successfully.
				</div>  	
			</div>
			</body>
			
		';
		exit();
	}
}
else if(!empty($_GET['userid']))
{
	$id=$_GET['userid'];
	$query=$cm->selectData("user", "id=".$id."");
	$row=$query->fetch_assoc();
	$user_branch=$row['branch_id'];
	$action_query=$cm->selectData("action", "user_id=".$id."");
	while($action=$action_query->fetch_assoc())
	{
		$actions[]=$action['action'];
	}
}
?>
<body onLoad="loadpage()">
<div class="content-wrapper" id="loadpage">
  <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Add New User</span></h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="col-lg-12 col-sm-12 col-xs-12 row">
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" id="name" name="name" required value="<?php echo $row['name'] ?>" 
                         class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!--co-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Password: </label>
              <input type="password" name="password" required  class="form-control input-sm" <?php if(!empty($row['password'])){ echo ' style="display:none;" disabled'; } ?> id="password">
              <?php if(!empty($row['password'])) { ?>
              <input type="button" value="Change Password" class="form-control btn-warning btn-sm" style="margin-top:-5px;" />
              <?php } ?>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Email:</label>
              <input type="text" name="email" required value="<?php echo $row['email'] ?>" class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Mobile : </label>
              <input type="text" name="mobile"  required value="<?php echo $row['phone'] ?>" class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Skype Id : </label>
              <input type="text" name="skype_id" value="<?php echo $row['skype_id'] ?>" class="form-control input-sm">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Department: </label>
              <select class="form-control input-sm" name="dep_id">
              	<?php echo $administrator->deparments(); ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Team Type: </label>
              <select class="form-control input-sm"   name="team_id">
                <option value="">Select Team</option>
                <?php echo $administrator->team_list($row['team_id']); ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Select Branch: </label>
              <select class="form-control input-sm" required  name="branch">
                <option value="">Select Branch</option>
                <?php echo $cm->branches($_SESSION['sessionId'], $_SESSION['branch_id']); ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Spo Sale Target: </label>
              <input type="text" name="spo_sale_target" class="form-control input-sm" value="<?php echo $row['spo_sale_target'] ?>">
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-lg-3 col-sm-6">
            <div class="form-group">
              <label>Team Leader: </label>
              <select class="form-control input-sm"   name="team_leader_id">
                <option value="">Select Leader</option>
                <?php echo $administrator->team_leaders($row['team_leader_id'], $_SESSION['branch_id']); ?>
              </select>
            </div>
            <!-- form--group--> 
          </div>
          <!-- col-lg-3-->
          <div class="col-md-3" style="margin-top:25px;">
          	<div class="form-group">
            	<label>Team Leader</label>
                <label class="checkbox-inline">
                	<input type="radio" name="team_leader" value="yes" <?php if($row['team_leader']=="yes") echo 'checked'; ?>> Yes
                </label>
                <label class="checkbox-inline">
                	<input type="radio" name="team_leader" value="no" <?php if($row['team_leader']=="no") echo 'checked'; ?>> No
                </label>
            </div>
          </div>
          <div class="clearfix"></div>
          <h3>Actions</h3>
          <div class="col-lg-12 col-xs-12 col-sm-12">
          <?php if($cm->user_access("adminstrator",$_SESSION['sessionId'])){  ?>
            <label class="checkbox-inline">
              <input type="checkbox" value="adminstrator" name="actions[]" <?php if(in_array('adminstrator', $actions)): echo ' checked="checked"'; endif; ?>>
              Administrator </label>
              <?php } ?>
            <label class="checkbox-inline">
              <input type="checkbox" value="createLead" name="actions[]" <?php if(in_array('createLead', $actions)): echo ' checked="checked"'; endif; ?>>
              Create Lead </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deleteLead" name="actions[]" <?php if(in_array('deleteLead', $actions)): echo ' checked="checked"'; endif; ?>>
              Delete Lead </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="editLead" name="actions[]" <?php if(in_array('editLead', $actions)): echo ' checked="checked"'; endif; ?>>
              Edit Lead </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="takeOverLead" name="actions[]" <?php if(in_array('takeOverLead', $actions)): echo ' checked="checked"'; endif; ?>>
              Take Over Lead </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="viewAllLeads" name="actions[]" <?php if(in_array('viewAllLeads', $actions)): echo ' checked="checked"'; endif; ?>>
              View All Leads </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="edit" name="actions[]" <?php if(in_array('edit', $actions)): echo ' checked="checked"'; endif; ?>>
              Edit </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="delete" name="actions[]" <?php if(in_array('delete', $actions)): echo ' checked="checked"'; endif; ?>>
              Delete </label>
          </div>
          <!--col-lg-12-->
          <div class="col-lg-12">
            <label class="checkbox-inline">
              <input type="checkbox" value="createUser" name="actions[]" <?php if(in_array('createUser', $actions)): echo ' checked="checked"'; endif; ?>>
              Create User </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deleteUser" name="actions[]" <?php if(in_array('deleteUser', $actions)): echo ' checked="checked"'; endif; ?>>
              Delete User </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="editUser" name="actions[]" <?php if(in_array('editUser', $actions)): echo ' checked="checked"'; endif; ?>>
              Edit User </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="setReminder" name="actions[]" <?php if(in_array('setReminder', $actions)): echo ' checked="checked"'; endif; ?>>
              Set Reminder </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="attendance" name="actions[]" <?php if(in_array('attendance', $actions)): echo ' checked="checked"'; endif; ?>>
              Attendance </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="branch_admin" name="actions[]" <?php if(in_array('branch_admin', $actions)): echo ' checked="checked"'; endif; ?>>
              Branch Admin </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="branch_id" name="actions[]" <?php if(in_array('branch_id', $actions)): echo ' checked="checked"'; endif; ?>>
              Branch </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="reports" name="actions[]" <?php if(in_array('reports', $actions)): echo ' checked="checked"'; endif; ?>>
              Reports </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="cms" name="actions[]" <?php if(in_array('cms', $actions)): echo ' checked="checked"'; endif; ?>>
              CMS </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="email_dsr" name="actions[]" <?php if(in_array('email_dsr', $actions)): echo ' checked="checked"'; endif; ?>>
              Email DSR </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="sale_posting" name="actions[]" <?php if(in_array('sale_posting', $actions)): echo ' checked="checked"'; endif; ?>>
              Sale Posting </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="reopenLead" name="actions[]" <?php if(in_array('reopenLead', $actions)): echo ' checked="checked"'; endif; ?>>
              Reopen Lead </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="transferLead" name="actions[]" <?php if(in_array('transferLead', $actions)): echo ' checked="checked"'; endif; ?>>
              Transfer Lead </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="lead-feedback" name="actions[]" <?php if(in_array('lead-feedback', $actions)): echo ' checked="checked"'; endif; ?>>
              Client Feedback </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="ticket_msg" name="actions[]" <?php if(in_array('ticket_msg', $actions)): echo ' checked="checked"'; endif; ?>>
              Ticket Message </label>
              <input type="checkbox" value="lead_his" name="actions[]" <?php if(in_array('lead_his', $actions)): echo ' checked="checked"'; endif; ?>>
              Lead History </label>
          </div>
          <!--col--lg-12-->
          <div class="clearfix"></div>
          <h3 style="border-top: 1px solid;padding-top: 15px;">E-Marketing</h3>
          <div class="col-lg-12 col-xs-12 col-sm-12">
            <label class="checkbox-inline">
              <input type="checkbox" value="E-marketing" name="actions[]" <?php if(in_array('E-marketing', $actions)): echo ' checked="checked"'; endif; ?>>
              E-Marketing </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="add-contact" name="actions[]" <?php if(in_array('add-contact', $actions)): echo ' checked="checked"'; endif; ?>>
              Add-Contact </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="lead-contact" name="actions[]" <?php if(in_array('lead-contact', $actions)): echo ' checked="checked"'; endif; ?>>
              Lead-Contact </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="send-email" name="actions[]" <?php if(in_array('send-email', $actions)): echo ' checked="checked"'; endif; ?>>
              Send Email </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="mobile-contact" name="actions[]" <?php if(in_array('mobile-contact', $actions)): echo ' checked="checked"'; endif; ?>>
              Mobile Contact </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="message-log" name="actions[]" <?php if(in_array('message-log', $actions)): echo ' checked="checked"'; endif; ?>>
              Message Log </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="e-ex-file" name="actions[]" <?php if(in_array('e-ex-file', $actions)): echo ' checked="checked"'; endif; ?>>
              Upload Excel File </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="all-emails" name="actions[]" <?php if(in_array('all-emails', $actions)): echo ' checked="checked"'; endif; ?>>
              All Emails</label>
          </div>
          <!--c0l-lg-12-->
          <div class="clearfix"></div>
          <h3 style="border-top: 1px solid;padding-top: 15px;">Accounts</h3>
          <div class="col-lg-12 col-xs-12 col-sm-1">
            <label class="checkbox-inline">
              <input type="checkbox" value="accounts" name="actions[]" <?php if(in_array('accounts', $actions)): echo ' checked="checked"'; endif; ?>>
              Accounts </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="branch-sale-report" name="actions[]" <?php if(in_array('branch-sale-report', $actions)): echo ' checked="checked"'; endif; ?>>
              Branch Sale Report </label>
              <label class="checkbox-inline">
              <input type="checkbox" value="account-setup" name="actions[]" <?php if(in_array('account-setup', $actions)): echo ' checked="checked"'; endif; ?>>
              A/C Setup</label>
              <label class="checkbox-inline">
              <input type="checkbox" value="account-spo" name="actions[]" <?php if(in_array('account-spo', $actions)): echo ' checked="checked"'; endif; ?>>
              A/C Spo</label>
          </div>
          <!-- col-lg-12-->
          <div class="clearfix"></div>
          <h3 style="border-top: 1px solid;padding-top: 15px;">Reports</h3>
          <label class="checkbox-inline">
            <input type="checkbox" value="branch-lead-report" name="actions[]" <?php if(in_array('branch-lead-report', $actions)): echo ' checked="checked"'; endif; ?>>
            Branch Lead Report </label>
          <label class="checkbox-inline">
            <input type="checkbox" value="branch-sale-report" name="actions[]" <?php if(in_array('branch-sale-report', $actions)): echo ' checked="checked"'; endif; ?>>
            Branch Spo Reports </label>
          <label class="checkbox-inline">
            <input type="checkbox" value="branch-account-report" name="actions[]" <?php if(in_array('branch-account-report', $actions)): echo ' checked="checked"'; endif; ?>>
            Branch Account Report </label>
          <div class="clearfix"></div>
          <h3 title="Human Resources Management" style="border-top: 1px solid;padding-top: 15px;">HR</h3>
          <div class="col-lg-12 col-xs-12 col-sm-1">
            <label class="checkbox-inline">
              <input type="checkbox" value="hr" name="actions[]" <?php if(in_array('hr', $actions)): echo ' checked="checked"'; endif; ?>>
              HR</label>
          </div>
          <!-- col-lg-12-->
          <div class="col-lg-2 col-xs-12 col-sm-6 pull-right">
                    <?php if($row['id']=="") { ?>
                    <button class="btn btn-primary col-xs-12 col-sm-12" >Register</button>
                    <?php } else {?>
                    <button class="btn btn-primary col-xs-12 col-sm-12" >Update</button>
                    <?php } ?>
          </div>
        </div>
        <!-- col-lg-12-->
        <div class="clearfix"></div>
      </form>
    </div>
    <!-- panel-body--> 
  </div>
  <!--panel-default--> 
</div>
<!-- container-->
<?php $cm->get_footer("") ?>
<script>
 	$(".btn-warning").on("click", function(){
		$(this).hide();
		$("#password").show();
		$("#password").removeAttr("disabled");
	});
 </script>