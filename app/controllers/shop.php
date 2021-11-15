<?php

    /*require_once 'entity/Producto.php';
    require_once 'repository/ProductoRepository.php';
    require_once 'core/App.php';
    require_once 'database/Connection.php';*/


use cursophp7dc\app\repository\ProductoRepository;

$prodRepository = new ProductoRepository();
$productos = $prodRepository->findAll();

    //require 'utils/Utils.php';
    require __DIR__ . '/../views/shop.view.php';
