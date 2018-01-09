<?php

use Silex\Application;

class Controller{


    public function sendMail( array $user, array $message, Application $app){

        try {
            //Server settings
            $mail = $app["mail"];
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'provolone.o2switch.net';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'antoineduclos1994@gmail.com.com';                 // SMTP username
            $mail->Password = 'test';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('antoineduclos1994@gmail.com', 'webforce3');
            $mail->addAddress($user["adress"], $user["name"]);
    
        
            
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $message["subject"];
            $mail->Body    = $message;["body"];
           
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }


}