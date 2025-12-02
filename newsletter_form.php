<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {

    $email = isset($_POST['newsletter_email']) ? trim($_POST['newsletter_email']) : '';


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

    // Remitente y destinatario
    $mail->setFrom('info@petroalca.com', 'Petroalca LLC');
    $mail->addAddress($email); // enviarlo al suscriptor
    $mail->addReplyTo('Leslyrr@yahoo.com.mx', 'Petroalca LLC');
    
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->AddEmbeddedImage(__DIR__ . '/img/logo/petroalca-logo -350x.png', 'logoimg');

    // Plantilla según idioma

    $template = file_get_contents(__DIR__ . '/newsletter_welcome_en.html');
    $mail->Subject = "🎉 Thanks for subscribing to Petroalca LLC!";
    $defaultName = $email;
    

    // Reemplazar variables dinámicas
    $replacements = [
        '{{logo_src}}'       => 'cid:logoimg',
        '{{brand_name}}'     => 'Petroalca LLC',
        '{{name}}'           => $defaultName,
        '{{cta_url}}'        => 'https://www.petroalca.com/',
        '{{year}}'           => date('Y'),
        '{{unsubscribe_url}}'=> 'https://www.petroalca.com/unsubscribe'
    ];

    $mail->Body = str_replace(array_keys($replacements), array_values($replacements), $template);


    // Enviar correo
    if($mail->send()){
        echo "OK_NEWSLETTER_EN";
    } else {
        echo "❌ Error sending email.";
    }

} catch (Exception $e) {
    echo "❌ Sending error: {$mail->ErrorInfo}";
}


?>
