<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = $_POST['first_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $telefono   = $_POST['telephone'] ?? '';
    $mensaje    = $_POST['comments'] ?? '';    

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';     
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@sabrinaserer.ar';
        $mail->Password   = 'Monitoreo-1905';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('info@sabrinaserer.ar', 'Formulario Web');
        $mail->addAddress('info@sabrinaserer.ar');
        $mail->addAddress('timonazo@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje desde sabrinaserer.ar';
        $mail->Body    = "
            <h3>Nuevo contacto desde la web</h3>
            <p><b>Nombre:</b> {$nombre}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Telefono:</b> {$telefono}</p>
            <p><b>Mensaje:</b><br>{$mensaje}</p>            
        ";

        $mail->send();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $mail->ErrorInfo]);
    }
}


































/*<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = $_POST['first_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $telefono   = $_POST['telephone'] ?? '';
    $mensaje    = $_POST['comments'] ?? '';
    $newsletter = isset($_POST['newsletter']) ? "Sí" : "No";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';     
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@sabrinaserer.ar';
        $mail->Password   = 'Monitoreo-1905';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('info@sabrinaserer.ar', 'Formulario Web');
        $mail->addAddress('info@sabrinaserer.ar');
        $mail->addAddress('timonazo@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje desde sabrinaserer.ar';
        $mail->Body    = "
            <h3>Nuevo contacto desde la web</h3>
            <p><b>Nombre:</b> {$nombre}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Telefono:</b> {$telefono}</p>
            <p><b>Mensaje:</b><br>{$mensaje}</p>
            <p><b>Newsletter:</b> {$newsletter}</p>
        ";

        $mail->send();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $mail->ErrorInfo]);
    }
}

*/

