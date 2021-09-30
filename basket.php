<!--CWB 208 PHP Project
	file: basket.php
	Amandine Velamala -->
	
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
		<link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet"> 
	<link href="farmStyles.css" rel="stylesheet">
    <title>Basket - Red Barn Farm</title>
</head>
<html>
<body>

<?php 
include ("inc_head.html");  
include("inc_db_farmshop.php");
session_start();

function editData($data){
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}
$ErrorMsg = "";
if(isset($_POST["confirm"])){
	$Errors = 0;
	if (empty($_POST["firstName"])){
		$ErrorMsg .= "Enter your first name.<br>";
		$Errors++;
	}
	else 	
	{
		$_SESSION['customerFirstName'] = editData($_POST["firstName"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$_SESSION['customerFirstName'])){
			$ErrorMsg .= "Enter a valid first name.<br>";
			$Errors++;
		}
	}
	if (empty($_POST["lastName"])){
		$ErrorMsg .= "Enter your last name.<br>";
		$Errors++;
	}
	else {
		$_SESSION['customerLastName'] = editData($_POST["lastName"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$_SESSION['customerLastName'])){
			$ErrorMsg .= "Enter a valid last name.<br>";
			$Errors++;
		}
	}
	if (empty($_POST["email"])){
		$ErrorMsg .= "Enter your email.<br>";
		$Errors++;
	}
	else {
		$_SESSION['customerEmail'] = editData($_POST["email"]);
		$pattern =   "/^[\w-]+(\.[\w-]+)*@" . "[\w-]+(\.[\w-]+)*(\.[[A-Za-z]{2,})$/i";
		if (preg_match($pattern, $_SESSION['customerEmail'])== 0){         
			$ErrorMsg .= "Enter a valid e-mail address.";
			$Errors++;
		}
	}
	if ($Errors == 0)
		header("Location:confirmOrder.php");
}
?>
	
<h1>Your Basket</h1>
<?php
if(isset($_SESSION['basket']) && count($_SESSION['basket']) != 0) {
	$items = $_SESSION['basket'];
	$grandTotal = 0;
	?><table id="receipt">
		<thead>
			<tr>
				<th class="imageCell">Produce</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
	<?php  
	foreach ($items as $key => $value){
		$id = $key;
		$quantity = $value;
		
		$query  = "SELECT * FROM products WHERE id='$id'";
		$queryResult = mysqli_query($DBConnect, $query);

		if(mysqli_num_rows($queryResult) == 1) {
			$row = mysqli_fetch_array($queryResult);
			$image = $row['image'];
			$id = $row['id'];
			$name = $row['name'];
			$price = $row['price'];
			$unit = $row['unit'];
			$total = number_format($quantity * $price, 2);
			$grandTotal += $total;
			?>
			<tr>
				<td><img class="imageReceipt" src="<?php echo $image; ?>"></td>
				<td ><?php echo $name ?></td>
				<td><?php echo $quantity ?></td>
				<td><?php echo "$" . $price . " / " . $unit ?></td>
				<td class="total"><?php echo "$ " . $total; ?></td>
			</tr>
			<?php   
		}
	}
	$grandTotal = number_format($grandTotal, 2);
	?>
	<tr>
		<td></td><td></td><td></td>
		<td class="totalCell">Total due:</td>
		<td class="total totalCell"><?php echo "$ " . $grandTotal;?></td>
	</tr>
	</tbody>
	</table>
	
	<p class="center">If you want to change your basket, <a href="products.php">edit your order.</a></p>
	<p class="center">To confirm your order, complete and submit this form</p>
	
	<form id ="customerInfo" action="basket.php" method="post">
		<p class="error"><?php echo $ErrorMsg; ?></p>
		<p> <label>First Name</label><br>
			<input type="text" name="firstName" 
				value="<?php if (isset($_SESSION['customerFirstName']))
								echo $_SESSION['customerFirstName'];
							else
								echo"";?>"></p>
		<p> <label>Last Name</label><br>
			<input type="text" name="lastName" 
					value="<?php if (isset($_SESSION['customerLastName']))
							echo $_SESSION['customerLastName'];
						else
							echo"";?>"></p>
		<p> <label>Email (to confirm when your oder is ready for pick-up)</label><br>
			<input type="text" name="email" 
					value="<?php if (isset($_SESSION['customerEmail']))
							echo $_SESSION['customerEmail'];
						else
							echo"";?>"></p>
		<input class="submitBtn" type="submit" name="confirm" value="Confirm order" />
	</form>
	
	<?php
}		
else {
  echo("<h2>You don't have any items in your basket.</h2>");
  echo "<p>Select your items on our <a href='products.php'>Products page</a></p>";
}
include ("inc_foot.html"); 
?>
</body>
</html>