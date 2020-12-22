<?php

	$json = file_get_contents('php://input');
	$array = json_decode($json, true);
    $passaporte = $array['Passaporte'];
    include 'funcoes.php';
	if ( valida($passaporte) ) {
		$array = [ 'situacao' => 'válido' ];
	} else {
		$array = [ 'situacao' => 'inválido' ];
	}
	$json = json_encode($array);
	print $json;
	
	