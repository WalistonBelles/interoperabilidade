<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select t.id, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade from triagem t join paciente p on p.id = t.paciente where t.avaliacao is null order by p.datahora; ";
	$resultado = $conexao->query($pesquisa)->fetchAll();
	if ( count($resultado) == 0 ) {
		require 'menu.php';
		print 'Parabéns! Não há triagens pendentes.';
		print '<script>window.setTimeout(function(){window.location=\'/triagem_lista.php\';}, 2000);</script>';
	} else {
?>
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
		<table border="1">
			<caption>Triagens Pendentes</caption>
			<tr>
				<th>Documento</th>
				<th>Nome</th>
				<th>Sexo</th>
				<th>Idade</th>
				<th></th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['documento']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['sexo']; ?></td>
				<td><?php print $tupla['idade']; ?></td>
				<td><a href="/triagem_cadastro.php?id=<?php print $tupla['id']; ?>">Avaliar</a></td>
			</tr>
<?php
		}
?>
		</table>
	</body>
</html>
<?php
	}
?>