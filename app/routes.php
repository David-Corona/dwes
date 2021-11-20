<?php

$router->get('', 'PagesController@index');
$router->get('checkout', 'PagesController@checkout');

$router->get('productos', 'ProductoController@index');
$router->post('productos/nuevo', 'ProductoController@nuevo');
$router->get('productos/:id', 'ProductoController@show');

$router->get('contact', 'MensajeController@index');
$router->post('mensaje', 'MensajeController@mensaje');



$router->get('single', '../app/controllers/single.php');
$router->get('login', '../app/controllers/login.php');
$router->get('register', '../app/controllers/register.php');


