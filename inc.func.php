<?php
require_once'php_classes/leadClass.php';
require_once'php_classes/dashboardClass.php';
require_once'php_classes/tourClass.php';
require_once'php_classes/accountClass.php';
require_once'php_classes/administratorClass.php';
require_once'php_classes/marketingClass.php';
require_once'php_classes/reportsClass.php';
require_once'php_classes/msgClass.php';
class crm {

    function db() {
        $servername = 'localhost';
        $username = "u948502898_crmv5";
        $password = "O8CNY~qV!M6w";
        $db = "u948502898_crmv5";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
			header("location:login");
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
        //$conn->close();
    }

    var $css_files;
    var $js_files;
	function sessionStart()
	{
		session_start();
		ob_start();
		ob_clean();
		if(!isset($_SESSION['session_crmuserName'])){
			header('Location:login');
		}else{
			$userSessionName=$_SESSION['session_crmuserName'];
			$userSessionFullname=$_SESSION['fullname'];
			$userSessionId=$_SESSION['sessionId'];
			$user_branch=$_SESSION['branch_id'];
			//mysql_query("UPDATE user SET online='yes' WHERE id=".$userSessionId."");
			}
	}
	function get_client_ip_server() 
	{
		$ipaddress = '';
		 if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
	function access_logs()
	{
		$from_page="";
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$from_page=$_SERVER['HTTP_REFERER'];
		}
		$current='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$browser=$_SERVER['HTTP_USER_AGENT'];
		//$geo=unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".self::get_client_ip_server()));
		$data['from_page']=$from_page;
		$data['to_page']=$current;
		$data['userId']=$_SESSION['sessionId'];
		//$data['country']=$geo['geoplugin_countryName'];
		$data['ip_address']=$this->get_client_ip_server();
		$data['log_time']=$this->current_dt();
		$data['user_browser']=$browser;
		$data['branch']=$_SESSION['branch_id'];
		$result=$this->insert_array("access_logo", $data);
	}
    function add_css($root="", $fileName="", $media="") {
        echo $this->css_files = '<link href="' . $root . $fileName . '" rel="stylesheet" media="' . $media . '" />';
        echo "\n";
    }

    function load_css($root="") {
        $this->add_css($root, "bootstrap/css/bootstrap.min.css", "all");
        $this->add_css($root, "bootstrap/css/font-awesome.min.css", "all");
        $this->add_css($root, "bootstrap/css/ionicons.min.css", "all");
        $this->add_css($root, "dist/css/AdminLTE.min.css", "all");
        $this->add_css($root, "dist/css/skins/_all-skins.min.css", "all");
        $this->add_css($root, "plugins/iCheck/flat/blue.css", "all");
        $this->add_css($root, "plugins/morris/morris.css", "all");
        $this->add_css($root, "plugins/jvectormap/jquery-jvectormap-1.2.2.css", "all");
        $this->add_css($root, "plugins/datepicker/datepicker3.css", "all");
        $this->add_css($root, "plugins/daterangepicker/daterangepicker-bs3.css", "all");
        $this->add_css($root, "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css", "all");
    		$this->add_css($root, "plugins/select2/select2.min.css", "all");
    		$this->add_css($root, "plugins/timepicker/bootstrap-timepicker.min.css", "all");
    		$this->add_css($root, "bootstrap/css/myStyle.css", "all");
        $this->add_css($root, "bootstrap/css/media-query.css", "all");
    }

    function add_js($root="", $fileName="") {
        echo $this->js_files = '<script type="text/javascript" src="' . $root . $fileName . '"></script>';
        //echo "\n";
    }

    function load_js($root) {
 	echo '
	<script src="' . $root . 'plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="' . $root . 'bootstrap/js/jquery-ui.min.js"></script>
    <script src="' . $root . 'bootstrap/js/bootstrap.min.js"></script>
    <script src="' . $root . 'bootstrap/js/raphael-min.js"></script>
    <script src="' . $root . 'plugins/morris/morris.min.js"></script>
    <script src="' . $root . 'plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="' . $root . 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="' . $root . 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="' . $root . 'plugins/knob/jquery.knob.js"></script>
	   <script src="'.$root.'plugins/select2/select2.full.min.js"></script>
    <script src="' . $root . 'bootstrap/js/moment.min.js"></script>
    <script src="' . $root . 'plugins/daterangepicker/daterangepicker.js"></script>
    <script src="' . $root . 'plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="' . $root . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="' . $root . 'plg1081ugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="' . $root . 'plugins/fastclick/fastclick.min.js"></script>
    <script src="' . $root . 'dist/js/app.min.js"></script>
    <script src="' . $root . 'dist/js/pages/dashboard.js"></script>
    <script src="' . $root . 'dist/js/demo.js"></script>
	<script src="' . $root . 'js/inc.func.js?v='.time().'"></script>
	<script src="' . $root . 'js/lead.func.js?v='.time().'"></script>
	<script src="' . $root . 'js/tourSale.js?v='.time().'"></script>
	<script src="' . $root . 'js/account.js?v='.time().'"></script>
	<script src="' . $root . 'js/admin.func.js?v='.time().'"></script>
	<script src="'.$root.'js/marketing.js?v='.time().'"></script>
	<script src="'.$root.'js/reports.js?v='.time().'"></script>
	<script src="'.$root.'js/cms.js?v='.time().'"></script>
	<script src="'.$root.'plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="'.$root.'plugins/input-mask/jquery.inputmask.js"></script>
    <script src="'.$root.'plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
  </body>
</html>
	';
    }

    function foot($root="") {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
        echo '<script >
        $(function() 
			{ $(".date" ).datepicker({
                format:"dd-mm-yyyy" 
        	});
        });
		'.((basename($_SERVER['SCRIPT_FILENAME'], ".php")!='lead_details' && basename($_SERVER['SCRIPT_FILENAME'], ".php")!='sale_report')?'
        setInterval(function(){ 
			$.ajax({
				url:"'.$root.'ajax_call/count_message",
				type:"JSON",
				success: function(data)
				{
					rec=data.split("~");
					$(".count-msg").text(rec[0]);
					$(".uCountNoti").text(rec[1]);
					$(".get_desk_notification").load("'.$root.'ajax_call/get_desk_notification");
					if((rec[0]>0) || (rec[1]>0))
					{
						noti();
					}
				}
			});
	
 		}, 50000);
		':"").'
		 $(function () {
        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });				
		</script>';
		echo '
		<script>
		function update_desk_alert(id, desk_alert)
		{
			$(".alert-rec-app").load("'.$root.'accounts/ajax_call/update_desk_alert?id="+id+"&desk_alert="+desk_alert);
		
		}	
		</script>
		';
		echo '<div class="get_desk_notification"></div>';
		$notiAlert=$this->u_value("user", "alert_notification","id=".$_SESSION['sessionId']."");
        echo '<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://toursvision.com/" target="_blank">Tour Vision Travel</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdons Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" value="'.(($notiAlert=='on')?"off":"on").'" '.(($notiAlert=='off')?"checked":"").' onclick="notifiation_toggle(this.value)">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebars background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->';
    }

    function get_footer($root="") {
        $this->foot($root);
        $this->load_js($root);
		echo '
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>	
		<script src="'.$root.'js/easyNotify.js"></script>
		<script>
		var myImg = "https://toursvision.com/images/tvt.png";
		var j=$.noConflict();
		function noti(){
			event.preventDefault();
		
		  var options = {
			//title: $("#title").val(),
			title:"Crm Notification",
			options: {
			  //body: $("#message").val(),
			  body:"You have New Notification..",
			  icon: myImg,
			  lang: "en-US",
			  //onClick: myFunction
			}
		  };
		  console.log(options);
		  j("#easyNotify").easyNotify(options);
		}
		</script>';
    }

    function head($root="") {
        echo '<!DOCTYPE html>
				<html><head>
    				<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<link rel="icon" href="' . $root . 'branch_logo/logo.png" />
					<title>Customer Relationship Managent System</title>
					<!-- Tell the browser to be responsive to screen width -->
					<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <meta http-equiv="refresh" content="3600; url='.$root.'logout" />
					<!-- Bootstrap 3.3.5 -->';
    }

