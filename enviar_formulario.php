<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["name"]));
    $email  = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    // Cambia por tu correo
    $destinatario = "pagliaccicesar@gmail.com";
    $asunto = "Solicitud de libro PDF";
    $mensaje = "Nombre: $nombre\nCorreo: $email";

    $headers = "From: no-reply@tusitio.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "OK";
    } else {
        echo "Error";
    }
}
?>
