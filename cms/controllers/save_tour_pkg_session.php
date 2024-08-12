<?php
require_once'../../inc.func.php';
session_start();
if(isset($_POST) && $_POST['type']=="add")
{
$newData=array(array(
'content_heading'=>$_POST['content_heading'], 'content_img'=>preg_replace("/[^.a-zA-Z-0-9]+/", "-", 
((!empty($_POST['content_img']))?''.$_POST['content_img'].'':"")
), 'content_text'=>$_POST['content_text']
, 'uid'=>crm::uniqueId()));
if(isset($_SESSION["content_rec"]))
{
	$found = false; //set found item to false
	foreach ($_SESSION["content_rec"] as $cart_itm)
	{
		if($cart_itm['uid']==$_POST['uid'])
		{
			$thisData[]=array('content_heading'=>$_POST['content_heading'], 'content_img'=>preg_replace("/[^.a-zA-Z]+/", "-", 
			
			((!empty($_POST['content_img']))?''.$_POST['content_img'].'':''.$cart_itm['content_img'].'')
			), 
		'content_text'=>$_POST['content_text'], 'uid'=>$cart_itm['uid']);
		$found=true;
		}
		else
		{
			$thisData[]=array('content_heading'=>$cart_itm['content_heading'], 'content_img'=>preg_replace("/[^.a-zA-Z]+/", "-", $cart_itm['content_img']), 
		'content_text'=>$cart_itm['content_text'], 'uid'=>$cart_itm['uid']);
		}
	}
	if($found==false)
	{
		$_SESSION["content_rec"] = array_merge($thisData, $newData);
	}
	else
	{
		$_SESSION["content_rec"] =$thisData;
	}
}
else
{
	$_SESSION['content_rec']=$newData;
}
}

//remove item from shopping cart
if(isset($_GET["vcr"]) && isset($_SESSION["content_rec"]))
{
	$vcr = $_GET["vcr"]; //get the product code to remove
	//$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["content_rec"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["uid"]!=$vcr){ //item does,t exist in the list
			$thisData[]=array('content_heading'=>$cart_itm['content_heading'], 'content_img'=>$cart_itm['content_img'], 
		'content_text'=>$cart_itm['content_text'], 'uid'=>$cart_itm['uid']);
		}
		
		//create a new product list for cart
		$_SESSION["content_rec"] = $thisData;
	}
}

$data="";
$i=1;
foreach($_SESSION['content_rec'] as $item)
{
	$data.='<tr id="'.$item['uid'].'">
			<td>'.$i++.'</td>
			<td>'.$item['content_heading'].'</td>
			<td>'.$item['content_text'].'</td>
			<td><img src="tour-packages-images/'.$item['content_img'].'" width="50"></td>
			<td><a href="javascript::void()" onclick="more_content(\''.$item['uid'].'\')"><i class="fa fa-edit"></i></a> 
			<a href="javascript::void(0)" onClick="del_tour_cat(\''.$item['uid'].'\')"><i class="fa fa-trash"></i></a></td>
	</tr>';
}
echo $data;
?>