<?php

namespace cursophp7dc\core;

use cursophp7dc\app\exceptions\AppException;

class Security
{
    /**
     * @param string $role
     * @return bool
     * @throws AppException
     */
    public static function isUserGranted(string $role):bool
    {
        if ($role === 'ROLE_ANONYMOUS')
            return true;

        $usuario = App::get('appUser'); //usuario logueado
        if(is_null($usuario))
            return false;

        //si está logueado, averiguamos que rol
        $valor_role = App::get('config')['security']['roles'][$role];
        $valor_role_usuario = App::get('config')['security']['roles'][$usuario->getRole()];

        return ($valor_role_usuario >= $valor_role); //true si el rol del usuario es mayor del exigido
    }

    /**
     * @param string $password
     * @return string
     */
    public static function encrypt(string $password):string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $bdpassword
     * @return bool
     */
    public static function checkPassword(string $password, string $bdpassword):bool
    {
        return password_verify($password, $bdpassword);
    }
}