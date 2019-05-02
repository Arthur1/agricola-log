<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=agricola-log_mysql_1;dbname=agricola-log',
			'username'   => 'root',
			'password'   => 'passw0rd',
			'persistent' => false,
			'compress'   => false,
		),
	),
);
