<?php

	$json = file_get_contents('php://input');
	$array = json_decode($json, true);
    $rg = $array['RG'];
    include 'funcoes.php';
	if ( valida($rg) ) {
		$array = [ 'situacao' => 'válido' ];
	} else {
		$array = [ 'situacao' => 'inválido' ];
	}
	$json = json_encode($array);
	print $json;
	
	