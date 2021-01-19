<?php
    $conexao = new pdo('sqlite:bancodedados.data');
    
    $cliente = new SoapClient( null, [ 
        'location' => 'http://localhost:8082/historico_paciente.php', 
        'uri' => 'http://localhost:8082/historico_paciente.php' 
        ] );
    $retorno = $cliente->history($_REQUEST['documento']);

?>
<html>
		<?php
			require 'menu.php';
		?>
		<br><br>
        <table border="1" class="table table-dark table-hover">
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
				<td><?php print $tupla['datahora']; ?></td>
			</tr>
        <?php
                }
        ?>
    </body>
</html>