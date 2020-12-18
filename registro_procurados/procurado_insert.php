<?php
	$conexao = new pdo ('sqlite:bancodedados.dat');
	$insert = "insert into procurado values ( null, '".$_REQUEST['cpf']."', '".$_REQUEST['nome']."', date('now') );";
	$resultado = $conexao->exec($insert);
	if ( $resultado > 0 ) {
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/procurado_cadastro.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}
?>