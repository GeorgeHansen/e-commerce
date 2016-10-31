<?php
/**
 * Created by PhpStorm.
 * User: zera
 * Date: 10/18/16
 * Time: 12:10 AM
 */
require_once "vendor/autoload.php";
include_once "config.php";
class mail_sender
{
    #not yet done needs to be reconfigured with mail api
    function send(string $email, string $context){
        global $config;
        $mail = new PHPMailer();
        //Enable SMTP debugging.
        $mail->SMTPDebug = 3;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        $mail->Username = $config["gmail"]["user"];
        $mail->Password = $config["gmail"]["pass"];
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->From = $config["gmail"]["user"];
        $mail->FromName = "John Doe";

        $mail->addAddress($email, "test email");

        $mail->isHTML(true);

        $mail->Subject = "Subject Text";
        $mail->Body = $context;
        $mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            echo "Message has been sent successfully";
        }
    }
}