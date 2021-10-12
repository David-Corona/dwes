<?php
    require 'utils/utils.php';
    require 'views/shop.view.php';



require 'entity/ImagenProducto.php';
$imagenProducto = new ImagenProducto('laurl', 'eltitulo', 'elsubtit', 0.5);
echo $imagenProducto;