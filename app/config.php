<?php
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
    ]
];