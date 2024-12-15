<?php
// Cargar el autoload de Composer
require '../vendor/autoload.php';

// Usar la clase PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ? emails 

$emails_admin = [
    'redes@cavaspaces.cl',
    'contacto@cavaspaces.cl'
];

$name = strtolower($_POST['name']);
$email_client = strtolower(trim($_POST['email']));
$message = $_POST['message'];


if($name == "" OR $email_client == "" OR $message == ""){
    return 'error';
}
// ? validar el email

for ($i=0; $i < count($emails_admin) ; $i++) { 
    $mail_admin = $emails_admin[$i];
    send_email($mail_admin, $name, $message);

}

send_email($email_client, $name, $message);





// * enviando el email
function send_email($email, $name, $message){
    try {
        $mail = new PHPMailer(true);
    
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.cavaspaces.cl';         // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@cavaspaces.cl'; // Usuario SMTP
        $mail->Password = '7340458Tao.!';         // Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;                          // Puerto SMTP
    
        // Configurar el remitente y el destinatario
        $mail->setFrom('no-reply@cavasspaces.cl', 'no-reply');
        $mail->addAddress($email, $name);
    
        $mail->CharSet = 'UTF-8';
        // Cargar la plantilla HTML
        $template = file_get_contents('./email_template.html');

        // Reemplazar las variables dinámicas en la plantilla
        $variables = [
            '{{name}}' => $name,
            '{{date}}' => date('d-m-Y'),
            '{{message}}' => $message,
            '{{year}}' => date('Y'),
        ];
        foreach ($variables as $key => $value) {
            $template = str_replace($key, $value, $template);
        }

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Bienvenido a TuEmpresa';
        $mail->Body = $template;
    
        // Enviar correo
        $mail->send();
        // echo 'El mensaje se ha enviado correctamente';
    } catch (Exception $e) {
        // echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}


function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}



echo 'success';


?>