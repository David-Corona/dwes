<?php

use Monolog\Logger;

return [
    'database' => [
        'name' => 'david-corona',
        'username' => 'userCurso',
        'password' => 'dwes',
        'connection' => 'mysql:host=david-corona.local',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",    //para que utilice utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,    //cuando se produzca un error, se genere una excepcion
            PDO::ATTR_PERSISTENT => true     //indicar que la conexión sea persistente = no cierre conex al finalizar script, +rendimiento
        ]
    ],
    'logs' => [
        'filename' => 'curso.log',
        'level' => Logger::INFO
    ],
    'routes' => [
        'filename' => 'routes.php'
    ],
    'project' => [
        'namespace' => 'cursophp7dc'
    ],
    'swiftmail' => [
        'smtp_server' => 'smtp.gmail.com',
        'smtp_port' => '587',
        'smtp_security' => 'tls',
        'username' => 'testeo.davidcorona@gmail.com',
        'password' => "Enero100190",
        'email' => 'testeo.davidcorona@gmail.com',
        'name' => 'Curso PHP 7'

    ]
];