<?php
//set database variable
include("dbinfo.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//if  mysqli_connect_errno() is zero no errors occured
//any non zero means a problem
//test DB connection
if( mysqli_connect_errno() !=0 ){
	echo "<p>".$mysqli->connect_error."</p>";
	die("<p>Could not connect to DB.</p>");
}

?>
