<?php

namespace cursophp7dc\app\controllers;

use cursophp7dc\app\entity\Compra;
use cursophp7dc\app\entity\Producto;
use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\FileException;
use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\exceptions\ValidationException;
use cursophp7dc\app\repository\ArticuloRepository;
use cursophp7dc\app\repository\CategoriaRepository;
use cursophp7dc\app\repository\CompraRepository;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\app\utils\File;
use cursophp7dc\core\App;
use cursophp7dc\core\helpers\FlashMessage;
use cursophp7dc\core\Response;
use Exception;

class ProductoController
{
    /**
     * @throws AppException
     * @throws QueryException
     */
    public function index(int $id)
    {
        $prodRepository = App::getRepository(ProductoRepository::class);
        /*if (App::get('appUser')->getRole() === "ROLE_ADMIN"){
            $productos = $prodRepository->findAll();
        } else {*/
            $productos = $prodRepository->findAllUser($id);
        //}

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

            $productoTienda = new Producto($titulo, $subtitulo, $descripcion, $categoria, $precio, $imagen->getFileName(), App::get('appUser')->getId());

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

        }
        catch (FileException $fileException)
        {
            FlashMessage::set('errores', [ $fileException->getMessage() ]);
        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('errores', [ $validationException->getMessage() ]);
        }

        App::get('router')->redirect('productos/' . App::get('appUser')->getId());
    }

    /**
     * @param int $id
     * @throws AppException
     * @throws NotFoundException
     * @throws QueryException
     */
    public function show(int $id)
    {
        //$producto = App::getRepository(ProductoRepository::class)->find($id);
        $prodRepository = App::getRepository(ProductoRepository::class);
        $producto = $prodRepository->find($id);

        Response::renderView('show-producto', 'layout', compact('producto', 'prodRepository'));
    }

    /**
     * @param int $id
     * @throws AppException
     * @throws NotFoundException
     * @throws QueryException
     */
    public function admin(int $id)
    {
        try {

            $prodRepository = App::getRepository(ProductoRepository::class);
            $producto = $prodRepository->find($id);

            if (App::get('appUser')->getId() == $producto->getUsuario() || App::get('appUser')->getRole() === "ROLE_ADMIN") {
                $categorias = App::getRepository(CategoriaRepository::class)->findAll();

                $errores = FlashMessage::get('errores', []);
                $mensaje = FlashMessage::get('mensaje');
                $titulo = FlashMessage::get('titulo');
                $subtitulo = FlashMessage::get('subtitulo');
                $descripcion = FlashMessage::get('descripcion');
                $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
                $precio = FlashMessage::get('precio');

                Response::renderView('admin-producto', 'layout',
                    compact('producto', 'categorias', 'prodRepository', 'errores', 'mensaje', 'titulo',
                        'subtitulo', 'descripcion', 'categoriaSeleccionada', 'precio'));
            } else {
                App::get('router')->redirect('productos/' . $id);
            }
        }
        catch (Exception $exception)
        {
            FlashMessage::set('errores', [ $exception->getMessage() ]);
            App::get('router')->redirect('admin-producto/' . $producto->getID());
        }

    }


    /**
     * @param int $id
     * @throws AppException
     * @throws NotFoundException
     * @throws QueryException
     */
    public function editar(int $id)
    {
        try{

            $titulo = trim(htmlspecialchars($_POST['titulo']));
            FlashMessage::set('titulo', $titulo);
            $subtitulo = trim(htmlspecialchars($_POST['subtitulo']));
            FlashMessage::set('subtitulo', $subtitulo);
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion', $descripcion);
            $categoria = (int)$_POST['categoria'];
            FlashMessage::set('categoriaSeleccionada', $categoria);
            $precio = (float)$_POST['precio'];
            FlashMessage::set('precio', $precio);


            $producto = App::getRepository(ProductoRepository::class)->find($id);
            $producto->setTitulo($titulo);
            $producto->setSubtitulo($subtitulo);
            $producto->setDescripcion($descripcion);
            $producto->setCategoria($categoria);
            $producto->setPrecio($precio);

            App::getRepository(ProductoRepository::class)->update($producto);

            //Log
            $message = "Se ha modificado el producto " . $producto->getTitulo() .".";
            App::get('logger')->add($message);

            FlashMessage::set('mensaje', $message);

            App::get('router')->redirect('admin-producto/' . $producto->getID());
        }
        catch (ValidationException $validationException)
        {
            FlashMessage::set('errores', [ $validationException->getMessage() ]);
            App::get('router')->redirect('admin-producto/' . $producto->getID());
        }


    }

    /**
     * @param int $id
     * @throws AppException
     * @throws NotFoundException
     * @throws QueryException
     */
    public function eliminar(int $id)
    {
        try {
            $producto = App::getRepository(ProductoRepository::class)->find($id);

            App::getRepository(ProductoRepository::class)->delete($producto);

            //Log
            $message = "Se ha eliminado el producto " . $producto->getTitulo() . ".";
            App::get('logger')->add($message);

            App::get('router')->redirect('productos/' .  App::get('appUser')->getId());
        }
        catch (Exception $exception)
        {
            FlashMessage::set('errores', [ $exception->getMessage() ]);
            App::get('router')->redirect('admin-producto/' . $producto->getID());
        }
    }

    /**
     * @param int $id
     * @throws AppException
     * @throws NotFoundException
     * @throws QueryException
     */
    public function comprar(int $id)
    {
        $producto = App::getRepository(ProductoRepository::class)->find($id);

        $compra = new Compra(App::get('appUser')->getId(), $producto->getId());

        $compraRepository = App::getRepository(CompraRepository::class);

        $compraRepository->save($compra);

        $message = "El usuario " . App::get('appUser')->getUsername() . " ha realizado la compra del producto: " . $producto->getTitulo();
        App::get('logger')->add($message);

        App::get('router')->redirect('compras/' . App::get('appUser')->getId());
    }


}