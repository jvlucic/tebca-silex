<?php

use Silex\Provider\SymfonyBridgesServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\FormServiceProvider;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Validator\Constraints as Assert;
use \connection\LoginService;
use models\User;
use connection\DetailService;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../loader/loader.php';

$app = new Silex\Application();


$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallback' => 'es',
    'locale' => 'es',
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Guzzle\GuzzleServiceProvider(), array(
    'guzzle.class_path' => __DIR__ . '/../vendor/guzzle/guzzle/src'
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app->before(function () use ($app) {
            $app['session']->start();
        });

$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());
    $translator->addResource('yaml', __DIR__.'/../locales/es.yml', 'es');
    $translator->addResource('yaml', __DIR__.'/../locales/validators.es.yml', 'es','validators');
    return $translator;
}));


$app["debug"] = true;

$app->match('/login', function (Request $request) use ($app) {

            $form = $app['form.factory']->createBuilder('form')
                    ->add('username', 'text', array(
                        'error_bubbling' => true,
                        'constraints' => array(new Assert\NotBlank(array('message' => 'username.not_blank')),
                            new Assert\NotNull(array('message' => 'username.not_null')),
                            new Assert\MinLength(array('message' => 'username.too_short','limit' => 4 )),
                            new Assert\MaxLength(16)
                        )
                    ))
                    ->add('password', 'password', array(
                        'error_bubbling' => true,
                        'constraints' => array(new Assert\NotBlank(array('message' => 'password.not_blank')),
                            new Assert\NotNull(array('message' => 'password.not_null')),
                            new Assert\MinLength(array('message' => 'password.too_short','limit' => 4 )),
                            new Assert\MaxLength(16)
                        )
                    ))
                    ->getForm();
            
            $customError="";
            if ('POST' == $request->getMethod()) {
                $form->bindRequest($request);
                if ($form->isValid()) {
                    $data = $form->getData();
                    $result=LoginService::login( $data['username'],  $data['password']);
                    if (array_key_exists('error_code', $result)){
                        $customError=$result['error_message'];
                    }else{
                        $user =new User($result);
                        $user->nombreCliente=$result['nombre_cliente'];
                        $app['session']->set('token', $result["token"]);
                        $app['session']->set('user', $user);
                    }
                    return $app->redirect('/dashboard');
                }
            }
            
            return $app['twig']->render('login.twig', 
                    array('form' => $form->createView() , 'customError' => $customError));
        });

  $app->get('/dashboard', function () use ($app) {
      $user=$app['session']->get('user');
            if (isset($user)){
                return $app['twig']->render('dashboard.twig', array('user' => $user ));
            }
        });
        
  $app->get('/card/{id}', function ($id) use ($app) {
            $user = $app['session']->get('user');
            $card = $user->tarjetas[$id];
            $result = DetailService::detail($card->getNroTarjeta(), "", $user->token, $user->identificacionCliente);
            if (array_key_exists('error_code', $result)) {
                $customError = $result['error_message'];
            } else {
                $app['session']->get('user')->tarjetas[$id]=new \models\Card($result, $id);
                return $app['twig']->render('detail.twig', array('card' => $app['session']->get('user')->tarjetas[$id], 'user' =>$app['session']->get('user')  ));
            }
        });


$app->run();
?>
