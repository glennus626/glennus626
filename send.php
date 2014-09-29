<?php
$my_email = "put your email address here";
$continue = "/";
if ($_SERVER['REQUEST_METHOD'] != "POST"){exit;}
// Check referrer is from same site.
if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){print "Please enable referrer logging to use this contact form.  Your message was not sent."; exit;}
// Describe function to check for new lines.
function new_line_check($a)
{
if(preg_match('`[\r\n]`',$a)){header("location: $_SERVER[HTTP_REFERER]");exit;}
}
new_line_check($_POST['Name']);
// Check for disallowed characters in the Name and Email fields.
$disallowed_name = array(':',';','"','=','(',')','{','}','@');
foreach($disallowed_name as $value)
{
if(stristr($_POST['Name'],$value)){header("location: $_SERVER[HTTP_REFERER]");exit;}
}
new_line_check($_POST['Email']);
$disallowed_email = array(':',';',"'",'"','=','(',')','{','}');
foreach($disallowed_email as $value)
{
if(stristr($_POST['Email'],$value)){header("location: $_SERVER[HTTP_REFERER]");exit;}
}
$message = "";
// This line prevents a blank form being sent, and builds the message.
foreach($_POST as $key => $value){if(!(empty($value))){$set=1;}$message = $message . "$key: $value\n\n";} if($set!==1){header("location: $_SERVER[HTTP_REFERER]");exit;}

$message = $message . "-- \mail from your website";
$message = stripslashes($message);
$subject = "quote from Freight Brokerage";
$headers = "From: " . $_POST['Email'] . "\n" . "Return-Path: " . $_POST['Email'] . "\n" . "Reply-To: " . $_POST['Email'] . "\n";
mail($my_email,$subject,$message,$headers);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Thank You !.</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="thankyou">
<h2>Thank you !</h2>
<p>Your message has been sent.</p>
<p>You will be contacted within the next 24 hours.</p>
<p>Thank you for using our services.</p>
<p>&nbsp;</p>
<p><a href="index.html">RETURN TO OUR HOMEPAGE</a> </p>
</div>
</body>
</html>