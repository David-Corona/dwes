<?php

use cursophp7dc\app\utils\MyLog;
use cursophp7dc\core\App;
use cursophp7dc\core\Router;

require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);

$router = Router::load('app/routes.php');
App::bind('router', $router);

$logger = MyLog::load('logs/curso.log');
App::bind('logger', $logger);