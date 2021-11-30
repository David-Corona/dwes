<?php

$router->get('', 'PagesController@index');
$router->get('checkout', 'PagesController@checkout');
$router->get('perfil', 'PagesController@perfil', 'ROLE_USER');
$router->post('perfil/cambioPass', 'PagesController@cambioPass', 'ROLE_USER');
$router->get('compras/:id', 'PagesController@compras', 'ROLE_USER');
$router->get('usuarios', 'PagesController@usuarios', 'ROLE_ADMIN');
$router->get('usuarios/:id', 'PagesController@admin', 'ROLE_ADMIN');
$router->post('usuarios/editar/:id', 'PagesController@editar', 'ROLE_ADMIN');
$router->post('usuarios/eliminar/:id', 'PagesController@eliminar', 'ROLE_ADMIN');

$router->get('productos/:id', 'ProductoController@index', 'ROLE_USER');
$router->post('productos/nuevo', 'ProductoController@nuevo', 'ROLE_USER');
$router->get('admin-producto/:id', 'ProductoController@admin', 'ROLE_USER');
$router->post('admin-producto/editar/:id', 'ProductoController@editar', 'ROLE_USER');
$router->post('admin-producto/eliminar/:id', 'ProductoController@eliminar', 'ROLE_USER');
$router->get('producto/:id', 'ProductoController@show');
$router->post('comprar/:id', 'ProductoController@comprar', 'ROLE_USER');

$router->get('contact', 'MensajeController@index');
$router->post('mensaje', 'MensajeController@mensaje');

$router->get('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checklogin');
$router->get('logout', 'AuthController@logout', 'ROLE_USER');
$router->get('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');

//Examen
$router->get('articulos', 'ArticulosController@index', 'ROLE_USER');
$router->post('articulos/nuevo', 'ArticulosController@nuevo', 'ROLE_USER');



//Testeo
$router->get('trabajadores', 'TrabajadorController@index');
$router->post('trabajadores/nuevo', 'TrabajadorController@nuevo', 'ROLE_USER');

