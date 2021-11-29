<?php
namespace cursophp7dc\app\controllers;

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\app\repository\UsuarioRepository;
use cursophp7dc\core\App;
use cursophp7dc\core\helpers\FlashMessage;
use cursophp7dc\core\Response;
use cursophp7dc\core\Security;

class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $productos = App::getRepository(ProductoRepository::class)->findAll();

        Response::renderView('index', 'layout', compact('productos'));
    }

    /**
     * @throws AppException
     */
    public function checkout()
    {
        Response::renderView('checkout', 'layout');
    }

    /**
     * @throws AppException
     */
    public function perfil()
    {
        $usuario = App::get('appUser');
        $errores = FlashMessage::get('perfil-error', []);
        $mensaje = FlashMessage::get('perfil-mensaje');

        Response::renderView('perfil', 'layout', compact('usuario', 'errores', 'mensaje'));
    }

    /**
     * @throws AppException
     * @throws QueryException
     */
    public function cambioPass()
    {
        try {

            if (!isset($_POST['password']) || empty($_POST['password']))
                throw new ValidationException('La contraseña no puede quedar vacía.');

            if (!isset($_POST['re-password']) || empty($_POST['re-password'])
                || $_POST['password'] !== $_POST['re-password'])
                throw new ValidationException('Las contraseñas deben coincidir.');

            $password = Security::encrypt($_POST['password']);

            $usuario = App::get('appUser');
            $usuario->setPassword($password);

            App::getRepository(UsuarioRepository::class)->update($usuario);

            //Log
            $message = "Se ha cambiado la contraseña del usuario " . $usuario->getUsername() .".";
            App::get('logger')->add($message);

            FlashMessage::set('perfil-mensaje', $message);

            App::get('router')->redirect('perfil');

        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('perfil-error', [ $validationException->getMessage() ]);
            App::get('router')->redirect('perfil');
        }
    }


}