<?php

    require_once 'entity/Producto.php';
    require_once 'repository/ProductoRepository.php';
    require_once 'core/App.php';
    require_once 'database/Connection.php';

    $config = require_once 'app/config.php';
    App::bind('config', $config);

    $prodRepository = new ProductoRepository();
    $productos = $prodRepository->findAll();

    require 'utils/utils.php';
    require 'views/shop.view.php';
