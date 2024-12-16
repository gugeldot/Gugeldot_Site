<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Incluye PHPMailer
require 'key.php'; // Configuraciones sensibles

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    if (!$nombre || !$correo || !$mensaje) {
        echo "All fields are required.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = PASSWD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = SMTP_PORT;

        // Configuración del correo
        $mail->setFrom($correo);
        $mail->addAddress(MAIL);
        $mail->addAddress(MAIL2);

        $mail->Subject = "Nuevo mensaje de contacto - $nombre";
        $mail->Body = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";
        $mail->send();

        // Configuración del correo de confirmación al usuario
        $mail->clearAddresses();
        $mail->addAddress($correo);
        $mail->setFrom(SMTP_USER);
        $mail->Subject = $correo . " - Thank You for Reaching Out";
        $mail->Body = "
            <html>
            <head>
                <title>Thank You for Reaching Out</title>
            </head>
            <body>
                <p>Dear $correo,</p>
                <p>Thank you for getting in touch! We’ve received your message and will get back to you as soon as possible.</p>
                <p>In the meantime, feel free to explore our website or let us know if there’s anything urgent we can assist with.</p>
                <br>
                <p>Best regards,<br>[Your Name/Your Company]</p>
            </body>
            </html>
        ";
        $mail->isHTML(true);
        $mail->send();

        // Redirigir a página de confirmación
        header("Location: thanks.html");
        exit;

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>
