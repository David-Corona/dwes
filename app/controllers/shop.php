<?php

    require_once 'entity/Producto.php';
    require_once 'repository/ProductoRepository.php';
    require_once 'core/App.php';
    require_once 'database/Connection.php';


    $prodRepository = new ProductoRepository();
    $productos = $prodRepository->findAll();

    require 'utils/utils.php';
    require __DIR__ . '/../views/shop.view.php';
