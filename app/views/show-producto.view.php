
    <div class="main">
        <div class="container">
            <div class="row">
                <br>
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
                    <hr>

                    <?php if ($app['user']) : ?>
                        <form class="form-horizontal" action="/comprar/<?= $producto->getId()?>" method="post">
                            <button class="pull-left btn btn-lg sr-button">Comprar</button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
