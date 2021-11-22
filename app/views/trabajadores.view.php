


<div id="trabajadores">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>Trabajadores</h1>
            <hr>

            <div>
                <?php include __DIR__ . '/partials/show-error.part.php' ?>

                <form class="form-horizontal"  method="post" action="/trabajadores/nuevo" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Nombre</label>
                            <input class="form-control" type="text" name="nombre" value="<?= $nombre ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Apellidos</label>
                            <input class="form-control" type="text" name="apellidos" value="<?= $apellidos ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Foto</label>
                            <input class="form-control" type="file" name="foto">
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
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (($trabajadores ?? []) as $trabajador) : ?>
                        <tr>
                            <th scope="row"><?= $trabajador->getId() ?></th>
                            <td>
                                <img src="<?= $trabajador->getUrlFoto() ?>"
                                     alt="<?= $trabajador->getUrlFoto() ?>"
                                     title="<?= $trabajador->getNombre() ?>"
                            </td>
                            <td><?= $trabajador->getNombre() ?></td>
                            <td><?= $trabajador->getApellidos() ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
