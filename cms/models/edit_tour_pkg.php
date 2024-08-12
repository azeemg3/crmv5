<?php
session_start();
foreach ($_SESSION["content_rec"] as $cart_itm)
	{
		if($cart_itm['uid']==$_GET['uid'])
		{
			$thisData=array('content_heading'=>$cart_itm['content_heading'], 'content_img'=>preg_replace("/[^.a-zA-Z]+/", "-", $cart_itm['content_img']), 
		'content_text'=>$cart_itm['content_text'], 'uid'=>$cart_itm['uid']);
		}
	}
	echo json_encode($thisData);
?>