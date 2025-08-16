<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php;';



$mail = new PHPMailer(true);

try {
    // Configuración SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@sabrinaserer.ar'; // Tu correo
    $mail->Password = 'Serer/2025'; // Tu contraseña
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('info@sabrinaserer.ar', 'Formulario Web');
    $mail->addAddress('pagliaccicesar@gmail.com'); // Destinatario

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Nuevo mensaje del formulario';
    $mail->Body    = 'Nombre: ' . $_POST['name'] . '<br>Correo: ' . $_POST['email'];

    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>
