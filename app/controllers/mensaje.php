<?php

use cursophp7dc\app\entity\Mensaje;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\MensajeRepository;
use cursophp7dc\core\App;



try {

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
            //$mensajeRepository->save($mensaje);
            App::getRepository(MensajeRepository::class)->save($mensaje);
            //$prodRepository->guarda($productoTienda);

            $message = "Se ha guardado un nuevo mensaje: " . $mensaje->getTexto();
            App::get('logger')->add($message);

            $asunto = "Mensaje recibido";
            $nameTo = $nombre . ' ' . $apellidos;

            App::get('mailer')->send($asunto, $email, $nameTo, $message);

            //$mensajeOk = "Gracias por contactar con nosotros.";
        }


}
catch (ValidationException $validationException)
{
    die($validationException->getMessage());
}
catch (AppException $appException)
{
    die($appException->getMessage());
}

try {
    App::get('router')->redirect('contact');
} catch (AppException $e) {
}

