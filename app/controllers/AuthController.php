<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Usuario;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\UsuarioRepository;
use cursophp7dc\core\App;
use cursophp7dc\core\helpers\FlashMessage;
use cursophp7dc\core\Response;
use cursophp7dc\core\Security;

class AuthController
{
    public function login()
    {
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username');

        Response::renderView('login', 'layout', compact('errores', 'username'));
    }

    /**
     * @throws AppException
     */
    public function checkLogin()
    {
        try {
            // comprobar que se hayan recibido username y password
            if (!isset($_POST['username']) || empty($_POST['username']))
                throw new ValidationException('Debes introducir el usuario y el password.');

            FlashMessage::set('username', $_POST['username']);

            if (!isset($_POST['password']) || empty($_POST['password']))
                throw new ValidationException('Debes introducir el usuario y el password.');


            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy([
                'username' => $_POST['username']
            ]);

            //guardamos identificador, unset (para que no cargue el username) y redirigimos a index
            if (!is_null($usuario) && Security::checkPassword($_POST['password'], $usuario->getPassword()))
            {
                $_SESSION['loguedUser'] = $usuario->getId();
                FlashMessage::unset('username');
                App::get('router')->redirect('');
            }
            throw new ValidationException('El usuario y/o el password introducidos no existen.');
        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('login-error', [$validationException->getMessage()]);
            App::get('router')->redirect('login');
        }

    }

    /**
     * @throws AppException
     */
    public function logout()
    {
        if (isset($_SESSION['loguedUser']))
        {
            $_SESSION['loguedUser'] = null;
            unset($_SESSION['loguedUser']);
        }

        App::get('router')->redirect('login');
    }

    /**
     * @throws AppException
     */
    public function registro()
    {
        $errores = FlashMessage::get('registro-error', []);
        $username = FlashMessage::get('username');

        Response::renderView('registro', 'layout', compact('errores', 'username'));
    }

    /**
     * @throws AppException
     * @throws QueryException
     */
    public function checkRegistro()
    {
        try {
            if (!isset($_POST['username']) || empty($_POST['username']))
                throw new ValidationException('El nombre de usuario no puede quedar vacío.');

            FlashMessage::set('username', $_POST['username']);

            if (!isset($_POST['password']) || empty($_POST['password']))
                throw new ValidationException('La contraseña no puede quedar vacía.');

            if (!isset($_POST['re-password']) || empty($_POST['re-password'])
                || $_POST['password'] !== $_POST['re-password'])
                throw new ValidationException('Las contraseñas deben coincidir.');

            $password = Security::encrypt($_POST['password']);

            $usuario = new Usuario();
            $usuario->setUsername($_POST['username']);
            $usuario->setRole('ROLE_USER');
            $usuario->setPassword($password);

            App::getRepository(UsuarioRepository::class)->save($usuario);

            FlashMessage::unset('username');

            App::get('router')->redirect('login');

        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('registro-error', [ $validationException->getMessage() ]);
            App::get('router')->redirect('registro');
        }
    }

}