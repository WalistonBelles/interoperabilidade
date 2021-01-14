<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select t.id, t.avaliacao, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade from triagem t join paciente p on p.id = t.paciente where t.avaliacao is not null and (select count(*) from atendimento where triagem = t.id) = 0 order by t.avaliacao desc, p.datahora; ";
	$resultado = $conexao->query($pesquisa)->fetchAll();
	if ( count($resultado) == 0 ) {
		require 'menu.php';
		print 'Parabéns! Não há atendimentos pendentes.';
		print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
	} else {
?>
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
		<center> <h2> Pronto Atendimento Pedra Branca </h2> </center>
		<table border="1">
			<caption>Atendimentos Pendentes</caption>
			<tr>
				<th>Documento</th>
				<th>Nome</th>
				<th>Sexo</th>
				<th>Idade</th>
				<th>Avaliação de Risco</th>
				<th></th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
			$avaliacao = '';
			switch ( $_REQUEST['avaliacao'] ) {
				case 3:
					$avaliacao = 'Alto';
					break;
				case 2:
					$avaliacao = 'Médio';
					break;
				case 1:
					$avaliaxao = 'Baixo';
					break;
				case 0:
					$avaliacao = 'Eletivo';
					break;
				default:
					throw Exception ('Risco inválido.');
			}
?>
			<tr>
				<td><?php print $tupla['documento']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['sexo']; ?></td>
				<td><?php print $tupla['idade']; ?></td>
				<td><?php print $avaliacao; ?></td>
				<td><a href="/atendimento_cadastro.php?id=<?php print $tupla['id']; ?>">Atender</a></td>
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