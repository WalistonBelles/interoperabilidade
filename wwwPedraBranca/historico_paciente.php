<?php

	function historico_paciente ( $documento ) {

		$conexao = new pdo('sqlite:bancodedados.data');

		$pesquisa = "select p.unidade, a.diagnostico, a.encaminhamento 
		FROM triagem t JOIN paciente p ON p.id = t.paciente
		JOIN atendimento a ON a.triagem = t.id 
		WHERE p.documento LIKE '%".$documento."%' ORDER BY a.id DESC; ";
		
		/* $pesquisa = "select a.id, t.avaliacao, p.documento, p.nome, p.sexo, 
		a.diagnostico, a.medicamento, a.encaminhamento from triagem t join paciente p on p.id = t.paciente join atendimento a on a.triagem = t.id where p.nome like '%".$_REQUEST['pesquisa']."%' 
		or a.diagnostico like '%".$_REQUEST['pesquisa']."%' 
		or a.medicamento like '%".$_REQUEST['pesquisa']."%' 
		or a.encaminhamento like '%".$_REQUEST['pesquisa']."%' 
		order by a.id desc; "; */

		$resultado = $conexao->query($pesquisa)->fetchAll();

		return $resultado;
	}

	$servidor = new SoapServer( null, ['uri' => 'http://localhost:8081/historico_paciente.php'] ); 
	$servidor->addFunction( 'historico_paciente' );
	$servidor->handle();
?>