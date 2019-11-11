<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandler{

    public $mail;

    function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    function SendEmail(){

        try {
            //Server settings
            $this->mail->SMTPDebug = 2;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'phpitladiplomado@gmail.com';                     // SMTP username
            $this->mail->Password   = '#Querty123';                               // SMTP password
            $this->mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->mail->Port       = 587;   
            $this->mail->setFrom('phpitladiplomado@gmail.com', 'El Helicoptero');                                 // TCP port to connect to
        
            //Recipients

            $this->mail->addAddress('leonardotv.93@gmail.com', 'Leo');     // Add a recipient
         
        
            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }

    }

    




}



?>