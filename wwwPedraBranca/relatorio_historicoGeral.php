<?php
    $conexao = new pdo('sqlite:bancodedados.data');
    
    $unidadeLocal = new SoapClient( null, [ 
        'location' => 'http://localhost:8081/historico_paciente.php', 
        'uri' => 'http://localhost:8081/historico_paciente.php' 
        ] );
    $retorno = $unidadeLocal->historico_paciente($_REQUEST['documento']);

    // SOAP com Unidade Malafaia
    $unidadeMalafaia = new SoapClient( null, [ 
        'location' => 'http://localhost:8082/historico_paciente.php', 
        'uri' => 'http://localhost:8082/historico_paciente.php' 
        ] );
    $retornoMalafaia = $unidadeMalafaia->historico_paciente($_REQUEST['documento']);

    // SOAP com Unidade Centro
    $unidadeCentro = new SoapClient( null, [ 
        'location' => 'http://localhost:8083/historico_paciente.php', 
        'uri' => 'http://localhost:8083/historico_paciente.php' 
        ] );
    $retornoCentro = $unidadeCentro->historico_paciente($_REQUEST['documento']);

?>
<html>
	<head>
	</head>
	<body>
		<?php
			require 'menu.php';
		?>
        <table border="1">
			<caption>Relatório de Atendimentos Geral</caption>
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
				<td><?php print $tupla['datahora']; ?></td>
			</tr>
        <?php
                }
            foreach ( $retornoMalafaia as $tupla ) {
        ?>
            <tr>
				<td><?php print $tupla['unidade']; ?></td>
                <td><?php print $tupla['diagnostico']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
				<td><?php print $tupla['datahora']; ?></td>
			</tr>
        <?php
                }
            foreach ( $retornoCentro as $tupla ) {
        ?>
            <tr>
				<td><?php print $tupla['unidade']; ?></td>
                <td><?php print $tupla['diagnostico']; ?></td>
				<td><?php print $tupla['encaminhamento']; ?></td>
				<td><?php print $tupla['datahora']; ?></td>
			</tr>
        <?php
                }
        ?>
    </body>
</html>