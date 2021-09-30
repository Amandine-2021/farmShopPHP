<!--<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
    <title>Create Products Table</title>
</head>
<html>
<body>-->
<?php
include("inc_db_farmshop.php");
if ($DBConnect !== FALSE) { 
	$TableName = "products";
	$SQLstring = "SHOW TABLES LIKE '$TableName'";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if (@mysqli_num_rows($QueryResult) == 0) {    
		$SQLstring = "CREATE TABLE $TableName (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(25), price FLOAT, unit VARCHAR(25), image VARCHAR(250), stock INT )";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring);    
		if ($QueryResult === FALSE)
			echo "<p>Unable to create the ". $TableName ." </p>" . "<p>Error code " . mysqli_errno($DBConnect)  . ": " . mysqli_error($DBConnect) . "</p>";
		else 
			echo "<p>Successfully created the "  . $TableName . " table.</p>";
	}
	else     
		echo "<p>The " . $TableName . " table already exists.</p>";
	
	$TableName = "orders";
	$SQLstring = "SHOW TABLES LIKE '$TableName'";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if (@mysqli_num_rows($QueryResult) == 0) {    
		$SQLstring = "CREATE TABLE $TableName (order_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, customer_email VARCHAR(150), order_date DATETIME DEFAULT CURRENT_TIMESTAMP )";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring);    
		if ($QueryResult === FALSE)
			echo "<p>Unable to create the ". $TableName ." </p>" . "<p>Error code " . mysqli_errno($DBConnect)  . ": " . mysqli_error($DBConnect) . "</p>";
		else 
			echo "<p>Successfully created the "  . $TableName . " table.</p>";
	}
	else     
		echo "<p>The " . $TableName . " table already exists.</p>";
	
	$TableName = "order_items";
	$SQLstring = "SHOW TABLES LIKE '$TableName'";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if (@mysqli_num_rows($QueryResult) == 0) {    
		$SQLstring = "CREATE TABLE $TableName(order_id INT, item_id INT, quantity INT NOT NULL, PRIMARY KEY (order_id, item_id))";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring);    
		if ($QueryResult === FALSE)
			echo "<p>Unable to create the ". $TableName ." </p>" . "<p>Error code " . mysqli_errno($DBConnect)  . ": " . mysqli_error($DBConnect) . "</p>";
		else 
			echo "<p>Successfully created the "  . $TableName . " table.</p>";
	}
	else     
		echo "<p>The " . $TableName . " table already exists.</p>";
	
	
	mysqli_close($DBConnect);
}

?>
<!--</body>
</html>-->