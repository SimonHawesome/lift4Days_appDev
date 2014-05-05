<?php
$database = "localhost";
$dbuser = "simonha";
$dbpassword = "password";
$dbname = "lift_4_days";

$connection = mysqli_connect($database, $dbuser, $dbpassword, $dbname);

if(mysqli_connect_errno()){
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}
?>