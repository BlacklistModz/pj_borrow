<?php 
function hashPassword($value){
	$cost = isset($options['rounds']) ? $options['rounds'] : 10;
	$hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
	if ($hash === false) {
		throw new RuntimeException('Bcrypt hashing not supported.');
	}
	return $hash;
}