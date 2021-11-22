<?php

$router->get('', 'PagesController@index');
$router->get('checkout', 'PagesController@checkout');

$router->get('productos', 'ProductoController@index', 'ROLE_USER');
$router->post('productos/nuevo', 'ProductoController@nuevo', 'ROLE_ADMIN');
$router->get('productos/:id', 'ProductoController@show');

$router->get('contact', 'MensajeController@index');
$router->post('mensaje', 'MensajeController@mensaje');

$router->get('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checklogin');
$router->get('logout', 'AuthController@logout', 'ROLE_USER');
$router->get('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');

$router->get('articulos', 'ArticulosController@index', 'ROLE_USER');
$router->post('articulos/nuevo', 'ArticulosController@nuevo', 'ROLE_USER');




$router->get('trabajadores', 'TrabajadorController@index');
$router->post('trabajadores/nuevo', 'TrabajadorController@nuevo', 'ROLE_USER');

