<?php
namespace cursophp7dc\core;

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\core\database\Connection;

class App
{
    private static $container = [];

    //bind permite almacenar un objeto dentro del contenedor. Recibe la clave donde se almacenará y el objeto
    /**
     * @param string $key
     * @param $value
     */
    public static function bind(string $key, $value)
    {
        static::$container[$key] = $value;
    }

    //devolver un elemento del array a partir de la clave que se le pase
    /**
     * @param string $key
     * @throws AppException
     */
    public static function get(string $key)
    {
        if (! array_key_exists($key, static::$container))
            throw new AppException("No se ha encontrado la clave $key en el contenedor.");
        return static::$container[$key];
    }

    /**
     * @return mixed
     * @throws AppException
     */
    public static function getConnection()
    {
        if (! array_key_exists('connection', static::$container))
            static::$container['connection'] = Connection::make();
        return static::$container['connection'];
    }
}