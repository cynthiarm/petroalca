<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


// Include the PHPMailer Autoload file
//require 'PHPMailer/PHPMailerAutoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {

// Set mailer to use SMTP

    $name = $_POST['name'];
    $emailTo = $_POST['email'];
    $email = $_POST['email'];
    $issue = $_POST['issue'];
    $subject = $_POST['subject'];
    $bodyEmail = $_POST['message'];

    $header = 'From: Petroalca LLC Info <noreply@petroalca.com>'. "\r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $header .= "Mime-Version: 1.0" . "\r\n";
    $header .= "Content-Type: text/html; charset=UTF-8". "\r\n";

    $image = base64_encode(file_get_contents("img/logo/petroalca-logo -350x.png"));
    $logo = 'img/logo/petroalca-logo -350x.pn';
    $link = 'https://petroalca.com';

    // Configuración SMTP con debug
    $mail->isSMTP();
    $mail->SMTPDebug  = 0; // 0=off, 2=debug
    $mail->Debugoutput = 'html';
    $mail->Host       = 'petroalca.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@petroalca.com';
    $mail->Password   = 'Petro20#25#';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    // Sender and recipient details
    $mail->setFrom('noreply@petroalca.com', 'Petroalca LLC');
    $mail->addAddress('info@petroalca.com');

    // Email subject and body
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $subject;
    // Adjuntar el logo al correo
    $mail->AddEmbeddedImage(__DIR__ . "/img/logo/petroalca-logo -350x.pn", "logoimg");


    $template = file_get_contents(__DIR__ . '/emailbody-eng.html');
    $mail->Subject = "Someone is trying to reach you!";
    
    // Reemplazar placeholders en la plantilla
    $mail->Body = str_replace(
        ["{{name}}", "{{email}}", "{{issue}}", "{{message}}"],
        [$name, $email, $issue, nl2br($message)],
        $template
    );

    // Enviar correo

    $mail->send();
        echo "OK_CONTACT_ES" : "OK_CONTACT_EN";


} catch (Exception $e) {
    echo "ERROR_CONTACT_EN" ;

}
?>



