<!--CWB 208 PHP Project
	file: contact.php
	Amandine Velamala -->
	
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
	<link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet"> 
	<link href="farmStyles.css" rel="stylesheet">
    <title>Contact Us - Red Barn Farm</title>
</head>
<body>
<?php 
include ("inc_head.html");
include("inc_db_farmshop.php"); 

$FirstName = "";
$LastName = "";
$Email = "";
$Message ="";
$FirstNameErrorMsg ="";
$LastNameErrorMsg ="";
$EmailErrorMsg ="";
$MessageErrorMsg ="";
$MessageStatus = "";

function editData($data){
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}
	
if(isset($_POST["submit"])){
	$Errors = 0;
	if (empty($_POST["firstName"])){
		$FirstNameErrorMsg = "Enter your first name.";
		$Errors++;
	}		
	else {
		$FirstName = editData($_POST["firstName"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$FirstName)){
			$FirstNameErrorMsg = "Enter a valid first name.";
			$Errors++;
		}
		else{
			$FirstNameErrorMsg = "";
		}
	}
	if (empty($_POST["lastName"])){
		$LastNameErrorMsg = "Enter your last name.";
		$Errors++;
	}
	else {
		$LastName = editData($_POST["lastName"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$LastName)){
			$LastNameErrorMsg = "Enter a valid last name.";
			$Errors++;
		}
		else
			$LastNameErrorMsg = "";
	}
	if (empty($_POST["email"])){
		$EmailErrorMsg = "Enter your email.";
		$Errors++;
	}
	else {
		$Email = editData($_POST["email"]);
		$pattern =   "/^[\w-]+(\.[\w-]+)*@" . "[\w-]+(\.[\w-]+)*(\.[[A-Za-z]{2,})$/i";
		if (preg_match($pattern, $Email)== 0){         
			$EmailErrorMsg = "Enter a valid e-mail address.";
			$Errors++;
		}
		else
			$EmailErrorMsg = "";
	}
	if (empty($_POST["message"])){
		$MessageErrorMsg = "Enter your message.";
		$Errors++;
	}
	else {
		$Message = editData($_POST["message"]);
		$MessageErrorMsg = "";
	}
    
	if ($Errors == 0){
		$TableName = "messages";
		$SQLstring = "SHOW TABLES LIKE '$TableName'";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring);
		if (@mysqli_num_rows($QueryResult) == 0) {    
			$SQLstring = "CREATE TABLE $TableName (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, dateReceived DATETIME DEFAULT CURRENT_TIMESTAMP, firstName VARCHAR(35), lastName VARCHAR(35), email VARCHAR(150), message VARCHAR(2000))";
			$QueryResult = @mysqli_query($DBConnect, $SQLstring);    
		}	
		$SQLinsert = "INSERT INTO $TableName (firstName, lastName, email, message) VALUES('$FirstName', '$LastName', '$Email', '$Message')";            
		$InsertResult = @mysqli_query($DBConnect, $SQLinsert);               
		if ($InsertResult === FALSE)
			echo "<p>Unable to insert the survey values.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";               
		else {
			echo "<p id='statusMsg'>Thanks for contacting us, $FirstName . 
					We will get back to you soon!<br>
					Have a great day!  Your friends at Red Barn Farm.</p>";				
		}
		$FirstName = "";
		$LastName = "";
		$Email = "";
		$Message = "";			
	}	
}
?>
<div id="contactPage">
<h1>Contact Us</h1>
	<form id="contactForm" method="POST" action="contact.php">
	<p>Please fill this from with your message or questions</p>
		<p><label>First Name</label><br>
			<input type="text" name="firstName" value=<?php echo $FirstName;?>>
			<span class="error"><?php echo $FirstNameErrorMsg;?></p>
		<p><label>Last Name</label><br>
			<input type="text" name="lastName" value=<?php echo $LastName;?>>
			<span class="error"><?php echo $LastNameErrorMsg;?></p>
		<p><label>E-mail</label><br>
			<input type="text" name="email" value=<?php echo $Email;?>>
			<span class="error"><?php echo $EmailErrorMsg;?></p>
		<p><label>Message</label><br>
			<textarea name="message"><?php echo $Message;?></textarea>
			<div class="error"><?php echo $MessageErrorMsg;?></div></p>
		<p><input class="submitBtn" type="submit" name="submit" value="Submit" /></p>
	</form>
</div>
<?php
mysqli_close($DBConnect); 
include ("inc_foot.html"); 
?>
</body>
</html> 