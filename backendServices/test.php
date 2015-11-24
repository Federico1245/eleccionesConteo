<?php
	include_once  "dbConfig.php";

	$results = $conn->query("SELECT * FROM pollings LIMIT 1");

	$jsonRow = array();
	while ($row = $results->fetch_assoc()) {
	    $jsonRow[] = $row;
	}

	echo json_encode($jsonRow);

	$results->close();
	$conn->close();
?>