<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select t.id, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade from triagem t join paciente p on p.id = t.paciente where t.id = '".$_REQUEST['id']."' and t.avaliacao is not null ";
	$resultado = $conexao->query($pesquisa)->fetchAll();
	$tupla = $resultado[0];
	$avaliacao = '';
	switch ( $_REQUEST['avaliacao'] ) {
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
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
		<table>
			<caption>Dados do Paciente</caption>
			<tr>
				<th>Triagem</th>
				<td><?php print $tupla['id']; ?></td>
			</tr>
			<tr>
				<th>Nome</th>
				<td><?php print $tupla['nome']; ?></td>
			</tr>
			<tr>
				<th>Sexo</th>
				<td><?php print $tupla['sexo']; ?></td>
			</tr>
			<tr>
				<th>Idade</th>
				<td><?php print $tupla['idade']; ?></td>
			</tr>
		</table>
		<br/>
		<table>
			<caption>Dados da Triagem</caption>
			<tr>
				<th>ºC</th>
				<td><?php print $tupla['celsius']; ?></td>
			</tr>
			<tr>
				<th>BPM</th>
				<td><?php print $tupla['bpm']; ?></td>
			</tr>
			<tr>
				<th>PAS</th>
				<td><?php print $tupla['pas']; ?></td>
			</tr>
			<tr>
				<th>PAD</th>
				<td><?php print $tupla['pad']; ?></td>
			</tr>
			<tr>
				<th>História</th>
				<td><?php print $tupla['historia']; ?></td>
			</tr>
			<tr>
				<th>Risco</th>
				<td style="background-color: <?php print $avaliacao; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			</tr>
		</table>
		<form method="post" action="atendimento_insert.php">
			<input type="hidden" name="triagem" value="<?php print $tupla['id']; ?>" />
			<frameset>
				<legend>Cadastro de Atendimento</legend>
				<p>
					<input name="diagnostico" type="text" placeholder="Diagnóstico" />
				</p>
				<p>
					<input name="medicamento" type="text" placeholder="Prescrição de Medicamentos" />
				</p>
				<p>
					<input name="encaminhamento" type="text" placeholder="Encaminhamento" />
				</p>
				<p>
					<input type="submit" value="Confirmar" />
					<input type="reset" value="Cancelar" />
				</p>
			</frameset>
		</form>
	</body>
</html>