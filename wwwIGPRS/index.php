<h3>Instituto Geral de Perícia do Estado do Rio Grande do Sul<br/>Validação de Registro Geral</h3>
<form method="post">
	<input type="text" name="documento" placeholder="RG" autocomplete="off" />
	<input type="submit" value="Validar" />
</form>
	
<?php

	if ( isset($_REQUEST['documento']) ) {
		include 'funcoes.php';
		if (valida($_REQUEST['documento'])) {
			print $_REQUEST['documento'] . ' é um Registro Geral válido.';
		} else {
			print $_REQUEST['documento'] . ' não é um Registro Geral válido.';
		}
	}