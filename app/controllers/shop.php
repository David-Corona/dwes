<?php

    /*require_once 'entity/Producto.php';
    require_once 'repository/ProductoRepository.php';
    require_once 'core/App.php';
    require_once 'database/Connection.php';*/


use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\core\App;

try {
    $productos = App::getRepository(ProductoRepository::class)->findAll();

    require __DIR__ . '/../views/shop.view.php';
} catch (QueryException $queryException)
{
    die($queryException->getMessage());
}

