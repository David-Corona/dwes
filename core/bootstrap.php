<?php

use cursophp7dc\app\utils\MyLog;
use cursophp7dc\app\utils\MyMail;
use cursophp7dc\core\App;
use cursophp7dc\core\Router;

require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);

//$router = Router::load('app/routes.php');
$router = Router::load(__DIR__ . '/../app/' . $config['routes']['filename']);
App::bind('router', $router);

//$logger = MyLog::load('logs/curso.log');
$logger = MyLog::load(__DIR__ . '/../logs/' . $config['logs']['filename'], $config['logs']['level']);
App::bind('logger', $logger);

$mailer = new MyMail();
App::bind('mailer', $mailer);