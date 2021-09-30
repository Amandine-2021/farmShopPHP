<!--CWB 208 PHP Project
	file: confirmation.php
	Amandine Velamala -->
	
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
	<link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet"> 
	<link href="farmStyles.css" rel="stylesheet">
    <title>Thank you - Red Barn Farm</title>
</head>
<body>
<?php 
include ("inc_head.html");
session_start();
unset($_SESSION['basket']);
unset($_SESSION['customerFirstName']);
unset($_SESSION['customerLastName']);
unset($_SESSION['customerEmail']);

?>
<h1>Order Confirmation</h1>
<div class="center">
<p>Thank you for your order.</p>
<p>We will email you to let you know when your order is ready for pick-up.</p>
<!--<img src="images/redBarn.jpg" alt="Red Barn">-->
<img src="images/vegetables.jpg" alt="Red Barn">
</div>

<?php 
include ("inc_foot.html"); 
?> 
</body>
<html>