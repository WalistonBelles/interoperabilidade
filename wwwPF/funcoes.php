<?php

	function valida ( $entrada ) {
		return preg_match('/^[A-z]{2}[0-9]{6}$/', $entrada);
	}
