<?php
namespace Controllers;
use View\View;
use Models\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserController{
    public function signUp()
    {
        if(!empty($_POST)){
            try{
                $user = User::signUp($_POST);
                $auth = $user->getAuthorToken();
                //письмо
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                    $mail->isSMTP(); 
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'denys.kruhliak29@gmail.com';
                    $mail->Password   = 'rjwrchrn';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    //Recipients
                    $mail->setFrom('denys.kruhliak29@gmail.com', 'From Denys');
                    $mail->addAddress('denys.kruhliak29@gmail.com', 'To Denys');

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Auth';
                    $mail->Body    = 'This is the message from mvc .Click <a href="http://mvc/user/auth?key'.$auth.'">here</a>!';
                
                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                //редирект
            }
            catch(\Exceptions\InvalidParamsException $e){
                View::render('user/sign-up',['errors'=>$e->getMessage()]);
                return;
            }
        }
        View::render('user/sign-up');
    }


}
