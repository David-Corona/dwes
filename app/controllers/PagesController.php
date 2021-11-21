<?php
namespace cursophp7dc\app\controllers;

use cursophp7dc\app\exceptions\QueryException;
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
    }

    public function checkout()
    {
        Response::renderView('checkout', 'layout');
    }

}