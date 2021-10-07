<?php

$errores = [];
$mensajeOk = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $apellido = trim(htmlspecialchars($_POST['apellido']));
    $email = trim(htmlspecialchars($_POST['email']));
    $asunto = trim(htmlspecialchars($_POST['asunto']));
    $mensaje = trim(htmlspecialchars($_POST['mensaje']));

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
        $mensajeOk = "Los datos del formulario son correctos:";
    }

}

    require 'views/contact.view.php';
