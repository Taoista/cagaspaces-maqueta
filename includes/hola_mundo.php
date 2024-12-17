<?php

echo 'iniciando testo envio email';



// Cargar el autoload de Composer
require '../vendor/autoload.php';

// Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.cavaspaces.cl';             // Servidor SMTP
    $mail->SMTPAuth = true;                         // Autenticación SMTP
    $mail->Username = 'no-reply@cavaspaces.cl';     // Usuario SMTP
    $mail->Password = '7340458Tao.!';               // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Seguridad SMTPS
    $mail->Port = 587;                              // Puerto SMTP

    // Configuración del remitente y destinatario
    $mail->setFrom('no-reply@cavaspaces.cl', 'No-Reply');
    $mail->addAddress('luis.olave.carvajal@gmail.com', 'Luis Olave');

    // Contenido del correo
    $mail->isHTML(true);                            // Activar formato HTML
    $mail->Subject = 'Hola Mundo';
    $mail->Body    = '<h1>Hola Mundo</h1><p>Este es un correo de prueba.</p>';
    $mail->AltBody = 'Hola Mundo - Este es un correo de prueba.';

    // Enviar el correo
    $mail->send();
    echo 'El correo se ha enviado correctamente.';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}



?>