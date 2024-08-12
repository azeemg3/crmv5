<?php 

	class user{
		
		
	function encrypt_pass($plain_pass){
		
		return  crypt($plain_pass,md5($plain_pass));
		
	}
	
	function login($email, $pass){
	$enc_pass	=	$this->encrypt_pass($pass);
	
	$link		=	mysql_query("SELECT * FROM add_users WHERE email='$email' and password='$enc_pass'") or die(mysql_error());

	$num	=	mysql_num_rows($link);
	
	if($num>0){
		@session_start();
		$rec		=	mysql_fetch_array($link);
		$_SESSION['user']['user_id']	=	$rec['id'];
		$_SESSION['user']				=	$rec;
		$_SESSION['user']['auth']		=	'yes';
		
		return true;
	}else{
		
		return false;
		
	}

	}
	
	function is_user_login(){
		@session_start();
	if($_SESSION['user']['auth']=='yes'){	
		return true;
	}else{
		
		return false;
		
	
	}
		
	}
	
	}

?>