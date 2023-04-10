<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try{

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.arban.org.bd';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'smtp@arban.org.bd';                     //SMTP username
        $mail->Password   = 'FreeAccount@21';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;  


        //Recipients
        $mail->setFrom('contacts@atilih.net', 'VA MATCH CONTACTS');
        $mail->addAddress('shahindpi2@gmail.com', 'UR VA MATCH Test');     //Add a recipient
        $mail->addReplyTo('shahindpi2@gmail.com', 'VA MATCH CONTACTS');

        $mail->isHTML(true);
        $mail->Subject = "Message for UR VA MATCH from $email";
        $mail->Body = "<h3>Name: $name <br> Email: $email <br> Message: $message</h3>";

        $mail->send();
        $alert = '<div>Email sent successfully! Thank you</div>';

    } catch(Exception $e){
        $alert = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    
}