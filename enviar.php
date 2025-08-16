<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);

    // Dirección a la que se enviará el correo
    $destinatario = "info@sabrinaserer.ar";

    // Asunto del mensaje
    $asunto = "Nuevo mensaje desde el formulario web";

    // Cuerpo del mensaje
    $mensaje = "Has recibido un nuevo mensaje desde tu sitio web:\n\n";
    $mensaje .= "Nombre: " . $nombre . "\n";
    $mensaje .= "Email: " . $email . "\n";

    // Cabeceras
    $headers = "From: info@sabrinaserer.ar\r\n"; // remitente del mismo dominio
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Enviar el correo
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "¡Gracias! Tu mensaje ha sido enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje. Intenta nuevamente.";
    }
}
?>