    function main_nav($root="") {
        $fileName = basename($_SERVER['SCRIPT_FILENAME'], ".php");
        $cur_dir = explode('\\', getcwd());
        $dirName=$cur_dir[count($cur_dir)-1];
		$lead=new lead();
        echo '
			 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
   <!--[if lt IE 9]> 
        <script src="bootstrap/js/html5shiv.min.js"></script>
        
        <script src="bootstrap/js/respond.min.js"></script>
        
    <![endif]-->
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="' . $root . 'index" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>RM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="font-size:13px !important;"><b><i>Customer Relation Management</i></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="load_msg()">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success count-msg">'.$lead->count_lead_cons($_SESSION['sessionId']).'</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <span class="count-msg">'.$lead->count_lead_cons($_SESSION['sessionId']).'</span> messages</li>
                  <li class="load-msg"></li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="pending_noti()">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning uCountNoti">'.$this->count_noti($_SESSION['sessionId']).'</span>
                </a>	
                <ul class="dropdown-menu">
                  <li class="header">You have <span class="uCountNoti">'.$this->count_noti($_SESSION['sessionId']).'</span> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu" id="pending_noti">
                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">0</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 0 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="' . $root . 'branch_logo/'.$this->u_value("branches", "branch_logo", "branch_id=".$_SESSION['branch_id']."").'" class="user-image" alt="User Image">
                  <span class="hidden-xs">'.$this->u_value("user", "name", "id=".$_SESSION['sessionId']."").'</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="' . $root . 'branch_logo/'.$this->u_value("branches", "branch_logo", "branch_id=".$_SESSION['branch_id']."").'" class="img-circle" alt="User Image">
                    <p>
                      '.$this->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."").'
                      <small>Member since<br>
					  ('.$this->mem_sicne($this->u_value("user", "date_created", "id=".$_SESSION['sessionId']."")).')
					  </small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="'.$root.'pfEdit?userid='.$_SESSION['sessionId'].'" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a  onclick="logout(\''.$root.'logout\')" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="'. $root .'branch_logo/'.$this->u_value("branches", "branch_logo", "branch_id=".$_SESSION['branch_id']."").'" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>'.$this->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."").'</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="' . (($fileName == 'index') ? "active" : "") . ' treeview">
              <a href="' . $root . 'index">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="' . (($fileName == 'create_new_lead') ? "active" : "") . ' ' . (($fileName == 'myLeads') ? "active" : "") . ' ' . (($fileName == 'allLeads') ? "active" : "") . ' ' . (($fileName == 'reminder') ? "active" : "") . ' ' . (($fileName == 'create_reminder') ? "active" : "") . ' ' . (($fileName == 'spo_d_sr') ? "active" : "") .' '.(($fileName == 'client_acc_sta') ? "active" : "") . ' '.(($fileName == 'spo_position_rep') ? "active" : "") . ' '.(($fileName == 'teamLeads') ? "active" : "") . ' '.(($fileName == 'dlt_rep') ? "active" : "") . ' '.(($fileName == 'feedbackList') ? "active" : "") . ' 
            '.(($fileName == 'reopenLeads') ? "active" : "") . ' treeview">
              <a href="#">
                <i class="fa fa-fw fa-graduation-cap"></i> <span>LMS</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'create_new_lead') ? "active" : "") . '"><a href="' . $root . 'create_new_lead"><i class="fa fa-angle-double-right"></i>Create New Lead</a></li>
                <li class="' . (($fileName == 'myLeads') ? "active" : "") . '"><a href="' . $root . 'myLeads">
				<i class="fa fa-angle-double-right"></i>My Leads</a></li>
				'.(($this->user_access('viewAllLeads', $_SESSION['sessionId']))? '<li class="' . (($fileName == 'allLeads') ? "active" : "") . '"><a href="' . $root . 'allLeads">
				<i class="fa fa-angle-double-right"></i>All Leads</a></li>':"").'
				'.(($this->u_value("user", "team_leader", "id=".$_SESSION['sessionId']."")=="yes")?'
				<li class="' . (($fileName == 'teamLeads') ? "active" : "") . '"><a href="' . $root . 'teamLeads">
				<i class="fa fa-angle-double-right"></i>Team Leads</a></li>
				':"").'
				'.(($this->user_access('agentLeads', $_SESSION['sessionId']))? '
				<li class="' . (($fileName == 'agentLeads') ? "active" : "") . '">
				<a href="' . $root . 'agentLeads"><i class="fa fa-angle-double-right"></i>
				Agent Leads</a></li>
					':"").'
				'.(($this->user_access('reopenLead', $_SESSION['sessionId']))? '
				<li class="' . (($fileName == 'reopenLeads') ? "active" : "") . '">
				<a href="' . $root . 'reopenLeads"><i class="fa fa-angle-double-right"></i>
				Reopen Leads</a></li>
				':"").'
				<li class="' . (($fileName == 'reminder') ? "active" : "") . '"><a href="' . $root . 'reminder">
				<i class="fa fa-angle-double-right"></i>Reminder List</a></li>
                
				<li class="' . (($fileName == 'create_reminder') ? "active" : "") .'"><a href="' . $root . 'create_reminder"><i class="fa fa-angle-double-right"></i>Create Reminder</a></li>
                <li class="' . (($fileName == 'spo_d_sr') ? "active" : "") . '"><a href="' . $root . 'spo_d_sr">
				<i class="fa fa-angle-double-right"></i>Daily Sale Report</a></li>
				<li class="' . (($fileName == 'client_acc_sta') ? "active" : "") . '"><a href="' . $root . 'client_acc_sta">
				<i class="fa fa-angle-double-right"></i>Client A/C Statement</a></li>
				<li class="' . (($fileName == 'spo_position_rep') ? "active" : "") . '"><a href="' . $root . 'reports/spo_position_rep">
				<i class="fa fa-angle-double-right"></i>Position Report</a></li>
				<li class="' . (($fileName == 'dlt_rep') ? "active" : "") . '"><a href="' . $root . 'reports/dlt_rep">
				<i class="fa fa-angle-double-right"></i>DLT Reports</a></li>
				<li class="' . (($fileName == 'feedbackList') ? "active" : "") . '"><a href="' . $root . 'feedbackList">
				<i class="fa fa-angle-double-right"></i>Feedback List</a></li>
              </ul>
            </li>
            
			'.(($this->user_access('accounts', $_SESSION['sessionId'])?'
			<li class="' . (($dirName == 'accounts') ? "active" : "") . ' ' . (($fileName == 'account') ? "active" : "") . '
			' . (($fileName == 'ledger') ? "active" : "") . ' ' . (($fileName == 'day_book') ? "active" : "") . ' 
			' . (($fileName == 'sale-inv-aging') ? "active" : "") . ' ' . (($fileName == 'transacc') ? "active" : "") . ' treeview">
              <a href="#">
                <i class="fa fa-fw fa-briefcase"></i> <span>Accounts</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'account') ? "active" : "") . '"><a href="' . $root . 'accounts/account"><i class="fa fa-dashboard"></i>Account Dashboard</a></li>
                <!--<li class="' . (($fileName == 'cash_book') ? "active" : "") . '"><a href="' . $root . 'accounts/cash_book"><i class="fa fa-angle-double-right"></i>Cash Book</a></li>-->
				<li class="' . (($fileName == 'ledger') ? "active" : "") . '"><a href="' . $root . 'accounts/ledger"><i class="fa fa-angle-double-right"></i>Ledger</a></li>
				<li class="' . (($fileName == 'day_book') ? "active" : "") . '"><a href="' . $root . 'accounts/day_book"><i class="fa fa-angle-double-right"></i>Day Boook</a></li>
				<li class="' . (($fileName == 'sale-inv-aging') ? "active" : "") . '"><a href="' . $root . 'accounts/sale-inv-aging"><i class="fa fa-angle-double-right"></i>Sale Invoice Aging</a></li>
				'.(($this->user_access('account-setup', $_SESSION['sessionId'])?'
				<li class="' . (($fileName == 'transacc') ? "active" : "") . '">
				<a href="' . $root . 'transacc"><i class="fa fa-angle-double-right"></i>Setup Accunts</a></li>
				':"")).'
              </ul>
            </li>
			':"")).'
            
        '.(($this->user_access('E-marketing', $_SESSION['sessionId']))?'
		<li class="' . (($fileName == 'address_book') ? "active" : "") . ' ' . (($fileName == 'mobile_address') ? "active" : "") . ' ' . (($fileName == 'lead_address') ? "active" : "") . ' ' . (($fileName == 'add_contact') ? "active" : "") . ' ' . (($fileName == 'sms_log') ? "active" : "") . ' ' . (($fileName == 'sh_emails') ? "active" : "") . ' ' . (($fileName == 'address_book_det') ? "active" : "") . ' ' . (($fileName == 'daily_rep') ? "active" : "") . ' '.(($fileName == 'import_contacts')?"active" : "") .' '.(($fileName == 'all_emails')?"active" : "") .' treeview">
              <a href="#">
                <i class="fa fa-fw fa-globe"></i> <span>E-Marketing</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'address_book') ? "active" : "") . '"><a href="' . $root . 'address_book">
				<i class="fa fa-angle-double-right"></i>Address Book</a></li>
				'.(($this->user_access("all-emails",$_SESSION['sessionId']))?'
				<li class="' . (($fileName == 'all_emails') ? "active" : "") . '"><a href="' . $root . 'all_emails">
				<i class="fa fa-angle-double-right"></i>All Email</a></li>
				':"").'
                <li class="' . (($fileName == 'mobile_address') ? "active" : "") . '"><a href="' . $root . 'mobile_address">
				<i class="fa fa-angle-double-right"></i>Mobile Contacts</a></li>
                '.(($this->user_access('lead-contact', $_SESSION['sessionId'])?'
				<li class="' . (($fileName == 'lead_address') ? "active" : "") . '"><a href="' . $root . 'lead_address">
				<i class="fa fa-angle-double-right"></i>All Leads Contacts</a></li>
				':'')).'
                <li class="' . (($fileName == 'add_contact') ? "active" : "") . '"><a href="' . $root . 'add_contact">
				<i class="fa fa-angle-double-right"></i>Add Contacts</a></li>
				<li class="' . (($fileName == 'import_contacts') ? "active" : "") . '"><a href="' . $root . 'marketing/import_contacts"><i class="fa fa-angle-double-right"></i>Import Contacts</a></li>
                <li class="' . (($fileName == 'sms_log') ? "active" : "") . '"><a href="' . $root . 'sms_log">
				<i class="fa fa-angle-double-right"></i>Message Log</a></li>
                <li class="' . (($fileName == 'sh_emails') ? "active" : "") . '"><a href="' . $root . 'sh_emails">
				<i class="fa fa-angle-double-right"></i>Emails Shedule</a></li>
				<li class="' . (($fileName == 'daily_rep') ? "active" : "") . '"><a href="' . $root . 'marketing/daily_rep">
				<i class="fa fa-angle-double-right"></i>Daily Reports</a></li>
              </ul>
            </li>
			<li class="' . (($fileName == 'send_group_sms') ? "active" : "") . ' ' . (($fileName == 'sms_schedule') ? "active" : "") . ' 
			'.(($fileName=='smsScheduleList')?'active':"").' treeview">
              <a href="#">
                <i class="fa fa-fw fa-globe"></i> <span>SMS-Marketing</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'send_group_sms') ? "active" : "") . '"><a href="' . $root . 'marketing/sms/send_group_sms">
				<i class="fa fa-angle-double-right"></i>Send Sms In Groups</a></li>	
				<li class="' . (($fileName == 'sms_schedule') ? "active" : "") . '"><a href="' . $root . 'marketing/sms/sms_schedule">
				<i class="fa fa-angle-double-right"></i>Sms Schedule</a></li>
				<li class="' . (($fileName == 'smsScheduleList') ? "active" : "") . '"><a href="' . $root . 'marketing/sms/smsScheduleList">
				<i class="fa fa-angle-double-right"></i>Sms Schedule List</a></li>			
              </ul>
            </li>
		':"").'  
            
			'.(($this->user_access('adminstrator', $_SESSION['sessionId']))?'
			<li class="'.(($fileName == 'lead_reports') ? "active" : "").' '.(($fileName == 'spo_lead_reports') ? "active" : "").' treeview">
              <a href="#">
                <i class="fa fa-fw fa-bar-chart-o"></i><span>Reports</span>
              </a>
			   </li>
			   <li class="' . (($fileName == 'lead_reports') ? "active" : "") . ' ' . (($fileName == 'spo_lead_reports') ? "active" : "") . ' treeview clickthis">
                <a href="#">
                <span>Leads Reports</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'lead_reports') ? "active" : "") . '"><a href="' . $root . 'reports/lead_reports"><i class="fa fa-angle-double-right"></i>Open Leads Reports</a></li>
                <li class="' . (($fileName == 'spo_lead_reports') ? "active" : "") . '"><a href="' . $root . 'reports/spo_lead_reports"><i class="fa fa-angle-double-right"></i>Spo Leads Reports</a></li>
              </ul> 
			  </li>
			  
			   <li>  
                <li class="' . (($fileName == 'spo_acc_reports') ? "active" : "") . ' ' . (($fileName == 'payViewCB') ? "active" : "") . ' 
				' . (($fileName == 'payViewPB') ? "active" : "") . ' ' . (($fileName == 'spo_position_rep') ? "active" : "") . ' 
				' . (($fileName == 'fn_aging_rep') ? "active" : "") . ' '.(($fileName == 'spo_monthly_sg') ? "active" : "").' treeview clickthis">
                <a href="#">
                <span>Accounts Reports</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                
              <ul class="treeview-menu">
			    <li class="' . (($fileName == 'spo_position_rep') ? "active" : "") . '"><a href="' . $root . 'reports/spo_position_rep">
				<i class="fa fa-angle-double-right"></i>Spo Position Report</a></li>
				<!--<li class="' . (($fileName == 'client_aging_rep') ? "active" : "") . '"><a href="' . $root . 'reports/client_aging_rep"><i class="fa fa-angle-double-right"></i>Client Aging Report</a></li>
				<li class="' . (($fileName == 'fn_aging_rep') ? "active" : "") . '"><a href="'.$root.'reports/fn_aging_rep"><i class="fa fa-angle-double-right"></i>Fourtnightly Aging Report</a></li>-->
                <li class="' . (($fileName == 'spo_acc_reports') ? "active" : "") . '"><a href="' . $root . 'reports/spo_acc_reports"><i class="fa fa-angle-double-right"></i>Spo Account Reports</a></li>
				<li class="'.(($fileName =='spo_monthly_sg') ? "active" : "") . '"><a href="' . $root . 'reports/spo_monthly_sg"><i class="fa fa-angle-double-right"></i>Spo Months Graph</a></li>
                <!--<li class="' . (($fileName == 'payViewCB') ? "active" : "") . '"><a href="' . $root . 'reports/payViewCB"><i class="fa fa-angle-double-right"></i>Cash Book Reports</a></li>
                <li class="' . (($fileName == 'payViewPB') ? "active" : "") . '"><a href="' . $root . 'reports/payViewPB"><i class="fa fa-angle-double-right"></i>Petty Cash Book Reports</a></li>-->
              </ul>
 
                </li>
				
				 <li class="'.(($fileName == 'bde-reports') ? "active" : "") .' 
				 '.(($fileName == 'bde_spo_reports') ? "active" : "") .' 
				 '.(($fileName == 'email_sent_rep') ? "active" : "") .' treeview">
                <a href="#">
                <span>E Marketing Reports</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                
             <ul class="treeview-menu">
			 	<li><a href="'.$root.'marketing/bde-reports"><i class="fa fa-angle-double-right"></i>BDE Reports</a></li>
                <li class="'.(($fileName == 'email_sent_rep') ? "active" : "") .'">
				 <a href="'.$root.'reports/email_sent_rep"><i class="fa fa-angle-double-right"></i>Email Sent Reports </a></li>
                <li><a href="#"><i class="fa fa-angle-double-right"></i>Sms Sent Reports</a></li>
              </ul>
   
                </li>
			':"").'
			    
				'.(($this->user_access('branch_admin', $_SESSION['sessionId']))?'                      
                <li class="' . (($fileName == 'register') ? "active" : "") . ' ' . (($fileName == 'userlist') ? "active" : "") . ' ' . (($fileName == 'login_his') ? "active" : "") . ' treeview">
              <a href="#">
                <i class="fa fa-group"></i> <span>Management</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'register') ? "active" : "") . '"><a href="' . $root . 'register">
				<i class="fa fa-angle-double-right"></i>Create New User</a></li>
                <li class="' . (($fileName == 'userlist') ? "active" : "") . '"><a href="' . $root . 'userlist">
				<i class="fa fa-angle-double-right"></i>All Users</a></li>
                <li class="' . (($fileName == 'login_his') ? "active" : "") . '"><a href="' . $root . 'login_his">
				<i class="fa fa-angle-double-right"></i>Users Login History</a></li>
              </ul>
            </li>   
            ':"").'
			
			'.(($this->user_access('branch_admin', $_SESSION['sessionId']))?'                      
                <li class="' . (($fileName == 'branch') ? "active" : "") . ' ' . (($fileName == 'message_api') ? "active" : "") . ' '.(($fileName == 'vendorList') ? "active" : "").' '.(($fileName == 'countryList') ? "active" : "").' '.(($fileName == 'cityList') ? "active" : "").' '.(($fileName == 'airline_list') ? "active" : "").' '.(($fileName == 'travel_class') ? "active" : "").' 
				'.(($fileName == 'airline_seatList') ? "active" : "").' '.(($fileName == 'airline_membership') ? "active" : "").' '.(($fileName == 'transacc') ? "active" : "").' '.(($fileName == 'access_log') ? "active" : "").' '.(($fileName == 'e_marketing_groups') ? "active" : "").' '.(($fileName == 'deleted_history') ? "active" : "").'  treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Administrator</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  '.(($this->user_access('adminstrator',$_SESSION['sessionId']))?'
			  	<li class="' . (($fileName == 'branch') ? "active" : "") . '"><a href="' . $root . 'branch"><i class="fa fa-angle-double-right"></i>Branch Manage</a></li>
				<li class="' . (($fileName == 'message_api') ? "active" : "") . '"><a href="' . $root . 'message_api">
				<i class="fa fa-angle-double-right"></i>Message Api</a></li>
			  ':"").'
				<li class="' . (($fileName == 'transacc') ? "active" : "") . '">
				<a href="' . $root . 'transacc"><i class="fa fa-angle-double-right"></i>Setup Accunts</a></li>
				<li class="' . (($fileName == 'countryList') ? "active" : "") . '">
				<a href="' . $root . 'countryList"><i class="fa fa-angle-double-right"></i>Country List</a></li>
				<li class="' . (($fileName == 'cityList') ? "active" : "") . '">
				<a href="' . $root . 'cityList"><i class="fa fa-angle-double-right"></i>City List</a></li>
				<li class="' . (($fileName == 'airline_list') ? "active" : "") . '">
				<a href="' . $root . 'administrator/airline_list"><i class="fa fa-angle-double-right"></i>Airline List</a></li>
				<li class="' . (($fileName == 'airline_seatList') ? "active" : "") . '">
				<a href="' . $root . 'administrator/airline_seatList"><i class="fa fa-angle-double-right"></i>Airline Seat List</a></li>
				<li class="' . (($fileName == 'travel_class') ? "active" : "") . '">
				<a href="' . $root . 'administrator/travel_class"><i class="fa fa-angle-double-right"></i>Class Of Travel</a></li>
				<li class="' . (($fileName == 'airline_membership') ? "active" : "") . '">
				<a href="' . $root . 'administrator/airline_membership"><i class="fa fa-angle-double-right"></i>Airline Membership</a></li>
				<li class="' . (($fileName == 'e_marketing_groups') ? "active" : "") . '">
        <a href="' . $root . 'administrator/e_marketing_groups"><i class="fa fa-angle-double-right"></i>E-Marketing Groups</a>
				</li>
				<li class="'.(($fileName == 'deleted_history') ? "active" : "").'">
				<a href="' . $root . 'administrator/deleted_history"><i class="fa fa-angle-double-right"></i>Deleted History</a></li>
				<li class="' . (($fileName == 'access_log') ? "active" : "") . '">
				<a href="' . $root . 'administrator/access_log"><i class="fa fa-angle-double-right"></i>Pages Log</a></li>
              </ul>
            </li>   
            ':"").'
			'.(($this->user_access('attendance', $_SESSION['sessionId']))?'
                <li class="' . (($fileName == 'add_staff') ? "active" : "") . ' ' . (($fileName == 'staff_list') ? "active" : "") . ' ' . (($fileName == 'attendance') ? "active" : "") . ' ' . (($fileName == 'attendance_rep') ? "active" : "") . ' treeview">
              <a href="#">
                <i class="fa fa-fw fa-user-plus"></i> <span>Attendance</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'add_staff') ? "active" : "") . '"><a href="' . $root . 'attendance/add_staff">
				<i class="fa fa-angle-double-right"></i>Add New Staff</a></li>
                <li class="' . (($fileName == 'staff_list') ? "active" : "") . '"><a href="' . $root . 'attendance/staff_list">
				<i class="fa fa-angle-double-right"></i>Staff List</a></li>
                <li class="' . (($fileName == 'attendance') ? "active" : "") . '"><a href="' . $root . 'attendance/attendance">
				<i class="fa fa-angle-double-right"></i>Make Attendance</a></li>
                <li class="' . (($fileName == 'attendance_rep') ? "active" : "") . '"><a href="' . $root . 'attendance/attendance_rep"><i class="fa fa-angle-double-right"></i>Attendance Reports</a></li>
              </ul>
            </li>   
            ':"").'
		'.(($this->user_access('attendance', $_SESSION['sessionId']))?'	
         <li>
              <a href="#">
                <i class="fa fa-fw fa-spinner"></i> <span style="font-size:18px!important;color:#fff!important;">XO</span>
              </a>
			  </li>
                <li class="' . (($fileName == 'pending_xo') ? "active" : "") . ' treeview">
                <a href="#">
                <span>Pending Xo</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'pending_xo') ? "active" : "") . '"><a href="' . $root . 'xo/pending_xo">
				<i class="fa fa-angle-double-right"></i>Open Pending Xo </a></li>
              </ul>
  
                </li>
                <li class="' . (($fileName == 'all_xo') ? "active" : "") . ' treeview">
                <a href="#">
                <span>Xo Reports</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
               
               <ul class="treeview-menu">
                <li class="' . (($fileName == 'all_xo') ? "active" : "") . '"><a href="' . $root . 'xo/all_xo">
				<i class="fa fa-angle-double-right"></i>Open All Xo </a></li>
              </ul>
                </li>
				':"").'
				
			'.(($this->user_access('cms', $_SESSION['sessionId']))?'			
			<li class="' . (($fileName == 'cms_home') ? "active" : "") . ' ' . (($fileName == 'latest_tour_pkg') ? "active" : "") . '
			' . (($fileName == 'tour_category') ? "active" : "") . ' ' . (($fileName == 'latestPkgList') ? "active" : "") . ' 
			' . (($fileName == 'our_offers') ? "active" : "") . ' ' . (($fileName == 'web_videos') ? "active" : "") . ' ' . (($fileName == 'web_videosList') ? "active" : "") . ' ' . (($fileName == 'destinationList') ? "active" : "") . ' ' . (($fileName == 'addNew_destination') ? "active" : "") . ' 
			'.(($fileName == 'hotel_deals') ? "active" : "").' '.(($fileName == 'hotel_destination' || $fileName == 'addNew_hotel_destination') ? "active" : "").'  '.(($fileName == 'hotelsList' || $fileName == 'addNew_hotel') ? "active" : "").' '.(($fileName=='umrah_pkgList' || $fileName=='addNewUmrah_pkg')?'active':"").' '.(($fileName=='web_slider' || $fileName=='pak_tour_destinations' || $fileName=='pak_tour_pkgs' || $fileName=='add_new_pk_pkg')?'active':"").' treeview">   
				   <a href="#">
						<i class="fa fa-fw fa-stumbleupon-circle"></i> <span>CMS</span> <i class="fa fa-angle-left pull-right"></i>
					  </a>
					  <ul class="treeview-menu">
						<li class="' . (($fileName == 'cms_home') ? "active" : "") . '"><a href="' . $root . 'cms/cms_home">
						<i class="fa fa-angle-double-right"></i>Home</a></li>
						<li class="' . (($fileName == 'web_slider') ? "active" : "") . '"><a href="' . $root . 'cms/web_slider">
						<i class="fa fa-angle-double-right"></i>Web Slider</a></li>
						<li class="' . (($fileName == 'pak_tour_destinations') ? "active" : "") . '"><a href="' . $root . 'cms/pak_tour_destinations">
						<i class="fa fa-angle-double-right"></i>Pak Tour Destinations</a></li>
						<li class="' . (($fileName == 'pak_tour_pkgs') ? "active" : "") . '"><a href="' . $root . 'cms/pak_tour_pkgs">
						<i class="fa fa-angle-double-right"></i>Pak Tour Packages</a></li>
						<li class="' . (($fileName == 'tour_category') ? "active" : "") . '"><a href="' . $root . 'cms/tour_category">
						<i class="fa fa-angle-double-right"></i>Tour Category</a></li>
						<li class="' . (($fileName == 'latest_tour_pkg') ? "active" : "") . '"><a href="' . $root . 'cms/latest_tour_pkg">
						<i class="fa fa-angle-double-right"></i>Add Latest Packages</a></li>
						<li class="' . (($fileName == 'latestPkgList') ? "active" : "") . '"><a href="' . $root . 'cms/latestPkgList">
						<i class="fa fa-angle-double-right"></i>Latest Packages List</a></li>
						<li class="' . (($fileName == 'our_offers') ? "active" : "") . '"><a href="' . $root . 'cms/our_offers">
						<i class="fa fa-angle-double-right"></i>Our Offers</a></li>
						<li class="' . (($fileName == 'umrahCatList') ? "active" : "") . '"><a href="' . $root . 'cms/umrahCatList">
				<i class="fa fa-angle-double-right"></i>Umra Category List</a></li>
				<li class="' . (($fileName == 'umrah_pkgList') ? "active" : "") . '"><a href="' . $root . 'cms/umrah_pkgList">
				<i class="fa fa-angle-double-right"></i>Umra Packages List</a></li>
						<li class="' . (($fileName == 'web_videosList') ? "active" : "") . '"><a href="' . $root . 'cms/web_videosList">
						<i class="fa fa-angle-double-right"></i>Web Videos List</a></li>
						<li class="' . (($fileName == 'destinationList') ? "active" : "") . '"><a href="' . $root . 'cms/destinationList">
				<i class="fa fa-angle-double-right"></i>Destination List</a></li>
				<li class="' . (($fileName == 'hotel_deals') ? "active" : "") . '"><a href="' . $root . 'cms/hotel/hotel_deals">
				<i class="fa fa-angle-double-right"></i>Hotel Deals</a></li>
				<li class="' . (($fileName == 'hotel_destination') ? "active" : "") . '"><a href="' . $root . 'cms/hotel/hotel_destination">
				<i class="fa fa-angle-double-right"></i>Hotel Destination</a></li>
				<li class="' . (($fileName == 'hotelsList') ? "active" : "") . '"><a href="' . $root . 'cms/hotel/hotelsList">
				<i class="fa fa-angle-double-right"></i>Hotels List</a></li>
					  </ul>
					</li>
					':"").'
			
			'.(($this->user_access('hr', $_SESSION['sessionId']))?'
                <li class="' . (($fileName == 'post_job') ? "active" : "") . ' ' . (($fileName == 'posted_jobs') ? "active" : "") . ' ' . (($fileName == 'candidates') ? "active" : "") . ' treeview">
              <a href="#">
                <i class="fa fa-fw fa-search-plus"></i> <span>HR</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'post_job') ? "active" : "") . '"><a href="' . $root . 'hr/post_job">
				<i class="fa fa-angle-double-right"></i>Post Job</a></li>
                <li class="' . (($fileName == 'posted_jobs') ? "active" : "") . '"><a href="' . $root . 'hr/posted_jobs">
				<i class="fa fa-angle-double-right"></i>Posted Jobs</a></li>
                <li class="' . (($fileName == 'candidates') ? "active" : "") . '"><a href="' . $root . 'hr/candidates">
				<i class="fa fa-angle-double-right"></i>Candidates</a></li>
              </ul>
            </li>
            ':"").'
      '.(($this->user_access('account-setup', $_SESSION['sessionId']))?'
      <li class="'.(($fileName == 'off_doc') ? "active" : "").'  treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Documents Alerts</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'off_doc') ? "active" : "") . '">
        <a href="' . $root . 'administrator/off_doc"><i class="fa fa-angle-double-right"></i>Official Documents Alerts</a></li>
              </ul>
            </li>
            ':"").'
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>


		';
    }

    function get_header($root="") {
		$this->sessionStart();
		// ob_start("ob_gzhandler");
		$this->access_logs();
		$lead=new lead();
        $this->head($root);
        $this->load_css($root);
        $this->main_nav($root);
		$this->reminder_view_modal();
		echo $lead->desk_moadal_lead_msg();
    }
	function show_bal_format($bal)
	{
		return number_format(abs($bal), 2);
	}
	function dr_balance($bal)
	{
		return "Dr. ". number_format(abs($bal), 2);
	}
	function cr_balance($bal)
	{
		return "Cr. ". number_format(abs($bal), 2);
	}
	function show_bal($bal)
	{
		if ($bal>0)
		{
			return "Dr. ". number_format(abs($bal), 2);
			//return "Dr. ".abs($bal);
		}
		elseif($bal<0)
		{
			return "Cr. ". number_format(abs($bal), 2);
			//return "Cr. ".abs($bal);
		}
		elseif($bal==0)
		{
			return "Nil";
		}
	}
	function gds($gds_e_val="")
	{
		$gdss="";
		$gds_array=array('galileo'=>'Galileo','abacus'=>'Abacus', 'amedeous'=>'Amedeous', 'shaheen'=>'Shaheen', 'ithad'=>'Ithad',
		 'air_blue'=>'Air Blue', 'air_indus'=>'Air Indus', 'fly_dubai'=>'Fly Dubai', 'air_arabia'=>'Air Arabia', 'sareen_air'=>'Sareen Air');
		 foreach($gds_array as $gds => $gds_value)
		 {
			 $gdss.='
			 	<option value="'.$gds.'" '.(($gds==$gds_e_val)?'selected="selected"':"").'>'.$gds_value.'</option>
			 ';
		 }
		 return $gdss;
	}
	// All of the users 
	function spo($spo, $branch)
	{
		$list="";
		if($this->user_access("branch_admin",$_SESSION['sessionId']) || $this->user_access("transferLead",$_SESSION['sessionId']))
		{
			$result=$this->selectData("user", "branch_id=".$branch." and status='active'");
		}
		else if($this->user_access("edit",$_SESSION['sessionId']))
		{
		  $result=$this->selectData("user", "branch_id=".$branch."");
		}
		else
		{
			$result=$this->selectData("user", "branch_id=".$branch." AND id=".$_SESSION['sessionId']." and status='active'");
		}
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($spo==$row['id'])? 'selected="selected"':"").'  value="'.$row['id'].'">'.$row['name'].'</option>';
		}
		return $list;
	}
	function Currentspo()
	{
	
		$result=$this->selectData("user", "id=".$_SESSION['sessionId']." and status='active'");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($spo==$row['id'])? 'selected="selected"':"").'  value="'.$row['id'].'">'.$row['name'].'</option>';
		}
		return $list;
	}
