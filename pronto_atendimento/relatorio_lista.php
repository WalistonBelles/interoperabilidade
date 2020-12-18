<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$pesquisa = "select a.id, t.avaliacao, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade, a.diagnostico, a.medicamento, a.encaminhamento from triagem t join paciente p on p.id = t.paciente join atendimento a on a.triagem = t.id order by a.id desc; ";
	if ( isset($_REQUEST['pesquisa']) ) {
		$pesquisa = "select a.id, t.avaliacao, p.documento, p.nome, p.sexo, ( (strftime('%Y', 'now') - strftime('%Y', p.nascimento)) - (strftime('%m-%d', 'now') < strftime('%m-%d', p.nascimento))) idade, a.diagnostico, a.medicamento, a.encaminhamento from triagem t join paciente p on p.id = t.paciente join atendimento a on a.triagem = t.id where p.nome like '%".$_REQUEST['pesquisa']."%' or a.diagnostico like '%".$_REQUEST['pesquisa']."%' or a.medicamento like '%".$_REQUEST['pesquisa']."%' or a.encaminhamento like '%".$_REQUEST['pesquisa']."%' order by a.id desc; ";
	}
	$resultado = $conexao->query($pesquisa)->fetchAll();
?>
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
		<form method="post">
			<frameset>
				<caption>Pesquisa</caption>
				<input type="text" name="pesquisa" />
				<input type="submit" value="Pesquisar" />
			</frameset>
		</form>
		<table border="1">
			<caption>Relatório de Atendimentos Concluídos</caption>
			<tr>
				<th>Registro</th>
				<th>Nome</th>
				<th>Sexo</th>
				<th>Idade</th>
				<th>Avaliação de Risco</th>
				<th>Diagnóstico</th>
				<th>Medicamentos</th>
				<th>Encaminhamento</th>
			</tr>
<?php
		foreach ( $resultado as $tupla ) {
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
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['sexo']; ?></td>
				<td><?php print $tupla['idade']; ?></td>
				<td style="background-color: <?php print $avaliacao; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				<td><?php print $tupla['diagnostico']; ?></td>
				<td><?php print $tupla['medicamento']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
			</tr>
<?php
		}
?>
		</table>
	</body>
</html>