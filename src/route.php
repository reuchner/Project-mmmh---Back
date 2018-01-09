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


// *************  route register ************ //

$app->get('/registerEquipe', function () use ($app){
    return $app['twig']->render('basic/register.html.twig', array());
})->bind("register");

$app->post("/registerEquipe", "\IndexController::registerAction");

// *************  route mdp oublié ************ //

$app->get("/forgottenPassword", function() use ($app){
    return $app["twig"]->render("basic/forgotten.html.twig");
})->bind("forgottenPassword");

$app->post("/forgottenPassword", function() use ($app){
    sendMail('antoineduclos1994@gmail.com', "This is the HTML message body <b>in bold!</b>", $app);
    return $app["twig"]->render("basic/forgotten.html.twig");
});

// *************  route questions ************ //

$app->get("/questions", function() use ($app){
    return $app['twig']->render("basic/questions.html.twig", array());
})->bind("questions");

$app->post("/questions", function() use ($app){
    return $app['twig']->render("basic/questions.html.twig", array());
});

// *************  route liste des experts ************ //

$app->get("/expertsListe", function() use ($app){
    return $app['twig']->render("basic/expertsListe.html.twig", array());
})->bind("questions");

$app->post("/expertsListe", function() use ($app){
    return $app['twig']->render("basic/expertsListe.html.twig", array());
});

// *************  route liste des membres ************ //

$app->get("/membresListe", function() use ($app){
    return $app['twig']->render("basic/expertsListe.html.twig", array());
})->bind("questions");

$app->post("/membresListe", function() use ($app){
    return $app['twig']->render("basic/membresListe.html.twig", array());
});






