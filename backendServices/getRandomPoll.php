<?php
	include_once  "dbConfig.php";

	$results = $conn->query("SELECT * FROM pollings p WHERE p.id NOT IN (SELECT pe.id FROM poll_entered pe) ORDER BY RAND() LIMIT 1");

	$jsonRow = array();
	while ($row = $results->fetch_assoc()) {
	    $jsonRow[] = $row;
	}

	echo json_encode($jsonRow);

	$results->close();
	$conn->close();
?>