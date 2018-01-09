<?php

	namespace Expert\Controller;

	use Silex\Application;
	use Symfony\Component\HttpFoundation\Request;

	class IndexExpertController extends controller {

		public function loginAction(){}

		public function RegisterAction(Application $app, Request $request){

			$firstname = htmlspecialchars(trim($request->get("firstname")));
	        $lastname = htmlspecialchars(trim($request->get("lastname"))); 
	        $username = htmlspecialchars(trim($request->get("username"))); 
	        $email = htmlspecialchars(trim($request->get("email"))); 
	        $password = htmlspecialchars(trim($request->get("password"))); 
	        $phonenumber = htmlspecialchars(trim($request->get("phonenumber"))); 
	        $city = htmlspecialchars(trim($request->get("city"))); 
	        $postalcode = htmlspecialchars(trim($request->get("postalcode"))); 
	        $age = htmlspecialchars(trim($request->get("age")));

	        if(!filter_var($email, FILTER_VALIDATE_EMAIL))

	        	return $app['twig']->render('basic/register.html.twig');

	        $app['db']->insert('user', array(
	            'username' => $username,
	            'email' => $email,
	            'password' => md5($password),
	            )
	        );
		}

		public function verifEmailAction(Application $app, Request $request){

			$token = strip_tags(trim($request->get("token")));

			$sql = "SELECT user_id FROM tokens WHERE token = ? AND type LIKE 'email'";
    		$idUser = $app['db']->fetchAssoc($sql, array((string) $token));

    		if(!$idUser)
    			return $app["twig"]->render("basic/register.html.twig");

    		$sql = "UPDATE user SET statuts = 'actif' WHERE id =?";
    		$rowAffected = $app['db']->executeUpdate($sql, array((int)$idUser["user_id"]));

    		if($rowAffected == 1)
    			$app['db']->delete("tokens", array("token" => $token));



    		return $app->redirect("/POO/Silex%20-%20Project/public/login");

		}