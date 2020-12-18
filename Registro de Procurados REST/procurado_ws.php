<?php

	$json = file_get_contents('php://input');
	$array = json_decode($json, true);
	$cpf = $array['cpf'];
	$conexao = new pdo('sqlite:bancodedados.dat');
	$select = "select id from procurado where cpf = '".$cpf."'; ";
	$resultado = $conexao->query($select)->fetchAll();
	if ( count($resultado) > 0 ) {
		$array = [ 'situacao' => 'procurado' ];
	} else {
		$array = [ 'situacao' => 'nada consta' ];
	}
	$json = json_encode($array);
	print $json;
	