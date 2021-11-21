<?php

$router->get('', 'PagesController@index');
$router->get('checkout', 'PagesController@checkout');

$router->get('productos', 'ProductoController@index', 'ROLE_USER');
$router->post('productos/nuevo', 'ProductoController@nuevo', 'ROLE_ADMIN');
$router->get('productos/:id', 'ProductoController@show', 'ROLE_USER');

$router->get('contact', 'MensajeController@index');
$router->post('mensaje', 'MensajeController@mensaje');

$router->get('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checklogin');
$router->get('logout', 'AuthController@logout', 'ROLE_USER');
$router->get('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');


$router->get('single', '../app/controllers/single.php');