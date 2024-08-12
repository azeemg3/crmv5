<?php
/*	define('DBHOST','localhost');
	
	define('DBUSERNAME','root');
	
	define('DBPASSWORD','');
	define('DBNAME','adeel_school');
	
	mysql_connect(DBHOST,DBUSERNAME,DBPASSWORD);
	mysql_select_db(DBNAME);
*/	
	@session_start();
	error_reporting(0);
	
	include('includes/user.php');
     $user  = new user();
	 
	include('includes/utils.php');
	 $utils  = new utils();
	 
	 $user_role		=		$_SESSION['user']['role'];
	 
	 $utils->add_css('bootstrap.min.css','bootstrap/css');
	 $utils->add_css('font-awesome.min.css','bootstrap/css');
	 $utils->add_css('ionicons.min.css','bootstrap/css');
	 $utils->add_css('AdminLTE.min.css','dist/css');
	 $utils->add_css('_all-skins.min.css','dist/css/skins');
	 $utils->add_css('blue.css','plugins/iCheck/flat');
	 $utils->add_css('morris.css','plugins/morris');
	 $utils->add_css('jquery-jvectormap-1.2.2.css','plugins/jvectormap');
	 $utils->add_css('datepicker3.css','plugins/datepicker');
	 $utils->add_css('daterangepicker-bs3.css','plugins/daterangepicker');
	 $utils->add_css('bootstrap3-wysihtml5.min.css','plugins/bootstrap-wysihtml5');
	 
	 $utils->add_js('jQuery-2.1.4.min.js','plugins/jQuery');
	 $utils->add_js('jquery-ui.min.js','bootstrap/js');
	 $utils->add_js('bootstrap.min.js','bootstrap/js');
	 $utils->add_js('raphael-min.js','bootstrap/js');
	 $utils->add_js('morris.min.js','plugins/morris');
	 $utils->add_js('jquery.sparkline.min.js','plugins/sparkline');
	 $utils->add_js('jquery-jvectormap-1.2.2.min.js','plugins/jvectormap');
	 $utils->add_js('jquery-jvectormap-world-mill-en.js','plugins/jvectormap');
	 $utils->add_js('jquery.knob.js','plugins/knob');
	 $utils->add_js('moment.min.js','bootstrap/js');
	 $utils->add_js('daterangepicker.js','plugins/daterangepicker');
	 $utils->add_js('bootstrap-datepicker.js','plugins/datepicker');
	 $utils->add_js('bootstrap3-wysihtml5.all.min.js','plugins/bootstrap-wysihtml5');
	 $utils->add_js('jquery.slimscroll.min.js','plugins/slimScroll');
	 $utils->add_js('fastclick.min.js','plugins/fastclick');
	 $utils->add_js('app.min.js','dist/js');
	 $utils->add_js('dashboard.js','dist/js/pages');
	 $utils->add_js('demo.js','dist/js');

?>
 