<?php
namespace cursophp7dc\app\controllers;

use cursophp7dc\app\exceptions\QueryException;
use cursophp7dc\app\repository\MensajeRepository;
use cursophp7dc\app\repository\ProductoRepository;
use cursophp7dc\core\App;
use cursophp7dc\core\Response;

class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $productos = App::getRepository(ProductoRepository::class)->findAll();

        Response::renderView('index', 'layout', compact('productos'));

        //require __DIR__ . '/../views/index.view.php';
        //require App::get('router')->direct(Request::uri(), Request::method());
    }

    public function checkout()
    {
        Response::renderView('checkout', 'layout');
        //require __DIR__ . '/../views/checkout.view.php';
    }




}