
    <div class="main">
        <div class="shop_top">
            <div class="container">
                <div class="row">
                    <h1>Alta nuevo producto</h1>
                    <hr>

                    <div>

                        <?php include __DIR__ . '/partials/show-error.part.php' ?>

                        <form method="post" action="/productos/nuevo" enctype="multipart/form-data">
                            <div class="">


                                <p><label for="titulo">(*) Título</label>
                                    <input type="text" class="text" name="titulo" value="<?= $titulo ?? '' ?>" required></p>

                                <p><label for="subtitulo">(*) Subtítulo</label>
                                    <input type="text" class="text" name="subtitulo" value="<?= $subtitulo ?? '' ?>" required></p>

                                <p><label for="descripcion">Descripción</label>
                                    <textarea name="descripcion" rows="5" cols="40" ><?= $descripcion ?? '' ?></textarea></p>

                                <p><label for="categoria">(*) Categoría</label>
                                    <select name="categoria">
                                        <?php foreach ($categorias as $categoria) : ?>
                                            <option value="<?= $categoria->getId() ?>"
                                                <?= ($categoriaSeleccionada == $categoria->getId()) ? 'selected' : '' ?>
                                            ><?= $categoria->getNombre() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                <p><label for="precio">(*) Precio</label>
                                    <input type="number" name="precio" min="0.00" max="1000" step="0.01" value="<?= $precio ?? '' ?>" required></p>

                                <p><label for="imagen">Imagen</label>
                                    <input type="file" class="form-control" name="imagen" ></p>

                                <button class="">ENVIAR</button>

                            </div>
                            <div class="clear">Los campos marcados con (*) son obligatorios.</div>
                        </form>
                    </div>
                    <hr>
                    <div class="clear">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Subtitulo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Administrar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (($productos ?? []) as $producto) : ?>
                                <tr>
                                    <th scope="row"><?= $producto->getId() ?></th>
                                    <td>
                                        <img src="<?= $producto->getUrlImagenMini() ?>"
                                             alt="<?= $producto->getUrlImagenMini() ?>"
                                             title="<?= $producto->getTitulo() ?>"
                                    </td>
                                    <td><?= $producto->getTitulo() ?></td>
                                    <td><?= $producto->getSubtitulo() ?></td>
                                    <td><?= $producto->getDescripcion() ?></td>
                                    <td><?= $prodRepository->getCategoria($producto)->getNombre() ?></td>
                                    <td><?= $producto->getPrecio() ?></td>
                                    <td><?= $prodRepository->getUsuario($producto)->getUsername() ?></td>
                                    <td><a href="/admin-producto/<?= $producto->getId()?>">Admin</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>


