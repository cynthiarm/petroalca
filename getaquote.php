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

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $emailTo = $_POST['email'];
    $email = $_POST['email_quote'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $bodyEmail = $_POST['message'];

     // $header = 'From: Petroalca LLC Info <info@petroalca.com>'. "\r\n";
    //$header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    //$header .= "Mime-Version: 1.0" . "\r\n";
   // $header .= "Content-Type: text/html; charset=UTF-8". "\r\n";

    $image = base64_encode(file_get_contents("img/logo/petroalca-logo -350x.png"));
    $logo = 'img/logo/petroalca-logo -350x.png';
    $link = 'https://petroalca.com';

    // Configuración SMTP con debug
    $mail->isSMTP();
    $mail->SMTPDebug  = 0; // 0=off, 2=debug
    $mail->Debugoutput = 'html';
    $mail->Host       = 'petroalca.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@petroalca.com';
    $mail->Password   = 's$7PRu(It0}o';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    // Remitente y destinatario
    $mail->setFrom('info@petroalca.com', 'Petroalca LLC');
    $mail->addAddress('Leslyrr@yahoo.com.mx'); // enviarlo al suscriptor


    // Email subject and body
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $subject;
    // Adjuntar el logo al correo
    $mail->AddEmbeddedImage(__DIR__ . '/img/logo/petroalca-logo -350x.png', 'logoimg');

    $template = file_get_contents(__DIR__ . '/quote_form.html');
    $mail->Subject = "Someone is interested in Petroalca Services do not miss this opportunity!";

    // Reemplazar variables dinámicas
    $replacements = [
        '{{logo_src}}'       => 'cid:logoimg',
        '{{brand_name}}'     => 'Petroalca LLC',
        '{{name}}'           => $defaultName,
        '{{cta_url}}'        => 'https://www.petroalca.com/',
        '{{year}}'           => date('Y'),
        '{{unsubscribe_url}}'=> 'https://www.petroalca.com/unsubscribe'
    ];

    // Reemplazar placeholders en la plantilla
    $mail->Body = str_replace(
        ["{{firstname}}", "{{lastname}}", "{{email}}","{{phone}}", "{{subject}}", "{{message}}"],
        [$firstname, $lastname, $email, $phone, $subject, nl2br($bodyEmail)],
        $template
    );

    

    // Enviar correo
    if($mail->send()){
        echo "OK_QUOTE_EN";
    } else {
        echo "❌ Error sending email.";
    }

} catch (Exception $e) {
    echo "❌ Sending error: {$mail->ErrorInfo}";
}
?>



