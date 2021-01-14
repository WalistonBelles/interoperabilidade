<?php

	function historico_paciente ( $documento ) {

		$conexao = new pdo('sqlite:bancodedados.data');

		$pesquisa = "SELECT `p.unidade`, `a.diagnostico`, `a.encaminhamento` 
		FROM `triagem` t JOIN `paciente` p ON `p.id` = `t.paciente` 
		JOIN `atendimento` a ON `a.triagem` = `t.id` 
		WHERE `p.nome` LIKE '%" . $documento . "%' ORDER BY `a.id` DESC; ";

		$resultado = $conexao->query($pesquisa)->fetchAll();

		return $resultado;
	}

	$servidor = new SoapServer( null, ['uri' => 'http://localhost:8084/historico_paciente.php'] ); 
	$servidor->addFunction( 'historico_paciente' );
	$servidor->handle();
?>