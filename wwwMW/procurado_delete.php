<?php
	$conexao = new pdo ('sqlite:bancodedados.dat');
	$delete = "delete from procurado where id = '".$_REQUEST['id']."'; ";
	$resultado = $conexao->exec($delete);
	if ( $resultado > 0 ) {
		print 'Removido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/procurado_lista.php\';}, 2000);</script>';
	} else {
		print 'Erro na remoção.';
	}
?>