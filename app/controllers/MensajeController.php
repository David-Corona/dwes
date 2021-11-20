<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Mensaje;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\MensajeRepository;
use cursophp7dc\core\App;
use cursophp7dc\core\Response;

class MensajeController
{

    public function index()
    {
        //$mensajeRepository = App::getRepository(MensajeRepository::class);
        Response::renderView('contact');
    }

    /**
     * @throws AppException
     * @throws QueryException
     */
    public function mensaje()
    {
        try {
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            $apellidos = trim(htmlspecialchars($_POST['apellidos']));
            $email = trim(htmlspecialchars($_POST['email']));
            $asunto = trim(htmlspecialchars($_POST['asunto']));
            $texto = trim(htmlspecialchars($_POST['texto']));

            if (empty($nombre))
                throw new ValidationException('El nombre no puede quedar vacío');

            if (empty($email))
                throw new ValidationException('El email no puede quedar vacío');
            else
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                    throw new ValidationException('El email no es válido');

            if (empty($asunto))
                throw new ValidationException('El asunto no puede quedar vacío');


            if (empty($errores)) {
                $mensaje = new Mensaje($nombre, $apellidos, $asunto, $email, $texto);

                App::getRepository(MensajeRepository::class)->save($mensaje);
                //$prodRepository->guarda($productoTienda);

                //Log
                $message = "Se ha guardado un nuevo mensaje: " . $mensaje->getTexto();
                App::get('logger')->add($message);

                //swiftmailer
                $asunto = "Mensaje recibido";
                $nameTo = $nombre . ' ' . $apellidos;
                App::get('mailer')->send($asunto, $email, $nameTo, $message);
            }

        } catch (ValidationException $validationException)
        {
            die($validationException->getMessage());
        }

        App::get('router')->redirect('contact');
    }
}