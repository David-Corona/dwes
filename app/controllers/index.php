<?php

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\core\App;
use cursophp7dc\core\Request;

try {
    $productos = App::getRepository(ProductoRepository::class)->findAll();

    require __DIR__ . '/../views/index.view.php';
    //require App::get('router')->direct(Request::uri(), Request::method());
} catch (QueryException $queryException)
{
    die($queryException->getMessage());
}
catch (AppException $appException)
{
    die($appException->getMessage());
}
