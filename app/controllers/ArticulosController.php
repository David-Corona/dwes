<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Articulo;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\FileException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\ArticuloRepository;
use cursophp7dc\app\utils\File;
use cursophp7dc\core\App;
use cursophp7dc\core\helpers\FlashMessage;
use cursophp7dc\core\Response;

class ArticulosController
{
    /**
     * @throws AppException
     * @throws QueryException
     */
    public function index()
    {
        $artRepository = App::getRepository(ArticuloRepository::class);
        if (App::get('appUser')->getRole() === "ROLE_ADMIN"){
            $articulos = $artRepository->findAll();
        } else {
            $articulos = $artRepository->findAllUser(App::get('appUser')->getId());
        }

        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $nombre = FlashMessage::get('nombre');
        $precio = FlashMessage::get('precio');
        $fecha_caducidad = FlashMessage::get('fecha_caducidad');

        Response::renderView('articulos', 'layout',
            compact('articulos', 'artRepository', 'errores', 'mensaje', 'nombre', 'precio', 'fecha_caducidad'));
    }

    /**
     * @throws AppException
     * @throws QueryException
     */
    public function nuevo()
    {
        try {
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            FlashMessage::set('nombre', $nombre);
            $precio = (float)trim(htmlspecialchars($_POST['precio']));
            FlashMessage::set('precio', $precio);
            $fecha_caducidad = $_POST['fecha_caducidad'];
            FlashMessage::set('fecha_caducidad', $fecha_caducidad);

            $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
            $imagen = new File('imagen', $tiposAceptados);

            $imagen->saveUploadFile(Articulo::RUTA_FOTOS_ARTICULOS);

            $articulo = new Articulo($nombre, $precio, $fecha_caducidad, $imagen->getFileName(), App::get('appUser')->getId());

            //crea en bbdd
            $artRepository = App::getRepository(ArticuloRepository::class);
            //$artRepository->save($articulo);
            $artRepository->guarda($articulo);


            //Log
            $message = "Se ha guardado un nuevo artículo: " . $articulo->getNombre();
            App::get('logger')->add($message);

            FlashMessage::set('mensaje', $message);

            FlashMessage::unset('nombre');
            FlashMessage::unset('precio');
            FlashMessage::unset('fecha_caducidad');

        }
        catch (FileException $fileException)
        {
            FlashMessage::set('errores', [ $fileException->getMessage() ]);
        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('errores', [ $validationException->getMessage() ]);
        }

        App::get('router')->redirect('articulos');
    }
}