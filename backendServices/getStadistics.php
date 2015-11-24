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

	$polls_different = $conn->query("SELECT * FROM pollings p WHERE EXISTS (SELECT 'EXISTS' FROM poll_entered pe WHERE (p.votos_nulos != pe.votos_nulos OR p.votos_blancos != pe.votos_blancos OR p.votos_recurridos != pe.votos_recurridos OR p.votos_impugnados != pe.votos_impugnados OR p.votos_fpv != pe.votos_fpv OR p.votos_cambiemos != pe.votos_cambiemos OR (pe.votos_nulos + pe.votos_blancos + pe.votos_recurridos + pe.votos_impugnados + pe.votos_fpv + pe.votos_cambiemos != pe.total AND pe.total != 0) OR (pe.comentarios IS NOT NULL AND pe.comentarios != '')) AND p.id = pe.polling_id) ORDER BY id DESC");
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