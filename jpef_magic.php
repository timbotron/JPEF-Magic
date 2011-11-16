<?php
/*
 * JPEF-Magic v1.0.0
 * http://github.com/timbotron/JPEF-Magic
 *
 * Author: Tim Habersack (tim@hithlonde.com - http://tim.hithlonde.com)
 * Licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License.
 *
 * Date: 2011.09.29
 */

#First we see if there is any injection trickery going on
if(eregi("(\r|\n)", $_POST['sender_email']))
{
	header("Location: ".$_POST['on_fail']);
	exit;
}

 #Generate the email!
$to      = $_POST['sender_email'];
$subject = $_POST['email_subject'];
$message = $_POST['email_body'];
$headers = 'From: '. $_POST['from_email'] . "\r\n" .			
			'BCC: '. $_POST['to_email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers))
{
	$_POST['email_body'] = str_replace("\n","<br />",$_POST['email_body']);
?>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#the_form").submit();
	
});
</script>
</head>
<body>
<form id="the_form" action=<?php echo '"'.$_POST['on_success'].'"';?> method="POST">
<input type="hidden" name="email_body" value=<?php echo '"'.$_POST['email_body'].'"';?> />
</form>
</body>
</html>
<?php
	exit;
}
	header("Location: ".$_POST['on_fail']);
	exit;
 
?>
