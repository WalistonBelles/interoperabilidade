<?php
	function initialize_database ( PDO $conexao ) {
		$create = "create table if not exists procurado ( id integer primary key autoincrement, cpf text, nome text, desde datetime ); ";
		$conexao->exec($create);
	}
?>