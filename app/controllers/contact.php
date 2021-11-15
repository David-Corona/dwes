<?php

use cursophp7dc\app\entity\Mensaje;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\MensajeRepository;

//require_once 'entity/Mensaje.php';
//require_once 'repository/MensajeRepository.php';
//require_once 'database/Connection.php';

$errores = [];
$mensajeOk = '';
$nombre = '';
$apellidos = '';
$email = '';
$asunto = '';
$texto = '';


try {

    $mensajeRepository = new MensajeRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            $mensaje = new Mensaje($nombre, $apellidos, $asunto, $email, $texto);
            $mensajeRepository->save($mensaje);
            //$prodRepository->guarda($productoTienda);

            $mensajeOk = "Gracias por contactar con nosotros.";
        }

    }
}
catch (ValidationException $validationException)
{
    $errores[] = $validationException->getMessage();
}
catch (QueryException $queryException)
{
    $errores[] = $queryException->getMessage();
}

    //require 'utils/Utils.php';
    require __DIR__ . '/../views/contact.view.php';
