<?php
	include_once  "dbConfig.php";

	function getArrayFromResult($result) {
		$resultsArray = array();

		while ($row = $result->fetch_assoc()) {
			array_push($resultsArray, $row);	
		}

		return $resultsArray;
	}

	$retval = [];

	$polls_different = $conn->query("SELECT p.id, pe.id as poll_entered_id, p.url, p.distrito, p.seccion, p.circuito, p.mesa, p.votos_nulos as votos_nulos_real, p.votos_blancos as votos_blancos_real, p.votos_recurridos as votos_recurridos_real, p.votos_impugnados as votos_impugnados_real, p.votos_fpv as votos_fpv_real, p.votos_cambiemos as votos_cambiemos_real, p.distrito_nombre, p.seccion_nombre, pe.votos_nulos as votos_nulos_entry, pe.votos_blancos as votos_blancos_entry, pe.votos_recurridos as votos_recurridos_entry, pe.votos_impugnados as votos_impugnados_entry, pe.votos_fpv as votos_fpv_entry, pe.votos_cambiemos as votos_cambiemos_entry, pe.total, pe.comentarios, pe.rating
									FROM pollings p INNER JOIN poll_entered pe ON p.id = pe.polling_id WHERE (p.votos_nulos != pe.votos_nulos OR p.votos_blancos != pe.votos_blancos OR p.votos_recurridos != pe.votos_recurridos OR p.votos_impugnados != pe.votos_impugnados OR p.votos_fpv != pe.votos_fpv OR p.votos_cambiemos != pe.votos_cambiemos OR (pe.votos_nulos + pe.votos_blancos + pe.votos_recurridos + pe.votos_impugnados + pe.votos_fpv + pe.votos_cambiemos != pe.total AND pe.total != 0) OR (pe.comentarios IS NOT NULL AND pe.comentarios != '')) ORDER BY pe.id DESC");
	$retval['differences'] = $polls_different->num_rows;
	$retval['polls'] = getArrayFromResult($polls_different);
	$polls_different->close();

	$polls_total = $conn->query("SELECT COUNT(*) FROM pollings");
	$retval['total'] = $polls_total->fetch_row()[0];
	$polls_total->close();

	$entered_total = $conn->query("SELECT COUNT(*) FROM poll_entered");
	$retval['entered'] = $entered_total->fetch_row()[0];
	$entered_total->close();

	echo json_encode($retval);
	$conn->close();

?>