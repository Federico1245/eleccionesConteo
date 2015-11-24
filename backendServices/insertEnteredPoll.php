<?php
	include_once  "dbConfig.php";

	$conn->query("INSERT INTO poll_entered (polling_id, votos_nulos, votos_blancos, votos_recurridos, votos_impugnados, votos_fpv, votos_cambiemos, total, comentarios) VALUES (".$_GET["polling_id"]. 
																																					", \"".$_GET["votos_nulos"].
																																					"\", \"".$_GET["votos_blancos"].
																																					"\", \"".$_GET["votos_recurridos"].
																																					"\", \"".$_GET["votos_impugnados"].
																																					"\", \"".$_GET["votos_fpv"].
																																					"\", \"".$_GET["votos_cambiemos"].
																																					"\", \"".$_GET["total"].
																																					"\", \"".$_GET["comentarios"]."\")");
	$conn->close();
?>