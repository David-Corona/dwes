<?php
/*require_once 'utils/Utils.php';
require_once 'exceptions/FileException.php';
require_once 'exceptions/QueryException.php';
require_once 'exceptions/AppException.php';
require_once 'utils/File.php';
require_once 'entity/Producto.php';
require_once 'entity/Categoria.php';
require_once 'repository/ProductoRepository.php';
require_once 'repository/CategoriaRepository.php';
require_once 'database/Connection.php';
require_once 'database/QueryBuilder.php';
require_once 'core/App.php';*/

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

    //podría simplificarse, pero uso variable en el view
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