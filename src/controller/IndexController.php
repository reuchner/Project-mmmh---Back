<?php

namespace Equipe\Controller;

use Silex\Application;


    class RegisterEquipeController {

        public function registerAction(Application $app, Request $request){
            
            $firstname = htmlspecialchars(trim($request->request->get["firstname"]));
            $lastname = htmlspecialchars(trim($request->request->get["lastname"]));
            $pseudo = htmlspecialchars(trim($request->request->get["pseudo"]));
            $password = htmlspecialchars(trim($request->request->get["password"]));
            $email = htmlspecialchars(trim($request->request->get["email"]));
            $position = htmlspecialchars(trim($request->request->get["poste"]));
            $phone = htmlspecialchars(trim($request->request->get["phone"]));

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) // verif de l'email valide
                return $app["twig"]->render("basic/registerEquipe.html.twig");

            $app['db']->insert('users', array(
                    'username' => $user["username"],
                    'email' => $user["email"],
                    'password' => md5('password')
                )
            );
        }
        
        
        public function verifEmail(Application $app, Request $request){

            $email = htmlspecialchars(trim($request->request->get["email"]));

            $token = strip_tags(trim($request->get("token")));

            $sql = "SELECT user_id FROM tokens WHERE token = ? AND type LIKE 'email'";
            $idUser = $app['db']->fetchAssoc($sql, array((string) $token));

            if(!$idUser)
                return $app["twig"]->render("basic/register.html.twig");

            $sql = "UPDATE user SET statuts = 'actif' WHERE id =?";
            $rowAffected = $app['db']->executeUpdate($sql, array((int)$idUser["user_id"]));

            if($rowAffected == 1)
                $app['db']->delete("tokens", array("token" => $token));   
                
        }
    }
            

           
        