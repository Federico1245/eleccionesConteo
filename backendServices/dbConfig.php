<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databaseName = "elecciones";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	mysqli_select_db($conn, $databaseName);
	mysqli_set_charset($conn, "utf8");

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
?>