//***************************Previous func file*************************************************************

    function current_dt() {
        if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
        $date_time = date("d-m-Y G:i:s");
        return $date_time;
    }

    function today() {
        if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
        $date_time = date("d-m-Y");
        return $date_time;
    }

    function insertData($TtableName, $colum, $value) {
        $db =self::db();
        $columns = implode(",", $colum);
        $values = "'" . implode("','", $value) . "'";
        $sql = ("INSERT INTO $TtableName ($columns) VALUES($values)");
        $result = $db->query($sql);
        return $result;
    }

    function insertData_multi($sTable, $columns, $values) {
        $db = self::db();
        $sql = "INSERT INTO $sTable ($columns) VALUES($values)";
        $result = $db->query($sql);
		if($result==true)
		{
        	return $result;
		}
		elseif ($db->error) 
		{
			return $db->errno;
		}
    }

// user this funciton when both of colmuns and values same
    function insert_array($sTable, $data, $add_col="", $add_val="") {
        $columns = "";
        $values = "";
        foreach ($data as $col =>$val) {
            $columns .= $col . ",";
            $values .= "'" .$val. "'" . ",";
        }
        $columns = rtrim($columns . $add_col, ",");
        $values = rtrim($values . $add_val, ",");
        $result = $this->insertData_multi("$sTable", $columns, $values);
        return $result;
    }
	function u_insert_array($sTable, $data, $add_col="", $add_val="") {
		 $db = $this->db();
        $columns = "";
        $values = "";
        foreach ($data as $col =>$val) {
            $columns .= $col . ",";
            $values .= "'" .$val. "'" . ",";
        }
        $columns = rtrim($columns . $add_col, ",");
        $values = rtrim($values . $add_val, ",");
		$sql = "INSERT INTO $sTable ($columns) VALUES($values)";
        return $sql;
    }
    function selectData($sTable, $sWhere) {
        $db = self::db();
        $sql = "SELECT $sTable.* FROM $sTable WHERE $sWhere";
        $result = $db->query($sql);
		if($result)
		{
        	return $result;
		}
    }

    function selectMultiData($data, $sTable, $sWhere) {
		$db=self::db();
        $sql = " SELECT $data FROM $sTable WHERE $sWhere ";
        $result = $db->query($sql);
		if($result)
		{
        	return $result;
		}
    }

    function update($sTable, $value, $sWhere) {
		$db=self::db();
       	$sql = "UPDATE $sTable SET $value WHERE $sWhere ";
        $result = $db->query($sql);
		if($result==true)
		{
        	return $result;
		}
		else
		{
			return $db->errno;
		}
    }

    function update_array($sTable, $values, $sWhere) {
        $query = "";
        foreach ($values as $values => $columns) {
            $query .= $values . "='" . $columns . "',";
        }
        $query = rtrim($query, ",");
		if($query)
		{
        	$result = $this->update("$sTable", $query, "$sWhere");
        	return $result;
		}
    }

    function delete($sTable, $sWhere) {
		$db=self::db();
        $sql = "Delete FROM $sTable WHERE $sWhere";
        $dlt_query = $db->query($sql);
		if($dlt_query)
		{
        	return $dlt_query;
		}
    }

    function u_total($sTable, $col, $sWhere) {
		$total=0;
		$db=self::db();
        $sql = "SELECT sum($col) AS val FROM $sTable WHERE $sWhere";
        $result = $db->query($sql);
		if($result)
		{
        	$row = $result->fetch_assoc();
        	$total = $row['val'];
        	return $total;
		}
    }

    function u_value($sTable, $col, $sWhere) {
		$db = self::db();
		$sql = "SELECT $col AS val FROM $sTable WHERE $sWhere";
		$result = $db->query($sql);

		if ($result) {
			$row = $result->fetch_assoc();
			if ($row) {
				$data = $row['val'];
				return $data;
			} else {
				// Handle case where no rows are returned
				return null;
			}
		} else {
			// Handle query failure
			return null;
		}

    }

    function count_val($sTable, $col, $sWhere) {
		$db=self::db();
        $sql = "SELECT count($col) AS val FROM $sTable WHERE $sWhere";
        $result =$db->query($sql);
		if($result)
		{
        $row = $result->fetch_assoc();
		if($row){
        	$total_val = $row['val'];
        	return $total_val;
			}else{
				return 0;
			}
		}
	}

    function login($userName, $password) {
        $result = $this->selectData("user", "email='" . $userName . "' AND status='active' ");
		if($result)
			{
        	$row = $result->fetch_assoc();
        	if ($userName == $row['email'] && md5($password) == $row['password']) {
            $_SESSION['session_crmuserName'] = $userName;
            $_SESSION['sessionId'] = $row['id'];
            $_SESSION['fullname'] = $row['name'];
            $_SESSION['branch_id'] = $row['branch_id'];
			$_SESSION['login_his_id']=
            $this->update("user", "online='yes', online_date='" . $this->current_dt() . "'", "id=" . $row['id'] . "");
            //mysql_query("INSERT INTO login_history (lat, longi, user_id, date_time, branch_id, ip_address) VALUES('$lat', '$long', '".$row['id']."',
            //'".$this->current_dt()."', '".$row['branch_id']."', '".$_SERVER['REMOTE_ADDR']."' )");
            header("location:index");
			}
			else
			  {
				header("location:login?error=error");
			  }
        } else {
            header("location:login?error=error");
        }
    }
	function password_app($userSessionId)
	{
		$query=$this->selectData("user", "id=".$userSessionId."");
		if($query)
		{
			$row=$query->fetch_assoc();
			return $row['password'];
		}
	}
    public static function get_cc() {
        $c_c_array = array("PAK 92" => "92", "UAE 971" => "971", "SAU 966" => "966", " Kuwait 965" => "965");
        foreach ($c_c_array as $c_codes => $c_codes_value) {
            echo '<option value="' . $c_codes_value . '">' . $c_codes . '</option>';
        }
    }
	// Branch users accesss
	function user_access($access, $userSessionId) {
        $query = $this->selectData("action", "user_id=" . $userSessionId . "");
		if($query)
		{
			while ($row = $query->fetch_assoc()) {
				$action[] = $row['action'];
			}
			if (in_array($access, $action)) {
				return true;
			} else {
				return false;
			}
		}
    }
	function branches($userSessionId,$branch_id)
	{
			$list="";
			if($this->user_access('adminstrator', $userSessionId)){
			$query=$this->selectData("branches", "status='active'");
			}
			else
			{
				$query=$this->selectData("branches", "branch_id=".$branch_id."");
			}
			if($query)
			{
			while($row=$query->fetch_assoc())
			{
				$list.= '
						<option value="'.$row['branch_id'].'" '.(($row['branch_id']==$branch_id)? 'selected' :"").'>'.$row['branch_name'].'</option>
					';
			}
			return $list;
			}
		}
    function get($val) {
        $get = mysqli_real_escape_string($_POST[$val][0]);
        return $get;
    }

    function post($val) {
        $post = mysqli_real_escape_string($_POST[$val][0]);
        return $post;
    }

    function show_rec() {
        echo'
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                ';
    }
    function services($services_e="")
   {
      $allServices=array("umrah", "hajh", "car", "hotel", "ticket", "visa", "Tour Pacakge", "Travel Insurance", "other");
      foreach($allServices as $services)
      {
          echo'<option value="'.$services.'" '.(($services==$services_e)? 'selected="selected"':"").' >
		  '.ucfirst('<i class="fa fa-fw fa-calendar-check-o"></i>'.ucwords($services)).'
		  </option>';
      }
   }
   function lead_status()
	{
		echo '
			<option value="new">New</option>
			<option value="pending">Pending</option>
			<!--'.(($this->user_access('adminstrator', $_SESSION['sessionId']))?'
			':'').'-->
			<option value="process">In Process</option>
			<option value="successfull">Successfull</option>
			<option value="unsuccessfull">Unsuccessfull</option>
			';
	}
	// lead status color wise
	function ls_clr($status)
	{
		if($status=="new"){return '<span class="label bg-blue-gradient">'.$status.'</span>';}
		if($status=="pending"){return '<span class="label label-warning">'.$status.'</span>';}
		if($status=="successfull"){return '<span class="label bg-green-gradient">'.$status.'</span>';}
		if($status=="process"){return '<span class="label bg-teal-gradient">'.$status.'</span>';}
		if($status=="unsuccessfull"){return '<span class="label bg-red-gradient">'.$status.'</span>';}
	}
	// fetch other vendors list 
	function vendors($vendor="")
	{
		$list="";
		$result=$this->selectData("trans_acc","trans_acc_type='Vendor' AND branch_id=".$_SESSION['branch_id']."");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['trans_acc_id'].'" '.(($row['trans_acc_id']==$vendor)?'selected="selected"':"").'>'.$row['trans_acc_name'].'</option>';
		}
		return $list;
	}
	function pagination($total_rec, $cur_page, $per_page)
	{
		$no_ofPage=ceil($total_rec/$per_page);
		if ($cur_page >= 5) 
			{
		   		$start_loop = $cur_page -3;
			  	$end_loop = $cur_page + 2;
				if($no_ofPage-1==$cur_page)
				   {
					   $end_loop=$no_ofPage;
				   }
				   if($cur_page==$no_ofPage)
				   {
					   $end_loop=$no_ofPage;
				   }
			}
		else 
		{
			$start_loop = 1;
			if ($no_ofPage > 5)
				$end_loop=5;
			else
				$end_loop =$no_ofPage;
		}
		$ul="";
		$ul.='<ul class="pagination pull-right">';
		if($cur_page==1) 
		{
			$ul.='<li p="1"  class="active"><a>First</a></li>';
		}
		else
		{
			$ul.='<li p="1"><a>First</a></li>';
		}
		for ($i = $start_loop; $i <= $end_loop; $i++) {
			if ($cur_page == $i)
				$ul .= "<li class='active' p='$i'><a>{$i}</a></li><li>";
			else
				$ul .= "<li p='$i'><a>{$i}</a></li>";
			}
		if($cur_page==$no_ofPage && $cur_page!=1)
		{
			$ul.='<li p="'.$no_ofPage.'" class="active"><a>Last</a></li>';
		}
		else
		{
			$ul.='<li p="'.$no_ofPage.'"><a>Last</a></li>'; 
		}
		$ul.="</ul>";
			return $ul;
	}
	function nothing_found($id, $colspan)
	{
		if(empty($id)){
		echo'
			<tr>
				<td colspan="'.$colspan.'" align="center">No Record Found</td>
			</tr>
		';
		}
		else
		{
			echo"";
		}
	}
	// form of payment to FOP (pt=Payment type)
	function fop($pt="")
	{
		$values="";
		$fop=array("cash"=>"Cash","online"=>"Online","cheque"=>"Cheque","pay_order"=>"Pay Order","demand_draft"=>"Demand Draft",
		"card"=>"Credit/Debit Card");
		foreach($fop as $key=>$val)
		{
			$values.='<option value="'.$key.'">'.$val.'</option>';
		}
		return $values;
	}
	// fop return 
	function fop_return($pt)
	{
		$values="";
		$fop=array("cash"=>"Cash","online"=>"Online","cheque"=>"Cheque","pay_order"=>"Pay Order","demand_draft"=>"Demand Draft",
		"card"=>"Credit/Debit Card");
		foreach($fop as $key=>$val)
		{
			if($pt==$key){return $val;}
		}
	}
	// data decode
	function encodeData($val)
	{
		$value=base64_encode($val);
		return $value;
	}
	// data encode
	function decodeData($val)
	{
		$value=base64_decode($val);
		return $value;
	}
	function serial($number)
	{
		if($number<10){$no="00".$number;}
		else{$no=$number;}
		return $no;
	}
	function rvc()
	{
	$a = rand(65,90);
	$b = rand(65,90);
	$c = rand(0,99);
	$c = str_pad($c, 2, '0', STR_PAD_LEFT);
	$d = rand(65,90);
	$key = chr($a).chr($b).$c.chr($d);
	return $key;
	}
	function uniqueId()
	{
		return self::rvc();
	}
	// user Lead Taken over
	function ltu($leadId)
	{
		$ltu=$this->u_value("lead", "userId", "id=".$leadId." ORDER BY id DESC");
		return $ltu;
	}
	//amount format
	function amount_format($amount)
	{
		if($amount>0){return number_format($amount); }
		else{return "0.00";}
	}
	function go_back()
	{
		return '<a onClick="history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a><br><br>';
	}
	function message_api($mobile, $message)
		{
			if(substr($mobile,0,2)==92)
			{
			$type = "xml"; 
			$id =$this->u_value("msg_api", "api_id", "branch=".$_SESSION['branch_id'].""); 
			$pass =$this->u_value("msg_api", "api_pswd", "branch=".$_SESSION['branch_id'].""); 
			$mask =$this->u_value("msg_api", "msg_mask", "branch=".$_SESSION['branch_id']."");
			$lang = "English"; 
		 	//text Message Code
			$to =$mobile;
			$message =$message;
 			$message = urlencode($message);   
 			// Prepare data for POST request 
			 $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;   
			 // Send the POST request with cURL 
			 $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url'); 
			 curl_setopt($ch, CURLOPT_POST, true); 
			 curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			 $result = curl_exec($ch); //This is the result from SMS4CONNECT cu
			 //$xml=simplexml_load_string($result) or die("Error: Cannot create object");
			 $xml=simplexml_load_string($result);
			//  $columns=array("code, mobile, message, date, userId, branch");
			//  $values=array($xml->code, $to, $message, $this->current_dt(), $_SESSION['sessionId'], $_SESSION['branch_id'] );
			//  print_r($values);exit;
			//  $this->insertData("sms_status", $columns, $values);
			}
			else
			{
				/*$user = "tourvision";
				$password = "IDKdGZYXIDeVDc";
				//$api_id = "3436295";
				$api_id="3460887";
				$baseurl ="http://api.clickatell.com";
				//$lead_id = $_POST['lead_id_modal'];
				$currentDate = date("d-m-Y");
				$text = urlencode($message);
				$from="Tourvision";
				$to =$mobile;
				// auth call
				$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
				// do auth call
				$ret = file($url);
				// explode our response. return string is on first line of the data returned
				$sess = explode(":",$ret[0]);
				if ($sess[0] == "OK") {
					$sess_id = trim($sess[1]); // remove any whitespace
					$url = "$baseurl/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=$to&text=$text&from=$from&concat=2 
					<up to 306 characters> ";
					//echo $url;
					// do sendmsg call
					$ret = file($url);
					$send = explode(":",$ret[0]);
				}*/
			}
		}
	function mem_sicne($date)
	{
		if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
		$currDAte=date("d-m-Y h:i:s");
		$datetime1 = new DateTime($date);
		$datetime2 = new DateTime($currDAte);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%y years %m months %d days');

	}
	// count notifincation 
	function count_noti($userId)
	{
		date_default_timezone_set("Asia/karachi");
		$cd =strtotime(date('d-m-Y'));
		$lead=new lead();
		$rem=$this->count_val("reminder", "id", "status='pending' AND userId=".$userId."");
		$count_noti=$lead->p_L($userId)+$rem;
		return $count_noti;
	}
	function reminder_view_modal()
	{
		echo '
			<div class="modal fade" id="desk_rem_view" role="dialog">
		<div class="modal-dialog"> 
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">×</button>
			  <h3>Reminder Details:<a class="btn btn-xs btn-info" style="margin-left:5%;">Snooz</a></h3>
			  <div class="panel panel-default panel-body" id="rem_det">
			  	
			  </div>
			 </div>
			<div class="col-md-12"> 
			</div>
		  </div>
		  <!--modal-content--> 
		</div>
		</div>
		';
	}
	function cron_time($hour="", $minute="")
	{
		$h="";$m='';
		for($i=1; $i<=24; $i++)
		{
			$h.='<option value="'.$i.'" '.(($i==$hour)? 'selected': "").'>'.(($i<10)? '0'.$i.'':"").' '.(($i>9)? ''.$i.'':"").'</option>';
		}
		for($i=15; $i<=45; $i+=15)
		{
			$m.='<option '.(($i==$minute)? 'selected': "").' value="'.$i.'">'.$i.'</option>';
		}
		$hr='<div class="col-md-3">
				<div class="form-group">
					<label>Hour</label>
					<select class="form-control input-sm" name="reminder_time">
						'.$h.'
					</select>
				</div>
			</div>
			';
			$min='<div class="col-md-3">
				<div class="form-group">
					<label>Minute</label>
					<select class="form-control input-sm" name="reminder_min">
						'.$m.'
					</select>
				</div>
			</div>
			';	
			return $hr.$min;
	}
	function banks($bank_id="")
	{
		$list="";
		$result=$this->selectData("trans_acc", "trans_acc_type='Bank' AND branch_id=".$_SESSION['branch_id']."");
		while($row=$result->fetch_assoc())
		{
			$list.='
				<option value="'.$row['trans_acc_id'].'" '.(($row['trans_acc_id']==$bank_id)).'>'.$row['trans_acc_name'].'</option>
			';
		}
		return $list;
	}
	public static function countries($country_id=0)
	{
		$crm=new crm();
		$list="";
		$result=$crm->selectData("countries", "1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['country_code'].'" '.(($row['country_code']==$country_id)?'selected':"".(($row['country_code']==92)?'selected':"")."").'>'.$row['country_name'].'</option>';
		}
		return $list;
	}
	function cities($country_id="",$city_id="")
	{
		$list="";
		if($country_id==""){$sWhere="1";}
		else{$sWhere="country_code=".$country_id."";}
		$result=$this->selectData("cities", "{$sWhere}");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['city_id'].'" '.(($city_id==$row['city_id'])?'selected':"").'>'.$row['city_name'].'</option>';
		}
		return '<option value="">Select City</option>'.$list;
	}
	function emptyWord($word)
	{
		if(!empty($word))
		{
			return $word;
		}
		else
		{
			return "N/A";
		}
	}
	function gender($value="")
	{
		$array=array('Male'=>'male', 'Female'=>'female');
		$list='';
		foreach($array as $key=>$val)
		{
			$list.='<option '.(($value==$val)?'selected':"").' value="'.$val.'">'.$key.'</option>';
		}
		return $list;
	}
	function martial_status($value="")
	{
		$array=array('Single'=>'single', 'Married'=>'married');
		$list='';
		foreach($array as $key=>$val)
		{
			$list.='<option '.(($value==$val)?'selected':"").' value="'.$val.'">'.$key.'</option>';
		}
		return $list;
	}
	function countryList($cid)
	{
		$country="";
		$result=$this->selectData("countries", "1");
		while($row=$result->fetch_assoc())
		{
			$country.='<option '.(($row['country_code']==$cid)?'selected':"").' value="'.$row['country_code'].'">
		 '.$row['country_name'].'</option>';
		}
		return $country;
	}
	function province($pid)
	{
		$province="";
		$result=$this->selectData("cities", "1 GROUP BY province");
		if($result)
		{
		while($row=$result->fetch_assoc())
		{
			$province.='<option '.(($row['city_id']==$pid)?'selected':"").'  value="'.$row['city_id'].'">
		 '.$row['province'].'</option>';
		}
		return $province;
		}
	}
	function institute($uni="")
	{
		$list="";
		$result=$this->selectData("institute", '1');
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['ins_id'].'" '.(($uni==$row['ins_id'])?'selected':"").'>'.$row['ins_name'].'</option>';
		}
		return $list;
	}
	//Qualifications
	function qualification($qid="")
	{
		$list="";
		$array=array('Non-Matriculation','Matriculation/O-Level','Intermediate/A-Level','Bachelors','Masters','MPhil/MS','PHD/Doctorate','Certification','Diploma','Short Course');
		foreach($array as $qualif)
		{
			$list.='<option value="'.$qualif.'" '.(($qid==$qualif)?'selected':"").'>'.$qualif.'</option>';
		}
		return $list;
	}
	function loader($path="")
	{
		echo'
			<div class="modal loader" id="loader" role="dialog">
				<div class="modal-dialog" style="margin-top:30%; width:11%;">
				  <!-- Modal content-->
				  <div class="">
					<div class="">
					  <img src="'.$path.'images/l_ajax_loader.gif" />
					</div>
					<!--modal-body-->
				  </div>
				  <!--model-content-->
				</div>
			</div>
			<!-- loader-->
			';
	}
	function user_auth($auth, $userId, $root)
	{
		if($this->user_access("".$auth."", $userId)){}
		else {return header("location:".$root."index"); }
	}
	function room_types($room="")
	{
		$room_type=array('sharing', 'single', 'double', 'triple', 'quad', 'quaint', 'suit', 'suit 1 bed room', 'suit 2 bed room',
		'suit 3 bed');
		foreach($room_type as $rt)
		{
			echo'<option value="'.$rt.'" '.(($rt==$room)?'selected="selected"':"").'>'.ucfirst($rt).'</option>';
		}
	}
	function work_sicne($date)
	{
		if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
		$currDAte=date("d-m-Y h:i:s");
		$datetime1 = new DateTime($date);
		$datetime2 = new DateTime($currDAte);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%y years %m months %d days %h hour and %i Minute');

	}
	//under the teams spo
	function team_spo($team_lead_id="")
	{
		$list="";
		$result=$this->selectData("user", "team_leader_id=".$team_lead_id." and status='active'");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
		}
		return $list;
	}
	//show currency in words
	public function convertNumberToWord($num = false)
	{
		$num = str_replace(array(',', ' '), '' , trim($num));
		if(! $num) 
		{
			return false;
		}
		$num = (int) $num;
		$words = array();
		$list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
			'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
		);
		$list1=array_map('strtoupper',$list1);
		$list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
		$list2=array_map('strtoupper',$list2);
		$list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
			'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
			'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
		);
		$list3=array_map('strtoupper',$list3);
		$num_length = strlen($num);
		$levels = (int) (($num_length + 2) / 3);
		$max_length = $levels * 3;
		$num = substr('00' . $num, -$max_length);
		$num_levels = str_split($num, 3);
		for ($i = 0; $i < count($num_levels); $i++) 
		{
			$levels--;
			$hundreds = (int) ($num_levels[$i] / 100);
			$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' HUNDRED' . ' ' : '');
			$tens = (int) ($num_levels[$i] % 100);
			$singles = '';
			if ( $tens < 20 ) 
			{
				$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
			}
			 else 
			 {
				$tens = (int)($tens / 10);
				$tens = ' ' . $list2[$tens] . ' ';
				$singles = (int) ($num_levels[$i] % 10);
				$singles = ' ' . $list1[$singles] . ' ';
			}
			$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		} //end for loop
    	$commas = count($words);
    	if ($commas > 1) 
		{
        	$commas = $commas - 1;
    	}
    	return implode(' ', $words);
	}
	public function pak_destination($dId=null){
		$result=self::selectMultiData("id, dest_name", "pak_tour_dest", "status='active'");
		$list="";
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($dId==$row['id'])?'selected':"").' value="'.$row['id'].'">'.$row['dest_name'].'</option>';
		}
		return $list;
	}
}

class validation extends crm {

    public static function empty_field() {
        echo '<div class="alert alert-danger alert-dismissable col-md-4 col-md-offset-3 empty-field" style="margin-top:10px; display:none;
		background-color: #f2dede !important;">
            <a class="close" onclick="$(\'.empty-field\').hide()">×</a>
            <strong>Error!</strong> Please Fill your Fields Properly.
        </div>';
    }
}
$cm=new crm();
$lead=new lead();
$dashboard=new dashBoard();
$tour=new tourSale();
$account=new account();
$administrator=new administrator();
$marketing=new marketing();
$report=new reports();
$msg=new message();
?>