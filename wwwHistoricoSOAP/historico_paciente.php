<?php

	function historico_paciente ( $unidade ) {
		$conexao = new pdo('sqlite:bancodedados.dat');
		$insert = "INSERT INTO historico values (null, 
		'".$unidade."', 
		'".$documento."', 
		datetime('now'), 
		'".$diagnostico."',
		'".$encaminhamento."'); ";   
		$resultado = $conexao->exec($insert);
		return $resultado;
	}

	$servidor = new SoapServer( null, ['uri' => 'http://localhost:8084/historico_paciente.php'] ); 
	$servidor->addFunction( 'historico_paciente' );
	$servidor->handle();

