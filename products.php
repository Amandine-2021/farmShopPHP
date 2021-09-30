<!--CWB 208 PHP Project
	file: products.php
	Amandine Velamala -->

<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
		
		<link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet"> 
	<link href="farmStyles.css" rel="stylesheet">
    <title>Produce - Red Barn Farm</title>
</head>
<body>
 
<?php 
include ("inc_head.html");  
include("inc_db_farmshop.php");
session_start(); 

function validateNumber($data, $fieldName, $max) {
	global $errorCount;		
	if (!is_numeric($data)){
		$statusMsg = "<p>Please enter a number for the quantity of " . $fieldName . "</p>"; 
		++$errorCount;
	}
	else {
		if ($data < 0 || $data > $max) {
			$statusMsg = "<p>Please enter a number between 0 and " . $max .  "(number  currently in stock) for " . $fieldName .".</p>"; 
			++$errorCount;
		}		
	}
}

$TableName = "products";
$SQLstring = "SELECT * FROM $TableName WHERE stock > 0 ORDER BY name ASC";
$QueryResult = @mysqli_query($DBConnect,$SQLstring);
?>
<div class="producePage">
<h1> Today's Products</h1>
<p>Fill the form with the desired quantities and add to the basket at the bottom of the page.<br>Your oder will be ready for pick-up at the farm in a few hours.</p>
		
<?php
if (!empty($QueryResult)) {
?>
	<form action='addToBasket.php' method='post'>
	<div id='flexContainer'>
	<?php
	mysqli_data_seek($QueryResult, 0);
	while ($Row = mysqli_fetch_assoc($QueryResult)) {
	?>
	<div class="productContainer">	
		<div><img src="<?php echo $Row["image"]; ?>"></div>
		<div><?php echo $Row["name"]; ?></div>
		<div><?php echo "$". $Row["price"] . " per " . $Row["unit"]; ?></div>
		<div>Qty: 
			<input type="text" name=<?php echo $Row['id']; ?> 
				value=<?php 
					if (isset($_SESSION['basket'][$Row["id"]]))
						echo $_SESSION['basket'][$Row["id"]];
					else
						echo "0";?> id="quantity"  size = "2"> 
		</div>
		<div class="error"><?php 
			if (isset($_SESSION['errorMsgs'][$Row["id"]]))
					echo $_SESSION['errorMsgs'][$Row["id"]];
				else
					echo "";?>  
		</div> 
	</div>	
	<?php
	}
	?>
	</div>
	<input  class='submitBtn' type='submit' name='add' id='add' value='Add to Basket'>
	</form>
</div>
<?php
}
mysqli_close($DBConnect); 
include ("inc_foot.html"); 
?>
</body>
</html>