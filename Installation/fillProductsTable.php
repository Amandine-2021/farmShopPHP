<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"     
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=utf-8" />
    <title>Fill Products Table</title>
</head>
<html>
<body>-->
<?php
include("inc_db_farmshop.php");

$SQLstring = "INSERT INTO products (name, price, unit, image, stock) 
			VALUES 
			('beets', 3, 'bunch', 'images/beets.jpg', 100),   
			('carrots', 2, 'bunch', 'images/carrots.jpg', 120),
			('buternut squash', 1.5, 'lb', 'images/butternut.jpg', 120),
			('onions', 1, 'lb', 'images/onions.jpg', 20),
			('tomatoes', 3, 'lb', 'images/tomatoes.jpg', 120),
			('apples', 2, 'lb', 'images/apples.jpg', 120),
			('zucchini', 2, 'lb', 'images/zucchini.jpg', 100),
			('apricots', 2.5, 'lb', 'images/apricots.jpg', 100),
			('cucumbers', 1.5, 'lb', 'images/cucumbers.jpg', 0),
			('plums', 2.5, 'lb', 'images/plums.jpg', 100),
			('peaches', 3, 'lb', 'images/peaches.jpg', 100),
			('aspargus', 2, 'bunch', 'images/aspargus.jpg', 100),
			('kale', 1.5, 'bunch', 'images/kale.jpg', 100);";

$QueryResult = @mysqli_query($DBConnect, $SQLstring);
if ($QueryResult === FALSE)      
	echo "<p>Unable to execute the query.</p>"  ."<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
else     
	echo "<p>Successfully updated the table. </p>";
mysqli_close($DBConnect);
?>
