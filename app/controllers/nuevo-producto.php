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


use cursophp7dc\app\entity\Producto;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\FileException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\app\utils\File;
use cursophp7dc\core\App;

try {
    $titulo = trim(htmlspecialchars($_POST['titulo']));
    $subtitulo = trim(htmlspecialchars($_POST['subtitulo']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    $categoria = (int)$_POST['categoria'];
    $precio = (float)$_POST['precio'];
    /*if (empty($categoria))
        throw new ValidationException('No se ha recibido la categoría.');*/

    $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
    $imagen = new File('imagen', $tiposAceptados); //imagen es el name del input file

    $imagen->saveUploadFile(Producto::RUTA_IMAGENES_PRODUCTO);
    //$imagen->copyFile(Producto::RUTA_IMAGENES_SHOP, Producto::RUTA_IMAGENES_PRODUCTO);
    $imagen->resizeFile(Producto::RUTA_IMAGENES_PRODUCTO, Producto::RUTA_IMAGENES_SHOP);

    $productoTienda = new Producto($titulo, $subtitulo, $descripcion, $categoria, $precio, $imagen->getFileName());
    //$prodRepository->save($productoTienda);
    $prodRepository = new ProductoRepository();
    $prodRepository->guarda($productoTienda);

    //cada vez que se cree un producto, se guarde en el log un mensaje
    $message = "Se ha guardado un nuevo producto: " . $productoTienda->getTitulo();
    App::get('logger')->add($message);



        /*if (empty($titulo)) {
            $errores[] = "El título no se puede quedar vacío.";
        }
        if (empty($subtitulo)) {
            $errores[] = "El subtítulo no se puede quedar vacío.";
        }
        if (filter_var($precio, FILTER_VALIDATE_FLOAT) === false) {
            $errores[] = "El precio debe ser un número.";
        } elseif ($precio <= 0) {
            $errores[] = "El precio debe ser un número positivo.";
        }*/


        /*if (empty($errores)) {
            $mensaje = 'Producto creado correctamente.';
        }*/


} catch (FileException $fileException) {
    die($fileException->getMessage());
} catch (QueryException $queryException) {
    die($queryException->getMessage());
} catch (ValidationException $validationException) {
    die($validationException->getMessage());
} catch (AppException $appException) {
    die($appException->getMessage());
}

App::get('router')->redirect('productos');

