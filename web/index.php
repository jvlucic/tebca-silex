<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/Guzzle/guzzle.phar';
require __DIR__ . '/../vendor/Guzzle/GuzzleServiceProvider.php';

use Guzzle\GuzzleServiceProvider;

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new GuzzleServiceProvider(), array(
    'guzzle.class_path' => "/home/jorge/PhpDev/silex/vendor/guzzle/src",
));

$app->get('/hello', function() {
    return 'btbtb!';

});

$app->get('/', function () use ($app) {

    return $app['twig']->render('login.twig', array());

});

$app->post('/login', function () use ($app) {

	$app->json($user);

    $response = $app['guzzle.client']->head('http://www.guzzlephp.org/')->send();

    return $app['twig']->render('hello.twig', array(
        'name' => __DIR__ . '/../vendor/guzzle/src',
        'response' => $response,
    ));

});


$app->get('/hello/{name}', function ($name) use ($app) {

    return $app['twig']->render('hello.twig', array(
        'name' => __DIR__ . '/../vendor/guzzle/src',
        'response' => $response,
    ));
});

$app->run();
