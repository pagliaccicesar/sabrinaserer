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


































/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = $_POST['first_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $telefono   = $_POST['telephone'] ?? '';
    $mensaje    = $_POST['comments'] ?? '';
    $newsletter = isset($_POST['newsletter']) ? "Sí" : "No";

    $mail = new PHPMailer(true);

    try {
        // CONFIGURACIÓN SMTP (Hostinger)
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';     
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@cesarpagliacci.com.ar'; // Tu correo completo
        $mail->Password   = 'Brasil819$';                // Tu contraseña real
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // REMITENTE y DESTINATARIOS
        $mail->setFrom('info@cesarpagliacci.com.ar', 'Formulario Web');
        $mail->addAddress('info@cesarpagliacci.com.ar'); // A tu casilla
        $mail->addAddress('pagliaccicesar@gmail.com');   // Y también a Gmail

        // CONTENIDO DEL MAIL
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje desde la web de Sabrina';
        $mail->Body    = "
            <h3>Nuevo contacto desde la web</h3>
            <p><b>Nombre:</b> {$nombre}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Telefono:</b> {$telefono}</p>
            <p><b>Mensaje:</b><br>{$mensaje}</p>
            <p><b>Newsletter:</b> {$newsletter}</p>
        ";

        $mail->send();

        // Respuesta en la misma página
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const successDiv = document.getElementById('success');
                    successDiv.innerHTML = '<p style=\"color:green;font-weight:bold;\">Nos contactaremos a la brevedad</p>';
                });
              </script>";

    } catch (Exception $e) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const successDiv = document.getElementById('success');
                    successDiv.innerHTML = '<p style=\"color:red;font-weight:bold;\">Error al enviar el mensaje: " . addslashes($mail->ErrorInfo) . "</p>';
                });
              </script>";
    }
}
?>













<?php 
/*if(isset($_POST['email'])) { 
    $email_to = "info@sabrinaserer.ar, contacto@azagile.com.ar"; 
    $email_subject = "Me contacto desde sabrinaserer.ar";    
    $first_name = $_POST['first_name'];   
    $email_from = $_POST['email'];    
    $telephone = $_POST['telephone'];   
    $comments = $_POST['comments']; 
     $newsletter = isset($_POST['newsletter']) ? "Sí desea recibir el Newsletter" : "No desea recibir el Newsletter";
    $error_message = ""; 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) { 
    $error_message .= '<li><h1>La dirección de correo electrónico es incorrecta<h1></li>'; 
  } 
    $string_exp = "/^[A-Za-z .'-]+$/"; 
  if(!preg_match($string_exp,$first_name)) { 
    $error_message .= '<li><h1>Ingrese correctamente su nombre</h1></li>'; 
  } 
  if(strlen($comments) < 2) { 
    $error_message .= '<li><p>Message appears to be incorrect</p></li>'; 
  } 
  if(strlen($error_message) > 0) { 
    died($error_message); 
  } 
    $email_message = "Estos son datos enviados desde formulario de sabrinaserer.ar.\n\n"; 

    
    function clean_string($string) { 
      $bad = array("content-type","bcc:","to:","cc:","href"); 
      return str_replace($bad,"",$string); 
    }
    $email_message .= "First Name: ".clean_string($first_name)."\n"; 
    $email_message .= "Email Adress: ".clean_string($email_from)."\n";    
    $email_message .= "Telefono: ".clean_string($telephone)."\n";   
    $email_message .= "Comments: ".clean_string($comments)."\n";
    $email_message .= "Newsletter: " . $newsletter . "\n";

$headers = "From: Sabrina <no-reply@sabrinaserer.ar>\r\n";    
 
//$headers = 'From: '.$email_from."\r\n". 
'Reply-To: '.$email_from."\r\n" . 
'X-Mailer: PHP/' . phpversion(); 
@mail($email_to, $email_subject, $email_message, $headers);   
?>

<?php
header("Location: https://www.sabrinaserer.ar/respuesta.html");
exit(); 
}
 //?>*/

