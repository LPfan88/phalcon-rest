<?php

use Phalcon\DI\FactoryDefault,
	Phalcon\Crypt,
	Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function() use ($config) {
	$db =  new DbAdapter(array(
		'host' => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname' => $config->database->dbname,
		'charset' => $config->database->charset
	));
	return $db;
});

$di->setShared('session', function() use ($di) {
	$session = new Phalcon\Session\Adapter\Files();
	$session->start();
	return $session;
});


$di->set('crypt', function() {
    $crypt = new Phalcon\Crypt();
    $crypt->setKey('p44qe_94AWR0Qxl');
    return $crypt;
});