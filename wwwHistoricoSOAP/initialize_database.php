<?php


	$drop = "drop table if exists covidcases; ";
	$conexao->exec($drop);

	function initialize_database ( PDO $conexao ) {
		$create = "CREATE TABLE IF NOT EXISTS historico 
		( id integer primary key autoincrement, 
		unidade text,
		documento text,
		timestamp datetime,
		diagnostico text, 
		encaminhamento text ); ";
		$conexao->exec($create);
	}
?>