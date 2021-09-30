<?php
$DBName = "farmshop";
$DBConnect = mysqli_connect("localhost", "root", "CWB208");
if ($DBConnect === FALSE)      
	echo "<p>Connection error: "  . mysqli_error() . "</p>\n";
else {
	if (mysqli_select_db($DBConnect, $DBName) === FALSE) {           
		echo "<p>Could not select the \"$DBName\" " . "database: " . mysqli_error($DBConnect) ."</p>\n";          
		mysqli_close($DBConnect);         
		$DBConnect = FALSE;     
	}
}
?>