<?php

$loader = new \Phalcon\Loader();


$loader->registerNamespaces(array(
	'App\Models' => APP_DIR . '/models/',
))->register();