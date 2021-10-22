<?php

    require_once 'entity/ImagenProducto.php';
    require_once 'repository/ProductoRepository.php';
    require_once 'core/App.php';
    require_once 'database/Connection.php';

    /**
     * @var ImagenProducto[] $imagenes
     */
    $imagenes = [
        new ImagenProducto('BULLPADEL VERTEX 03 21', 'La joya de Maxi Sánchez', 'BP_Vertex.jpg', 1,274.95),
        new ImagenProducto('BULLPADEL VERTEX HYBRID FLY KAKI', 'Seguridad en cada pisada', 'BP_Vertex_Hyb.jpg', 1,89.96),
        new ImagenProducto('MOCHILA BULLPADEL BPM-21004', 'MID 005 negro verde', 'Mochila_BP.jpg', 3,25.46),
        new ImagenProducto('DUNLOP AERO-STAR PRO', 'Golpes llenos de potencia y gran confort', 'Dunlop_Aero-Star.jpg', 1,224.90),
        new ImagenProducto('HEAD GRAPHENE 360 ALPHA TOUR', 'Excelente potencia y gran control.', 'Head_Graph360.jpg', 1,139.00),
        new ImagenProducto('BOLAS BLACK CROWN PRO', 'Pack 3 botes', 'Bolas_BC.jpg', 3, 14.50),
        new ImagenProducto('PACK BLACK CROWN PITON', 'Incluye pala, bandolera Siux, monedero Vision y overgrip.', 'Pack_BP_Piton.jpg', 1,146.00),
        new ImagenProducto('BULLPADEL FLOW', 'Para para mujer, ofrece un juego lleno de comodidad.', 'BP_Flow.jpg', 1, 199.95)
    ];

    $config = require_once 'app/config.php';
    App::bind('config', $config);

    $prodRepository = new ProductoRepository();
    $productos = $prodRepository->findAll();


    require 'utils/utils.php';
    require 'views/shop.view.php';
