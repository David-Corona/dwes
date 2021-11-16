<?php

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\repository\CategoriaRepository;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\core\App;

$errores = [];
$mensaje = '';
$titulo = '';
$subtitulo = '';
$descripcion = '';
$categoria = '';
$precio = '';


try {

    //podría simplificarse, pero uso $prodRepository en el view
    $prodRepository = App::getRepository(ProductoRepository::class);
    $categoriaRepository = App::getRepository(CategoriaRepository::class);

    $productos = $prodRepository->findAll();
    $categorias = $categoriaRepository->findAll();

    //$productos = App::getRepository(ProductoRepository::class)->findAll();
    //$categorias = App::getRepository(CategoriaRepository::class)->findAll();
}

catch (QueryException $queryException)
{
    $errores[] = $queryException->getMessage();
}
catch (AppException $appException)
{
    $errores[] = $appException->getMessage();
}



require __DIR__ . '/../views/productos.view.php';