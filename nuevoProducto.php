<?php
require_once 'utils/utils.php';
require_once 'exceptions/FileException.php';
require_once 'utils/File.php';
require_once 'entity/ImagenProducto.php';

$errores = [];
$mensaje = '';
$titulo = '';
$subtitulo = '';
$descripcion = '';
$precio = '';



if($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $subtitulo = trim(htmlspecialchars($_POST['subtitulo']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $precio = (float)$_POST['precio'];

        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $imagen = new File('imagen', $tiposAceptados); //imagen es el name del input file

        $imagen->saveUploadFile(ImagenProducto::RUTA_IMAGENES_SHOP);
        $imagen->copyFile(ImagenProducto::RUTA_IMAGENES_SHOP, ImagenProducto::RUTA_IMAGENES_PRODUCTO);

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


        if (empty($errores)) {
            $mensaje = 'Producto creado correctamente.';
        }

    }
    catch (FileException $fileException)
    {
        $errores[] = $fileException->getMessage();
    }

}



require 'views/nuevoProducto.view.php';