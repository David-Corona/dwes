
<div id="usuarios">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>Usuarios</h1>
            <hr>

            <?php include __DIR__ . '/partials/show-error.part.php' ?>

            <div class="clear">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre Usuario</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Nº Artículos</th>
                        <th scope="col">Administrar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (($usuarios ?? []) as $usuario) : ?>
                        <tr>
                            <th scope="row"><?= $usuario->getId() ?></th>
                            <td><?= $usuario->getUsername() ?></td>
                            <td><?= $usuario->getRole() ?></td>
                            <td><?= $usuario->getNumArticulos() ?></td>
                            <td><a href="/usuarios/<?= $usuario->getId()?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>