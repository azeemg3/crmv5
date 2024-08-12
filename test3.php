<?php
set_time_limit(4000); 
 
// Connect to gmail
$imapPath = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'azeemkhalidg3@gmail.com';
$password = '';
 
// try to connect 
$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
 
 
// search and get unseen emails, function will return email ids
$emails = imap_search($inbox,'ALL');
 rsort($emails);
$output = '';
 $i=0;
foreach($emails as $mail) {
    
    $headerInfo = imap_headerinfo($inbox,$mail);
    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $headerInfo->fromaddress, $matches);
   //$output .= $headerInfo->subject.'<br/>';
    //$output .= $headerInfo->toaddress.'<br/>';
    //$output .= $headerInfo->date.'<br/>';
    $output .= $matches[0][0].'<br/>';
    //$output .= $headerInfo->reply_toaddress.'<br/>';
    
    $emailStructure = imap_fetchstructure($inbox,$mail);
    
    if(!isset($emailStructure->parts)) {
         //$output .= imap_body($inbox, $mail, FT_PEEK); 
    } else {
        //    
    }
   echo $output;
   $output = '<br>';
   if($i>100)
   {
	   exit();
   }
   $i++;
}
 
// colse the connection
imap_expunge($inbox);
imap_close($inbox);
exit();
?>
<?php
/* connect to gmail */

$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = 'azeemkhalidg3@gmail.com';
$password = 'naeemazeem03244659501';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox,'ALL');

/* if emails are returned, cycle through each... */
if($emails) {
	
	/* begin output var */
	$output = '';
	
	/* put the newest emails on top */
	rsort($emails);
	
	/* for every email... */
	$i=0;
	foreach($emails as $email_number) {
		
		/* get information specific to this email */
		print_r($email_number);
		$overview = imap_fetch_overview($inbox,$email_number,1);
		$message = imap_fetchbody($inbox,$email_number,2);
		/* output the email header information */
		$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
		$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
		$output.= '<span class="from">'.$overview[0]->from.'</span>';
		$output.= '<span class="date">on '.$overview[0]->date.'</span>';
		$output.= '</div>';
		/* output the email body */
		$output.= '<div class="body">'.$message.'</div>';
		//echo $overview[0]->from;
		echo "<br>";
		if($i>100)
		{
			exit();
		}
		$i++;
	}
	
	//echo $output;
} 

/* close the connection */
imap_close($inbox);
exit();
?>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="385077664931128">
</div>
<?php
exit();
 $ip = $_SERVER['REMOTE_ADDR'];
 function cc($amount) {
	global $geoPlugin_array;
	if ( isset($geoPlugin_array['geoplugin_currencyCode']) && $geoPlugin_array['geoplugin_currencyCode'] != 'USD' ) { 
		return '(' . $geoPlugin_array['geoplugin_currencySymbol'] . round( ($amount * $geoPlugin_array['geoplugin_currencyConverter']),2) . ')';
	} 
	return false;
}
 
$geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );
 
echo '<h3>Product A costs $800 ' . cc(800) . '</h3>';


 echo var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])));
 exit();
?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script>
  $(function() {
      // the request will be to http://www.geoplugin.net/json.gp?ip=my.ip.number but we need to avoid the cors issue, and we use cors-anywhere api.

      $.getJSON("https://cors-anywhere.herokuapp.com/http://www.geoplugin.net/json.gp?ip=" + '<?php echo $ip ?>', function(response) {
        console.log(response);
        // output an object which contains the information.
        $("#content").html("Hello visitor from " + response.geoplugin_countryName);

      });
});


</script>
<button type="button" id="submit">Click</button>
<div id="content"></div>
<?php exit(); ?>
<div id="sample">
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
     bkLib.onDomLoaded(function() {
          var myNicEditor = new nicEditor();
          myNicEditor.setPanel('myNicPanel');
          myNicEditor.addInstance('myInstance1');
          myNicEditor.addInstance('myInstance2');
          myNicEditor.addInstance('myInstance3');
     });
  //]]>
  </script> This is text above the Panel
  <div id="myNicPanel" style="width: 525px;"></div>This is text below the Panel<br />
  <br />
  <h4>
    Inline Div
  </h4>
  <div id="myInstance1" style="font-size: 16px; background-color: #ccc; padding: 3px; border: 5px solid #000; width: 400px;">
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed magna dolor, faucibus ac, iaculis non, cursus et, dui. Donec non urna. Aliquam volutpat ornare augue. Phasellus egestas, nisl
    fermentum porttitor rutrum, magna metus rutrum risus, id fringilla magna mi nec lorem. Etiam eget metus sed justo ultricies rhoncus. Praesent rhoncus arcu non dolor. Proin eu eros. Curabitur
    vehicula. Nulla vehicula lectus eget eros. Nulla vel nulla at dui dictum mollis. Etiam purus felis, pretium vel, eleifend id, consectetuer nec, purus. Vivamus pretium orci ac sapien. Etiam at
    tortor. Nunc tincidunt mi sed sapien. Etiam lacus pede, fermentum eu, blandit ac, congue eget, metus. Quisque sed sem. Mauris at sapien. Ut luctus.
  </div><br />
  <h4>
    Inline Span
  </h4><span id="myInstance2" style="display: block;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed magna dolor, faucibus ac, iaculis non, cursus et, dui. Donec non urna. Aliquam
  volutpat ornare augue. Phasellus egestas, nisl fermentum porttitor rutrum, magna metus rutrum risus, id fringilla magna mi nec lorem. Etiam eget metus sed justo ultricies rhoncus. Praesent rhoncus
  arcu non dolor. Proin eu eros. Curabitur vehicula. Nulla vehicula lectus eget eros. Nulla vel nulla at dui dictum mollis. Etiam purus felis, pretium vel, eleifend id, consectetuer nec, purus.
  Vivamus pretium orci ac sapien. Etiam at tortor. Nunc tincidunt mi sed sapien. Etiam lacus pede, fermentum eu, blandit ac, congue eget, metus. Quisque sed sem. Mauris at sapien. Ut
  luctus.</span><br />
  <h4>
    Inline Paragraph
  </h4>
  <p id="myInstance3" style="border: 1px solid #000;">
    This is some text that can be edited in the inline paragraph editor.
  </p>
</div>