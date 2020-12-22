<?php

	function valida ( $entrada ) {
		return preg_match('/^[0-9]{10}$/', $entrada);
	}
