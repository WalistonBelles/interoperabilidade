<?php

	function valida ( $entrada ) {
		if (strlen($entrada) != 11) {
			return false;
		}
		if (!is_numeric($entrada)) {
			return false;
		}
		$soma = 0;
		for ( $i = 0 ; $i < 9 ; $i++ ) {
			$soma += $entrada[$i] * (10-$i);
		}
		$resto = $soma % 11;
		$digito = 11 - $resto;
		if ( $digito > 9 ) {
			$digito = 0;
		}
		if ($digito != $entrada[9]) {
			return false;
		}
		$soma = 0;
		for ( $i = 0 ; $i < 10 ; $i++ ) {
			$soma += $entrada[$i] * (11-$i);
		}
		$resto = $soma % 11;
		$digito = 11 - $resto;
		if ( $digito > 9 ) {
			$digito = 0;
		}
		if ($digito != $entrada[10]) {
			return false;
		}
		return true;
	}

