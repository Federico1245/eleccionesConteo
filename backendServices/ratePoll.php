<?php
	include_once  "dbConfig.php";

	if ($_GET['action'] == 'add')
		$conn->query("UPDATE poll_entered SET rating = rating + 1 WHERE id = '".$_GET['id']."'");
	else
		$conn->query("UPDATE poll_entered SET rating = rating - 1 WHERE id = '".$_GET['id']."'");

	echo $conn->error;

	$conn->close();
?>