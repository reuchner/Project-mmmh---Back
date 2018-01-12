<?php


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$verifParamLogin = function (Request $request) {
    $retour = verifParam($request->request, array("firstname", "lastname", "pseudo", "password", "email", "position", "phone"));
    var_dump($retour);
};