<?php

	$json = file_get_contents('php://input');
	$array = json_decode($json, true);
    $cpf = $array['CPF'];
    include 'funcoes.php';
	if ( valida($cpf) ) {
		$array = [ 'situacao' => 'válido' ];
	} else {
		$array = [ 'situacao' => 'inválido' ];
	}
	$json = json_encode($array);
	print $json;
	
	