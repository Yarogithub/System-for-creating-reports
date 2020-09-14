<?php
// PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Base files
require_once __DIR__ . "/../PHPMailer/src/Exception.php";
require_once __DIR__ . "/../PHPMailer/src/PHPMailer.php";
require_once __DIR__ . "/../PHPMailer/src/SMTP.php";

class Mailer
{
    public function mailerSend($email,$subject,$body)
    {
        // create object of PHPMailer class with boolean parameter which sets/unsets exception.
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP(); // using SMTP protocol
            $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail
            $mail->SMTPAuth = true;  // enable smtp authentication
            $mail->Username = 'jd567872@gmail.com';  // sender gmail host
            $mail->Password = 'p@ssword98'; // sender gmail host password
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPSecure = 'tls';  // for encrypted connection
            $mail->Port = 587;   // port for SMTP

            $mail->setFrom('jd567872@gmail.com', "Sender"); // sender's email and name
            $mail->addAddress($email, "Receiver");  // receiver's email and name

            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) { // handle error.
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

}
