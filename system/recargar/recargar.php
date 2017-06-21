<?php
//-------------------------------------------------------
// GENERAL********************************************
//-------------------------------------------------------
	$consul = paraTodos::arrayConsulta("*", "recargar", "id=$idMenut");
	foreach ($consul as $row){
		$opcion = $row[actd];
	}
	if($opcion == '1'){

	}
?>
