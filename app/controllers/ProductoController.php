<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Producto;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\FileException;
use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\CategoriaRepository;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\app\utils\File;
use cursophp7dc\core\App;
use cursophp7dc\core\helpers\FlashMessage;
use cursophp7dc\core\Response;

class ProductoController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $prodRepository = App::getRepository(ProductoRepository::class);
        $productos = $prodRepository->findAll();
        $categorias = App::getRepository(CategoriaRepository::class)->findAll();

        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $titulo = FlashMessage::get('titulo');
        $subtitulo = FlashMessage::get('subtitulo');
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
        $precio = FlashMessage::get('precio');

        //compact => se pasan las variables a la vista
        Response::renderView('productos', 'layout',
            compact('productos', 'categorias', 'prodRepository', 'errores', 'mensaje', 'titulo',
                'subtitulo', 'descripcion', 'categoriaSeleccionada', 'precio'));
    }

    /**
     * @throws QueryException
     * @throws AppException
     */
    public function nuevo()
    {
        try {
            $titulo = trim(htmlspecialchars($_POST['titulo']));
            FlashMessage::set('titulo', $titulo);
            $subtitulo = trim(htmlspecialchars($_POST['subtitulo']));
            FlashMessage::set('subtitulo', $subtitulo);
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion', $descripcion);
            $categoria = (int)$_POST['categoria'];
            if (empty($categoria))
                throw new ValidationException('No se ha recibido la categoría.');
            FlashMessage::set('categoriaSeleccionada', $categoria);
            $precio = (float)$_POST['precio'];
            FlashMessage::set('precio', $precio);


            $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
            $imagen = new File('imagen', $tiposAceptados); //imagen es el name del input file

            $imagen->saveUploadFile(Producto::RUTA_IMAGENES_PRODUCTO);
            //$imagen->copyFile(Producto::RUTA_IMAGENES_SHOP, Producto::RUTA_IMAGENES_PRODUCTO);

            $productoTienda = new Producto($titulo, $subtitulo, $descripcion, $categoria, $precio, $imagen->getFileName());

            $imagen->resizeFile(Producto::RUTA_IMAGENES_PRODUCTO, Producto::RUTA_IMAGENES_SHOP);

            $prodRepository = App::getRepository(ProductoRepository::class);

            //$prodRepository->save($productoTienda);
            $prodRepository->guarda($productoTienda);

            //Log: cada vez que se cree un producto, se guarda en el log un mensaje
            $message = "Se ha guardado un nuevo producto: " . $productoTienda->getTitulo();
            App::get('logger')->add($message);

            FlashMessage::set('mensaje', $message);

            //Al crearse correctamente, se limpia el form
            FlashMessage::unset('titulo');
            FlashMessage::unset('subtitulo');
            FlashMessage::unset('descripcion');
            FlashMessage::unset('categoriaSeleccionada');
            FlashMessage::unset('precio');


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
            FlashMessage::set('errores', [ $fileException->getMessage() ]);
        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('errores', [ $validationException->getMessage() ]);
        }

        App::get('router')->redirect('productos');
    }

    /**
     * @param int $id
     * @throws NotFoundException
     * @throws QueryException
     */
    public function show(int $id)
    {
        $producto = App::getRepository(ProductoRepository::class)->find($id);

        Response::renderView('show-producto', 'layout', compact('producto'));
    }
}