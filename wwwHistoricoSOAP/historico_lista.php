<?php
	$conexao = new pdo('sqlite:bancodedados.dat');

	require_once 'initialize_database.php';
	initialize_database( $conexao );

	$select = "SELECT unidade, diagnostico, encaminhamento FROM historico GROUP BY unidade order by unidade; ";
	$resultado = $conexao->query($select)->fetchAll();

	unset( $conexao );
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<h2>Histórico de Pacientes</h2>
		<table border="1">
			<caption>Histórico</caption>
			<tr>
				<td>Unidade</td>
				<td>Diagnostico</td>
				<td>Encaminhamento</td>
			</tr>
<?php
	if ( count($resultado) == 0 ) {
?>
		<tr>
			<td colspan="3">Ainda não há registros desse paciente.</td>
		</tr>
<?php
	} else {
		foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['unidade']; ?></td>
				<td><?php print $tupla['diagnostico']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
			</tr>
<?php
										 }
	}
?>
		</table>
	</body>
</html>