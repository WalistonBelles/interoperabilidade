<?php
    $conexao = new pdo('sqlite:bancodedados.data');
    
    $unidadeLocal = new SoapClient( null, [ 
        'location' => 'http://localhost:8082/historico_paciente.php', 
        'uri' => 'http://localhost:8082/historico_paciente.php' 
        ] );
    $retorno = $unidadeLocal->history($_REQUEST['documento']);

    // SOAP com Unidade Pedra Branca
    $unidadePedraBranca = new SoapClient( null, [ 
        'location' => 'http://localhost:8081/historico_paciente.php', 
        'uri' => 'http://localhost:8081/historico_paciente.php' 
        ] );
    $retornoPedraBranca = $unidadePedraBranca->history($_REQUEST['documento']);

    // SOAP com Unidade Centro
    $unidadeCentro = new SoapClient( null, [ 
        'location' => 'http://localhost:8083/historico_paciente.php', 
        'uri' => 'http://localhost:8083/historico_paciente.php' 
        ] );
    $retornoCentro = $unidadeCentro->history($_REQUEST['documento']);

?>
<html>
		<?php
			require 'menu.php';
		?><br><br>
        <table border="1" class="table table-dark table-hover">
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
            foreach ( $retornoPedraBranca as $tupla ) {
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