<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$drop = "drop table if exists paciente; ";
	$drop = "drop table if exists triagem; ";
	//$conexao->exec($drop);

	// Armazena em 1 variável a Query para criar a Tabela Paciente
	$create = "CREATE TABLE IF NOT EXISTS paciente 
		(id integer primary key autoincrement, 
		documento text, 
		tipo_documento text, 
		nome text, sexo text, 
		nascimento date, 
		email text, 
		fone text, 
		moradia text, 
		copia text, 
		datahora timestamp); ";

	// Executa a Query armazenada na variável $create
	$conexao->exec($create);

	// Armazena em 1 variável a Query para criar a Tabela Triagem
	$create = "CREATE TABLE IF NOT EXISTS triagem 
		(id integer primary key autoincrement, 
		paciente integer, 
		celsius integer, 
		bpm integer, 
		pas integer, 
		pad integer, 
		historia text, 
		avaliacao integer, 
		datahora timestamp); ";

	// Executa a Query armazenada na variável $create
	$conexao->exec($create);

	// Confere se existe algum arquivo enviado no campo copia
	if ( isset( $_FILES['copia']['tmp_name'] ) ) {
		$copia = base64_encode(file_get_contents($_FILES['copia']['tmp_name']));
	} else {
		$copia = '';
	}
	
	// Armazena em 1 variável a Query para inserir dados na tabela Paciente
	$insert = "INSERT INTO paciente VALUES 
		(NULL, 
		'".$_REQUEST['documento']."', 
		'".$_REQUEST['tipo_documento']."', 
		'".$_REQUEST['nome']."', 
		'".$_REQUEST['sexo']."', 
		'".$_REQUEST['nascimento']."', 
		'".$_REQUEST['email']."', 
		'".$_REQUEST['fone']."', 
		'".$_REQUEST['moradia']."', 
		'".$copia."', 
		datetime('now') );";

	// Executa a Query armazenada na variável insert e salva na variável $resultado1 o retorno
	$resultado1 = $conexao->exec($insert);

	// Salva em 1 variável a Query para retornr o maior ID da tabela Paciente
	$pid = "SELECT max(id) pid FROM paciente;";

	// Executa a Query armazenada na variável $pid
	$pid = $conexao->query($pid)->fetchAll();

	// Exibe o 1° valor da variável $pid
	$pid = $pid[0]['pid'];

	// Armazena em 1 variável a Query para inserir dados na tabela Triagem
	$insert = "INSERT INTO triagem VALUES 
		(NULL, '".$pid."', NULL, NULL, NULL, NULL, NULL, NULL, NULL);";

	// Executa a Query armazenada na variável insert e salva na variável $resultado2 o retorno
	$resultado2 = $conexao->exec($insert);
	
	// Confere se o valor da variável $resultado1 e da variável $resultado2 são maiores que 0
	if ( $resultado1 > 0 and $resultado2 > 0 ) {
		
		$array = ['cpf' => $_REQUEST['documento']];
		$url = "http://localhost:81/procurado_ws.php";
		$json = json_encode($array);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		$json = $response;
		$array = json_decode($json, true);
		$situacao = $array['situacao'];
		
		print 'Inserido com sucesso.';
		if ( $situacao == 'procurado' ) {
			print '<script>alert(\'Atenção! Cuidado! Indivíduo procurado.\'); window.setTimeout(function(){window.location=\'/paciente_cadastro.php\';}, 2000);</script>';
		} else {
			print '<script>window.setTimeout(function(){window.location=\'/paciente_cadastro.php\';}, 2000);</script>';
		}
	} else {
		print 'Erro na inserção.';
	}
?>