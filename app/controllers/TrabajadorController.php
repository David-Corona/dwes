<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Trabajador;
use cursophp7dc\app\exceptions\FileException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\TrabajadorRepository;
use cursophp7dc\app\utils\File;
use cursophp7dc\core\App;
use cursophp7dc\core\helpers\FlashMessage;
use cursophp7dc\core\Response;

class TrabajadorController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $trabajadores = App::getRepository(TrabajadorRepository::class)->findAll();

        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $nombre = FlashMessage::get('nombre');
        $apellidos = FlashMessage::get('apellidos');

        Response::renderView('trabajadores', 'layout',
            compact('trabajadores',  'errores', 'mensaje',
                'nombre', 'apellidos'));

    }

    public function nuevo()
    {

        try {
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            FlashMessage::set('nombre', $nombre);
            $apellidos = trim(htmlspecialchars($_POST['apellidos']));
            FlashMessage::set('apellidos', $apellidos);

            $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
            $imagen = new File('foto', $tiposAceptados); //foto es el name del input file

            $imagen->saveUploadFile(Trabajador::RUTA_FOTOS_TRABAJADORES);

            $trabajador = new Trabajador($nombre, $apellidos, $imagen->getFileName());

            //crea en bbdd
            $trabRepository = App::getRepository(TrabajadorRepository::class);
            $trabRepository->save($trabajador);

            //Log
            $message = "Se ha guardado un nuevo trabajador: " . $trabajador->getNombre();
            App::get('logger')->add($message);

            FlashMessage::set('mensaje', $message);

            //Al crearse correctamente, se limpia el form
            FlashMessage::unset('nombre');
            FlashMessage::unset('apellidos');

        }
        catch (FileException $fileException)
        {
            FlashMessage::set('errores', [ $fileException->getMessage() ]);
        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('errores', [ $validationException->getMessage() ]);
        }

        App::get('router')->redirect('trabajadores');
    }
}