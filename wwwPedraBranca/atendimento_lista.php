<?php
	$conexao = new pdo('sqlite:bancodedados.data');

	$pesquisa = "select t.id, t.avaliacao, p.documento, p.unidade, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade from triagem t join paciente p on p.id = t.paciente where t.avaliacao is not null and (select count(*) from atendimento where triagem = t.id) = 0 order by t.avaliacao desc, p.datahora; ";
	$resultado = $conexao->query($pesquisa)->fetchAll();
	if ( count($resultado) == 0 ) {
		require 'menu.php';
		print '<br><br><center>Parabéns! Não há atendimentos pendentes.</center>';
		print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
	} else {
?>
<html>
		<?php
			require 'menu.php';
		?>
		</br></br>
		<table border="1">
			<caption>Atendimentos Pendentes</caption>
			<tr>
				<th>Documento</th>
				<th>Nome</th>
				<th>Sexo</th>
				<th>Idade</th>
				<th>Avaliação de Risco</th>
				<th colspan="2">Operações</th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
			$avaliacao = '';
			
		switch ( $tupla['avaliacao'] ) {
			case 3:
				$avaliacao = 'red';
				break;
			case 2:
				$avaliacao = 'yellow';
				break;
			case 1:
				$avaliaxao = 'green';
				break;
			case 0:
				$avaliacao = 'lightBlue';
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