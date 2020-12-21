<?php
	require_once('database.php');

	// Confere se existem arquivos enviados como Cópia de Documentos
	if ( isset( $_FILES['copia']['tmp_name'] ) ) {
		$copia = base64_encode(file_get_contents($_FILES['copia']['tmp_name']));
	} else {
		$copia = '';
	}

	$agora = date('d/m/Y H:i');
	$insert = "INSERT INTO paciente values (null, 
	'".$_REQUEST['documento']."',
	'".$_REQUEST['nome']."',
	'".$_REQUEST['sexo']."',
	'".$_REQUEST['nascimento']."',
	'".$_REQUEST['email']."',
	'".$_REQUEST['fone']."',
	'".$_REQUEST['moradia']."',
	'".$copia."',
	'".$agora."');";
	if ($conn->query($insert) === TRUE) {
		echo "New record created successfully";
		} else {
		echo "Error: " . $insert . "<br>" . $conn->error;
	}

	$sql = "SELECT MAX(id) as id FROM paciente";
	$sql1 = $conn->query($sql);
	$row = $sql1->fetch_assoc();
	$last_id = $row["id"];
	$insert2 = "INSERT INTO triagem values (null, 
	'".$last_id."', null, null, null, null, null, null, null);";
	if ($conn->query($insert2) === TRUE) {
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/paciente_cadastro.php\';}, 2000);</script>';
		} else {
		echo "Error: " . $insert2 . "<br>" . $conn->error;
	}
?>