<?php
define('BASE_DIR', dirname(__DIR__));
define('APP_DIR', BASE_DIR . '/app');


/**
 * Read the configuration
 */
$config = include APP_DIR . '/config/config.php';

/**
 * Read auto-loader
 */
include APP_DIR . '/config/loader.php';

/**
 * Read services
 */
include APP_DIR . '/config/services.php';

// Handle the request
$app = new \Phalcon\Mvc\Micro();
$app->before(function () use ($app)
{
	if ($app->router->getRewriteUri() == '/api/token')
	{
		return TRUE;
	}

	$token = $app->request->get('token');
	if ( ! $Token = \App\Models\Tokens::findFirstByToken($token))
	{
		return ['error' => 'Invalid token'];
	}

	$app->session->set('userId', $Token->userId);
});

$app->after(function () use ($app) {
	// Return JSON after the route is executed
	echo json_encode($app->getReturnedValue());
});


// Here is the REST-methods

$app->post('/api/token', function() use ($app)
{
	$User = \App\Models\Users::findFirstByEmail($app->request->get('login'));
	if ($User === FALSE)
	{
		return ['error' => 'Wrong email/password combination'];
	}

	// Check the password
	if ( ! $app->security->checkHash($app->request->get('password'), $User->password))
	{
		return ['error' => 'Wrong email/password combination'];
	}

	$Token = new \App\Models\Tokens();
	$Token->save([
		'userId' => $User->id,
	    'token' => \Phalcon\Text::random(\Phalcon\Text::RANDOM_ALNUM, 20)
	]);

	return ['token' => $Token->token];
});

$app->post('/api/review', function () use ($app)
{
	$Review = new \App\Models\Reviews();
	$Review->save([
		'userId' => $app->session->get('userId'),
		'text' => $app->request->get('text'),
	    'datetime' => date('Y-m-d H:i:s'),
	    'rating' => 0.0
	]);

	return $Review->toArray();
});

$app->put('/api/review', function () use ($app)
{
	$Review = \App\Models\Reviews::findFirst($app->request->get('reviewId'));
	if ( ! $Review)
	{
		return ['error' => 'Review not found'];
	}

	if ($Review->userId != $app->session->get('userId'))
	{
		return ['error' => 'Access denied'];
	}

	$Review->text = $app->request->get('text');
	$Review->save();

	return $Review->toArray();
});

$app->delete('/api/review', function () use ($app)
{
	$Review = \App\Models\Reviews::findFirst($app->request->get('reviewId'));
	if ( ! $Review)
	{
		return ['error' => 'Review not found'];
	}

	if ($Review->userId != $app->session->get('userId'))
	{
		return ['error' => 'Access denied'];
	}

	$Review->delete();

	return ['success' => TRUE];
});

$app->session->start();
$app->handle();
