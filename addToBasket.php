<!--CWB 208 PHP Project
	file: addToBasket.php
	Amandine Velamala -->

<?php 
include("inc_db_farmshop.php");

session_start();

$_SESSION['errorMsgs'] = array();

function validateNumber($data, $id, $max) {
	global $errorCount;		
	if (!is_numeric($data)){
		$_SESSION['errorMsgs'][$id] = "Enter a number for the quantity";
		$errorCount++;
	}
	else if (is_float($data + 0)){
		$_SESSION['errorMsgs'][$id] = "Enter a whole number for the quantity";
		$errorCount++;
	}
	else {
		if ($data < 0) {
			$_SESSION['errorMsgs'][$id] = "Enter a positive number."; 
			$errorCount++;
		}
		if($data > $max) {
			$_SESSION['errorMsgs'][$id] = "Enter a number between 0 and " . $max . ".<br>(" . $max . " left in stock)"; 
			$errorCount++;
		}			
	}
}

if(isset($_POST['add'])) {
	$items = $_POST;
	$errorCount = 0;
	if(!isset($_SESSION['basket'])) {
		$_SESSION['basket'] = [];
	}
	foreach($items as $key => $value) {
		if ($value !== NULL && $key != "add"){
			echo "<p>key: $key</p>";
			$SQLstring = "SELECT stock FROM products WHERE id = $key";
			$SQLResult = @mysqli_query($DBConnect,$SQLstring);	 
			$stock = mysqli_fetch_assoc ($SQLResult)["stock"];
			validateNumber($value, $key, $stock);
			if ($value == 0){
				if (array_key_exists($key, $_SESSION['basket'])) 
					unset($_SESSION['basket'][$key]); 
			}
			else 
				$_SESSION['basket'][$key] = $value;			
		}	
	}
}		
if ($errorCount > 0) {	
	header("Location:products.php");
	$errorCount = 0;
}
else {
	header("Location:basket.php");
}	
?>
