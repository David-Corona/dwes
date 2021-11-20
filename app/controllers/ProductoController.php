<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Producto;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\FileException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\CategoriaRepository;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\app\utils\File;
use cursophp7dc\core\App;
use cursophp7dc\core\Response;

class ProductoController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $prodRepository = App::getRepository(ProductoRepository::class);
        $categoriaRepository = App::getRepository(CategoriaRepository::class);
        $productos = $prodRepository->findAll();
        $categorias = $categoriaRepository->findAll();
        //$productos = App::getRepository(ProductoRepository::class)->findAll();
        //$categorias = App::getRepository(CategoriaRepository::class)->findAll();
        //se solucionará más adelante
        $errores = [];
        $mensaje = '';

        Response::renderView('productos', 'layout', compact('productos', 'categorias'));
    }

    /**
     * @throws QueryException
     * @throws AppException
     */
    public function nuevo()
    {
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
            //$prodRepository = new ProductoRepository();
            $prodRepository = App::getRepository(ProductoRepository::class);

            $prodRepository->save($productoTienda);
            //$prodRepository->guarda($productoTienda);

            //Log: cada vez que se cree un producto, se guarda en el log un mensaje
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


        }
        catch (FileException $fileException)
        {
            die($fileException->getMessage());
        }
        catch (ValidationException $validationException)
        {
            die($validationException->getMessage());
        }

        App::get('router')->redirect('productos');
    }

    /**
     * @param $id
     * @throws AppException
     */
    public function show($id)
    {
        $producto = App::get(ProductoRepository::class)->find($id);

        Response::renderView('show-producto', 'layout', compact('producto'));
    }
}