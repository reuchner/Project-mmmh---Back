<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});


//*** Route Login ***\\

$app->get('/', function () use ($app) {
    return $app['twig']->render('basic/login.html.twig', array());
})->bind("login");
$app->post('/', function () use ($app) {
    return $app['twig']->render('basic/login.html.twig', array());
});

//*** Route Register Expert ***\\

$app->get('/registerExpert', function() use($app) {
    return $app['twig']->render('basic/registerExpert.html.twig');
})->bind("register");

$app->post('/registerExpert', "Webforce\Controller\IndexController::registerExpertAction");

//*** Route ForgottenPassword ***\\

$app->get('/forgottenPassword', function() use($app) {
    return $app['twig']->render('basic/forgotten.html.twig');
})->bind("forgotPassword");
$app->post('/forgottenPassword', function() use($app) {
    sendMail('contact@mmmh.fr', 'this is the html message body', $app);
    return $app['twig']->render('basic/forgotten.html.twig');
});

//*** Route Profil ***\\

$app->get('/profil', function () use ($app) {
    return $app['twig']->render('basic/profil.html.twig', array());
})->bind("profil");
$app->post('/', function () use ($app) {
    return $app['twig']->render('basic/profil.html.twig', array());
});

//*** Route Réponse ***\\

$app->get('/reponsesExpert', function() use($app) {
    return $app['twig']->render('basic/registerExpert.html.twig');
})->bind("reponsesExpert");

$app->post('/registerExpert', "Webforce\Controller\IndexController::reponsesExpertAction")

//*** Route MesRéponses ***\\

$app->get('/mesReponses', function () use ($app) {
    return $app['twig']->render('basic/mesReponses.html.twig', array());
})->bind("mesReponses");
$app->post('/', function () use ($app) {
    return $app['twig']->render('basic/mesReponses.html.twig', array());
});