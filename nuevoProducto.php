<?php
require_once 'utils/utils.php';
require_once 'exceptions/FileException.php';
require_once 'exceptions/QueryException.php';
require_once 'exceptions/AppException.php';
require_once 'utils/File.php';
require_once 'entity/ImagenProducto.php';
require_once 'entity/Categoria.php';
require_once 'repository/ProductoRepository.php';
require_once 'repository/CategoriaRepository.php';
require_once 'database/Connection.php';
require_once 'database/QueryBuilder.php';
require_once  'core/App.php';

$errores = [];
$mensaje = '';
$titulo = '';
$subtitulo = '';
$descripcion = '';
$precio = '';


try {

    $config = require_once 'app/config.php';
    App::bind('config', $config);

    $prodRepository = new ProductoRepository();
    $categoriaRepository = new CategoriaRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $subtitulo = trim(htmlspecialchars($_POST['subtitulo']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $categoria = trim(htmlspecialchars($_POST['categoria']));
        $precio = (float)$_POST['precio'];
        if (empty($categoria))
            throw new ValidationException('No se ha recibido la categoría.');

        $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
        $imagen = new File('imagen', $tiposAceptados); //imagen es el name del input file

        $imagen->saveUploadFile(ImagenProducto::RUTA_IMAGENES_PRODUCTO);
        //$imagen->copyFile(ImagenProducto::RUTA_IMAGENES_SHOP, ImagenProducto::RUTA_IMAGENES_PRODUCTO);
        $imagen->resizeFile(ImagenProducto::RUTA_IMAGENES_PRODUCTO, ImagenProducto::RUTA_IMAGENES_SHOP);

        $productoTienda = new ImagenProducto($titulo, $subtitulo, $descripcion, $categoria, $precio, $imagen->getFileName());
        $prodRepository->save($productoTienda);

        $titulo = "";
        $subtitulo = "";
        $descripcion = "";
        $precio = null;
        $mensaje = 'Producto creado correctamente.';

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

    }

    $productos = $prodRepository->findAll();
    $categorias = $categoriaRepository->findAll();
}
catch (FileException $fileException)
{
    $errores[] = $fileException->getMessage();
}
catch (QueryException $queryException)
{
    $errores[] = $queryException->getMessage();
}
catch (AppException $appException)
{
    $errores[] = $appException->getMessage();
}
catch (ValidationException $validationException)
{
    $errores[] = $validationException->getMessage();
}


require 'views/nuevoProducto.view.php';