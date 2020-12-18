<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	//$drop = "drop table if exists paciente; ";
	//$conexao->exec($drop);
	$create = "create table if not exists paciente (id integer primary key autoincrement, documento text, nome text, sexo text, nascimento date, email text, fone text, moradia text, copia text, datahora timestamp); ";
	$conexao->exec($create);
	$create = "create table if not exists triagem (id integer primary key autoincrement, paciente integer, celsius integer, bpm integer, pas integer, pad integer, historia text, avaliacao integer, datahora timestamp); ";
	$conexao->exec($create);
	if ( isset( $_FILES['copia']['tmp_name'] ) ) {
		$copia = base64_encode(file_get_contents($_FILES['copia']['tmp_name']));
	} else {
		$copia = '';
	}
	
	$insert = "insert into paciente values (null, '".$_REQUEST['documento']."', '".$_REQUEST['nome']."', '".$_REQUEST['sexo']."', '".$_REQUEST['nascimento']."', '".$_REQUEST['email']."', '".$_REQUEST['fone']."', '".$_REQUEST['moradia']."', '".$copia."', datetime('now') );";
	$resultado1 = $conexao->exec($insert);
	$pid = "select max(id) pid from paciente;";
	$pid = $conexao->query($pid)->fetchAll();
	$pid = $pid[0]['pid'];
	$insert = "insert into triagem values (null, '".$pid."', null, null, null, null, null, null, null);";
	$resultado2 = $conexao->exec($insert);
	if ( $resultado1 > 0 and $resultado2 > 0 ) {
		
		$array = ['cpf' => $_REQUEST['documento']];
		$url = "http://127.0.0.1:83/procurado_ws.php";
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