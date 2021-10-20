<?php

class Connection
{
    public static function make()
    {
        try
        {
            $opciones = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",    //para que utilice utf8
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,    //cuando se produzca un error, se genere una excepcion
                PDO::ATTR_PERSISTENT => true     //indicar que la conexión sea persistente = no cierre conex al finalizar script, +rendimiento
            ];

            $connection = new PDO(
                'mysql:host=david-corona.local;dbname=david-corona;charset=utf8',
                'userCurso',
                'dwes',
                $opciones
            );
        }
        catch (PDOException $PDOException)
        {
            die($PDOException->getMessage());
        }
        return $connection;
    }
}