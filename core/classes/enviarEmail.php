<?php

namespace core\classes;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class EnviarEmail
{
//================================================SEND AN EMAIL======
    public function enviar_email_confirmacao_novo_cliente($email_cliente, $purl)
    {                                                                       
        //ENVIA O EMAIL PARA UM NOVO CLIENTE NO SENTIDO DE CINFIRMAR O EMAIL.

        //constro um purl  (link para validação do email)

        $link=BASE_URL.'?a=confirmar_email&purl=' .$purl;
      
        //Load Composer's autoloader
        // require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`, if you have set `SMTPSecure = PHPMailer::ENCRYPTION_SMTPS` use 465 as port

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient

            // $mail->addAddress('paginasemails54@gmail.com');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //ASSUNTO
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . '-' . 'Confirmção de Email';

            //MESSAGEM
            $html='<p>Seja bem vindo á nossa Loja '. APP_NAME . '</p>';
            $html .='<p>Para poder entrar na nossa loja , necessita confirmar o seu Email.</p>';
            $html .='<p>Para Confirmar o email , click no link a baixo:</p>';
            $html .='<p> <a href="'.$link.'">Confirmar Email</a></p>';
            $html .='<p><i>'. APP_NAME .'</i></p>';

            $mail->Body = $html;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
           return false;
        }
    }
}
