<?php
	$conexao = new pdo('sqlite:bancodedados.dat');

	require_once 'initialize_database.php';
	initialize_database( $conexao );

	$select = "select id, cpf, nome, desde from procurado order by nome limit 10; ";
	if ( isset( $_REQUEST['pesquisa'] ) ) {
		$select = "select id, cpf, nome, desde from procurado where cpf || '' || nome like '%". $_REQUEST['pesquisa'] ."%' order by nome; ";
	}
	$resultado = $conexao->query($select)->fetchAll();
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
	require 'initialize_menu.php';
	initialize_menu();
?>
		<form method="post">
			<fieldset>
				<legend>Pesquisa por Mais Procurados</legend>
				<input type="text" name="pesquisa" placeholder="Termo de Pesquisa" autocomplete="off" />
				<input type="submit" value="Pesquisar" />
			</fieldset>
		</form>
		<table border="1">
			<caption>Lista de Mais Procurados</caption>
			<tr>
				<td>Cadastro</td>
				<td>Nome</td>
				<td>Desde</td>
				<td>Remover</td>
			</tr>
<?php
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['cpf']; ?></td>
				<td><?php print $tupla['nome']; ?></td>
				<td><?php print $tupla['desde']; ?></td>
				<td style="text-align: center;"> <a href="/procurado_delete.php?id=<?php print $tupla['id']; ?>"> X </a> </td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>