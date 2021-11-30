

<div class="main">
    <div class="container">
        <div class="row">
            <br>
            <h1>Detalles Producto</h1>
            <hr>
            <div class="clear">
                <p>Título: <?= $producto->getTitulo() ?></p>
                <p>Subtítulo: <?= $producto->getSubtitulo() ?></p>
                <p>Descripción: <?= $producto->getDescripcion() ?></p>
                <p>Categoría: <?= $prodRepository->getCategoria($producto)->getNombre() ?></p>
                <p>Precio: <?= $producto->getPrecio() ?>€</p>
                <p>Usuario: <?= $prodRepository->getUsuario($producto)->getUsername() ?></p>
            </div>
            <br>
            <br>

            <h1>Editar Producto</h1>
            <hr>
            <?php include __DIR__ . '/partials/show-error.part.php' ?>
            <form method="post" action="/admin-producto/editar/<?= $producto->getId()?>" enctype="multipart/form-data">
                <div class="">
                    <p><label for="titulo">Título</label>
                        <input type="text" class="text" name="titulo" value="<?php echo $producto->getTitulo(); ?>" required></p>

                    <p><label for="subtitulo">Subtítulo</label>
                        <input type="text" class="text" name="subtitulo" value="<?php echo $producto->getSubtitulo(); ?>" required></p>

                    <p><label for="descripcion">Descripción</label>
                        <textarea name="descripcion" rows="5" cols="40" ><?php echo $producto->getDescripcion(); ?></textarea></p>

                    <p><label for="categoria">Categoría</label>
                        <select name="categoria">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?= $categoria->getId() ?>"
                                    <?= ($producto->getCategoria() == $categoria->getId()) ? 'selected' : '' ?>
                                ><?= $categoria->getNombre() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    <p><label for="precio">Precio</label>
                        <input type="number" name="precio" min="0.00" max="1000" step="0.01" value="<?php echo $producto->getPrecio(); ?>" required></p>

                    <!--<p><label for="imagen">Imagen</label>
                        <input type="file" class="form-control" name="imagen" ></p>-->

                    <button class="btn btn-lg sr-button">Actualizar</button>
                </div>
            </form>
            <br>

            <h1>Eliminar Producto</h1>
            <hr>
            <form method="post" action="/admin-producto/eliminar/<?= $producto->getId()?>" enctype="multipart/form-data">
                <div class="">
                    <p><label for="rol">¿Eliminar Producto? </label>
                        <button class="btn btn-lg sr-button">Eliminar</button></p>
                </div>
            </form>
            <br>

        </div>
    </div>
</div>
