<?php
    $conexao = new pdo('sqlite:bancodedados.data');
    
    $cliente = new SoapClient( null, [ 
        'location' => 'http://localhost:8082/historico_paciente.php', 
        'uri' => 'http://localhost:8082/historico_paciente.php' 
        ] );
    $retorno = $cliente->historico_paciente($_REQUEST['documento']);

?>
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
        <table border="1">
			<caption>Relatório de Atendimentos</caption>
			<tr>
				<th>Unidade</th>
				<th>Diagnóstico</th>
				<th>Encaminhamento</th>
				<th>Data</th>
			</tr>
        <?php
		    foreach ( $retorno as $tupla ) {
        ?>
            <tr>
				<td><?php print $tupla['unidade']; ?></td>
                <td><?php print $tupla['diagnostico']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
			</tr>
        <?php
                }
        ?>
    </body>
</html>