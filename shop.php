<?php

    require_once 'entity/ImagenProducto.php';

    /**
     * @var ImagenProducto[] $imagenes
     */
    $imagenes = [
        new ImagenProducto('BULLPADEL VERTEX 03 21', 'La joya de Maxi Sánchez', 274.95, 'BP_Vertex.jpg'),
        new ImagenProducto('BULLPADEL VERTEX HYBRID FLY KAKI', 'Seguridad en cada pisada', 89.96, 'BP_Vertex_Hyb.jpg'),
        new ImagenProducto('MOCHILA BULLPADEL BPM-21004', 'MID 005 negro verde', 25.46, 'Mochila_BP.jpg'),
        new ImagenProducto('DUNLOP AERO-STAR PRO', 'Golpes llenos de potencia y gran confort', 224.90, 'Dunlop_Aero-Star.jpg'),
        new ImagenProducto('HEAD GRAPHENE 360 ALPHA TOUR', 'Excelente potencia y gran control.', 139.00, 'Head_Graph360.jpg'),
        new ImagenProducto('BOLAS BLACK CROWN PRO', 'Pack 3 botes', 14.50, 'Bolas_BC.jpg'),
        new ImagenProducto('PACK BLACK CROWN PITON', 'Incluye pala, bandolera Siux, monedero Vision y overgrip.', 146.00, 'Pack_BP_Piton.jpg'),
        new ImagenProducto('BULLPADEL FLOW', 'Para para mujer, ofrece un juego lleno de comodidad.', 199.95, 'BP_Flow.jpg')
    ];


    require 'utils/utils.php';
    require 'views/shop.view.php';
