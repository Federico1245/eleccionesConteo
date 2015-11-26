<?php
	include_once  "dbConfig.php";

	$conn->query("INSERT INTO poll_entered (polling_id, votos_nulos, votos_blancos, votos_recurridos, votos_impugnados, votos_fpv, votos_cambiemos, total, comentarios, rating) VALUES (".$_GET["polling_id"]. 
																																					", \"".$_GET["votos_nulos"].
																																					"\", \"".$_GET["votos_blancos"].
																																					"\", \"".$_GET["votos_recurridos"].
																																					"\", \"".$_GET["votos_impugnados"].
																																					"\", \"".$_GET["votos_fpv"].
																																					"\", \"".$_GET["votos_cambiemos"].
																																					"\", \"".$_GET["total"].
																																					"\", \"".$_GET["comentarios"]."\", 0)");

	$result = $conn->query("SELECT * FROM pollings p WHERE p.id = ".$_GET["polling_id"]);
	$poll = $result->fetch_assoc();

	$inconsistent = false;

	if (trim($_GET["comentarios"]) != null)
		$inconsistent = true;
	if ($_GET["votos_nulos"] + $_GET["votos_blancos"] + $_GET["votos_recurridos"] + $_GET["votos_impugnados"] + $_GET["votos_fpv"] + $_GET["votos_cambiemos"] != $_GET["total"] )
		$inconsistent = true;
	if ($_GET["votos_nulos"] != $poll["votos_nulos"] || $_GET["votos_blancos"] != $poll["votos_blancos"] || $_GET["votos_recurridos"] != $poll["votos_recurridos"] || $_GET["votos_impugnados"] != $poll["votos_impugnados"] || $_GET["votos_fpv"] != $poll["votos_fpv"] || $_GET["votos_cambiemos"] != $poll["votos_cambiemos"])
		$inconsistent = true;

		if ($inconsistent)
			echo "1";
		else
			echo "0";

	$result->close();
	$conn->close();
?>