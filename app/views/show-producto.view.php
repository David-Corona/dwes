
    <div class="main">
        <div class="container">
            <div class="row">

                <h1>Detalles Producto</h1>
                <hr>
                <div class="clear">
                    <img src="/<?= $producto->getUrlImagenMini() ?>"
                         alt="/<?= $producto->getNombreImagen() ?>"
                         title="/<?= $producto->getTitulo() ?>"
                    >
                    <p>Nombre: <?= $producto->getTitulo() ?></p>
                    <p>Descripción: <?= $producto->getDescripcion() ?></p>
                    <p>Precio: <?= $producto->getPrecio() ?> €</p>
                    <p>Usuario: <?= $prodRepository->getUsuario($producto)->getUsername() ?></p>
                </div>
            </div>
        </div>
    </div>
