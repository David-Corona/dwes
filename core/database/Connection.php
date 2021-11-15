<?php
namespace cursophp7dc\core\database;

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\core\App;
use PDO;
use PDOException;

class Connection
{
    /**
     * @return PDO|void
     * @throws AppException
     */
    public static function make()
    {
        try
        {
            $config = App::get('config')['database'];
            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        }
        catch (PDOException $PDOException)
        {
            throw new AppException('No se ha podido crear la conexión a la base de datos');
        }
        return $connection;
    }
}