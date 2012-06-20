<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/Guzzle/guzzle.phar';
require __DIR__ . '/../vendor/Guzzle/GuzzleServiceProvider.php';

use Guzzle\GuzzleServiceProvider;
use Silex\Provider\FormServiceProvider;
use Symfony\Component\Validator\Constraints as Assert;

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app->register(new GuzzleServiceProvider(), array(
    'guzzle.class_path' => "/home/jorge/PhpDev/silex/vendor/guzzle/src",
));

$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->match('/login', function () use ($app) {

            $form = $app['form.factory']->createBuilder('form')
                    ->add('username', 'text', array(
                        'constraints' => array(new Assert\NotBlank(),
                            new Assert\NotNull(),
                            new Assert\MinLength(4),
                            new Assert\MaxLength(16)
                        )
                    ))
                    ->add('password', 'password', array(
                        'constraints' => array(new Assert\NotBlank(),
                            new Assert\NotNull(),
                            new Assert\MinLength(4),
                            new Assert\MaxLength(16)
                        )
                    ))
                    ->getForm();


            if ('POST' == $request->getMethod()) {
                $form->bindRequest($request);
                if ($form->isValid()) {
                    $data = $form->getData();
                    
                    
                    $response = $app['guzzle.client']->head('http://www.guzzlephp.org/')->send();
                    
                    return $app->redirect('...');
                }
            }


            return $app['twig']->render('login.twig', array('form' => $form->createView()));
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
