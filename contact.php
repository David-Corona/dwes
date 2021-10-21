<?php

$errores = [];
$mensajeOk = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $apellidos = trim(htmlspecialchars($_POST['apellidos']));
    $email = trim(htmlspecialchars($_POST['email']));
    $asunto = trim(htmlspecialchars($_POST['asunto']));
    $texto = trim(htmlspecialchars($_POST['texto']));

    if (empty($nombre)) {
        $errores[] = "El nombre no se puede quedar vació";
    }

    if (empty($email)) {
        $errores[] = "El email no se puede quedar vació";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errores[] = "El email no es válido";
        }
    }

    if (empty($asunto)) {
        $errores[] = "El asunto no se puede quedar vació";
    }

    if (empty($errores)) {

        require_once 'database/Connection.php';

        $config = require_once 'app/config.php';
        $connection = Connection::make($config['database']);

        $sql = "INSERT INTO mensajes (nombre, apellidos, asunto, email, texto, fecha) VALUES ('$nombre', '$apellidos', '$email', '$asunto', '$texto', now())";
        if ($connection->exec($sql) === false)
        {
            $errores[] = 'No se ha podido guardar el mensaje en la base de datos.';
        } else
        {
            $mensajeOk = "Gracias por contactar con nosotros.";
        }

    }

}
    require 'utils/utils.php';
    require 'views/contact.view.php';
