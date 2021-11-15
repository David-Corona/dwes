<?php

$router->get('', 'app/controllers/index.php');
$router->get('shop', 'app/controllers/shop.php');
$router->get('contact', 'app/controllers/contact.php');
$router->get('productos', 'app/controllers/productos.php');
$router->get('single', 'app/controllers/single.php');
$router->get('checkout', 'app/controllers/checkout.php');
$router->get('login', 'app/controllers/login.php');
$router->get('register', 'app/controllers/register.php');
$router->get('experiance', 'app/controllers/experiance.php');
$router->get('team', 'app/controllers/team.php');
$router->post('productos/nuevo', 'app/controllers/nuevo-producto.php');
$router->post('mensaje', 'app/controllers/mensaje.php');
