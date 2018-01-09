<?php

	namespace Expert\Controller;

	use Silex\Application;
	use Symfony\Component\HttpFoundation\Request;

	class ProfilExpertController extends controller {

		public function ProfilAction(){

			$firstname = htmlspecialchars(trim($request->get("firstname")));
	        $lastname = htmlspecialchars(trim($request->get("lastname"))); 
	        $photo = htmlspecialchars(trim($request->get("photo"))); 
	        $description = htmlspecialchars(trim($request->get("description"))); 
	        $profession = htmlspecialchars(trim($request->get("profession"))); 
	        $domaine = htmlspecialchars(trim($request->get("domaine"))); 
	        $city = htmlspecialchars(trim($request->get("city"))); 
	        
		}

		