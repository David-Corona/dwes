
    <div class="main">
        <div class="container">
            <div class="row">

                <h1>Imagen producto</h1>
                <hr>
                <div class="clear">
                    <img src="<?= $producto->getNombreImagen() ?>"
                         alt="<?= $producto->getNombreImagen() ?>"
                         title="<?= $producto->getTitulo() ?>"
                    >
                </div>
            </div>
        </div>
    </div>
