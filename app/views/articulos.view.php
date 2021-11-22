
<div id="articulos">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>Artículos</h1>
            <hr>

            <div>
                <?php include __DIR__ . '/partials/show-error.part.php' ?>

                <form class="form-horizontal" method="post" action="/articulos/nuevo" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Nombre</label>
                            <input class="form-control" type="text" name="nombre" value="<?= $nombre ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Precio</label>
                            <input class="form-control" type="number" name="precio" value="<?= $precio ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Fecha caducidad</label>
                            <input class="form-control" type="date" name="fecha_caducidad" value="<?= $fecha_caducidad ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Imagen</label>
                            <input class="form-control" type="file" name="imagen">
                            <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                        </div>
                    </div>
                </form>
            </div>

            <hr>

            <div class="clear">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Fecha Caducidad</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Usuario</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (($articulos ?? []) as $articulo) : ?>
                        <tr>
                            <th scope="row"><?= $articulo->getId() ?></th>
                            <td><?= $articulo->getNombre() ?></td>
                            <td><?= $articulo->getPrecio() ?></td>
                            <td><?= $articulo->getFechaCaducidad() ?></td>
                            <td>
                                <img src="<?= $articulo->getUrlImagen() ?>"
                                     alt="<?= $articulo->getUrlImagen() ?>"
                                     title="<?= $articulo->getNombre() ?>"
                            </td>
                            <td><?= $articulo->getUsuario() ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
