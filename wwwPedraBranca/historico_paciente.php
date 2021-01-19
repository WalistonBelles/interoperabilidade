<?php

	function history ( $document ) {

		$conn = new pdo('sqlite:bancodedados.data');

		$search = "select p.unidade, p.datahora, a.diagnostico, a.encaminhamento 
		FROM triagem t JOIN paciente p ON p.id = t.paciente
		JOIN atendimento a ON a.triagem = t.id 
		WHERE p.documento LIKE '%".$document."%' ORDER BY a.id DESC; ";

		$result = $conn->query($search)->fetchAll();

		return $result;
	}

	$server = new SoapServer( null, ['uri' => 'http://localhost:8081/historico_paciente.php'] ); 
	$server->addFunction( 'history' );
	$server->handle();
?>