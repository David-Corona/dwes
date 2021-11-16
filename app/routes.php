<?php

$router->get('', 'PagesController@index');
$router->get('checkout', 'PagesController@checkout');
$router->get('contact', '../app/controllers/contact.php');
$router->get('productos', '../app/controllers/productos.php');
$router->get('single', '../app/controllers/single.php');
$router->get('login', '../app/controllers/login.php');
$router->get('register', '../app/controllers/register.php');
$router->post('productos/nuevo', '../app/controllers/nuevo-producto.php');
$router->post('mensaje', '../app/controllers/mensaje.php');
