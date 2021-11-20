<?php

use cursophp7dc\app\repository\MensajeRepository;
use cursophp7dc\core\App;


$errores = [];
$mensajeOk = '';
$nombre = '';
$apellidos = '';
$email = '';
$asunto = '';
$texto = '';



$mensajeRepository = App::getRepository(MensajeRepository::class);



require __DIR__ . '/../views/contact.view.php';
