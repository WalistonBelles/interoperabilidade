<h3>Polícia Federal<br/>Validação de Passaporte</h3>
<form method="post">
	<input type="text" name="documento" placeholder="Passaporte" autocomplete="off" />
	<input type="submit" value="Validar" />
</form>
	
<?php

	if ( isset($_REQUEST['documento']) ) {
		include 'funcoes.php';
		if (valida($_REQUEST['documento'])) {
			print $_REQUEST['documento'] . ' é um passaporte brasileiro válido.';
		} else {
			print $_REQUEST['documento'] . ' não é um passaporte brasileiro válido.';
		}
	}