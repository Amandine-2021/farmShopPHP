<!--CWB 208 PHP Project
	file: confirmOrder.php
	Amandine Velamala -->
	
<?php
include("inc_db_farmshop.php");
session_start();
	$customerEmail = $_SESSION['customerEmail'];	
	$SQLstring = "INSERT INTO orders (customer_email) VALUES('$customerEmail')";            
	$SQLResult = @mysqli_query($DBConnect, $SQLstring);               
	/*if ($SQLResult === FALSE)
		echo "<p>Unable to insert the order values.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";*/
	$orderID = $DBConnect->insert_id;
	$items = $_SESSION['basket'];
	
	foreach($items as $key => $value) {
		$SQLstring = "INSERT INTO order_items VALUES('$orderID', '$key', '$value')";            
		$SQLResult = @mysqli_query($DBConnect, $SQLstring);
	}
	foreach($items as $key => $value) {
		$query = "SELECT * FROM products WHERE id='$key'";
		$queryResult = mysqli_query($DBConnect, $query);
		$row = mysqli_fetch_array($queryResult);
		$currentStock = $row['stock'];
		$newStock = $currentStock - $value;
		echo "<p>$currentStock</p>";
		echo "<p>$newStock</p>";
		$SQLstring = "UPDATE products
					  SET stock = '$newStock'
					  WHERE id = '$key'";
		$SQLResult = @mysqli_query($DBConnect, $SQLstring);
	}
	header("Location:confirmation.php");
?>
		