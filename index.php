<!--CWB 208 PHP Project
	file: index.php
	Amandine Velamala -->

<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
	<link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet"> 
	<link href="farmStyles.css" rel="stylesheet">
    <title>Home- Red Barn Farm</title>
</head>
<body>
<?php 
include ("inc_head.html");
include("inc_db_farmshop.php");
?> 
<p id="dailymsg" >Produce available today, <?php echo date("F d, Y"); ?>: </br>- 
<?php 			
$TableName = "products";
$SQLstring = "SELECT * FROM $TableName WHERE stock > 0 ORDER BY name ASC";
$QueryResult = @mysqli_query($DBConnect,$SQLstring);
if (!empty($QueryResult)) { 
	while ($Row = mysqli_fetch_assoc($QueryResult)) {
			echo $Row['name'] . " - ";
	}
}	
?>
</p>
<h1>Welcome to the Red Barn Farm</h1>
<div id="homePagePictures">
	<img id="img1" src="images/appleOrchard.jpg" alt="Apple Orchard"> 
	<img id ="img2" src="images/veggies1.jpg" alt="vegetables"> 
</div>
<p>We are a small organic farm, located in the Colorado Western Slope.
	Our region is famous for producing delicious peaches, apples and berries
	In that tradition, our small organic farm is proud to grow a variety of fruits trees as well as many vegetables.</p>

<p>	We believe in the importance of locally grown food, and in sustainable agriculture techniques.
	Organic farming emphasizes the use of renewable resources and the conservation of soil and water to enhance environmental quality for the future. Local agriculture assures a food system that is safe, affordable and accessible by providing vegetables and fruits at their peak of flavor and nutritional value.
</p>
<p>You can order our delicious fruits and vegetables online and pick them up at the farm.
To order, visit our <a href="products.php">Products page.</a>
</p>
<?php 
mysqli_close($DBConnect); 
include ("inc_foot.html"); 
?> 
</body>
</html>
