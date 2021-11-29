
<div class="main">
    <div class="container">
        <div class="row">

            <h1>Detalles Usuario</h1>
            <hr>
            <div class="clear">
                <p>Nombre de usuario: <?= $usuario->getUsername() ?></p>
                <p>Tipo de usuario: <?= $usuario->getRole() ?></p>
                <p>Número de artículos publicados: <?= $usuario->getNumArticulos() ?></p>
            </div>
            <br>
            <br>

            <h1>Editar Usuario</h1>
            <hr>
            <?php include __DIR__ . '/partials/show-error.part.php' ?>

            <form method="post" action="/usuarios/editar/<?= $usuario->getId()?>" enctype="multipart/form-data">
                <div class="">
                    <p><label for="rol">Rol de Usuario:</label>
                        <select name="rol">
                            <option value="ROLE_USER">USER</option>
                            <option value="ROLE_ADMIN">ADMIN</option>
                        </select>
                        <button class="btn btn-lg sr-button">Cambiar</button></p>
                </div>
            </form>
            <br>

            <h1>Eliminar Usuario</h1>
            <hr>
            <form method="post" action="/usuarios/eliminar/<?= $usuario->getId()?>" enctype="multipart/form-data">
                <div class="">
                    <p><label for="rol">¿Eliminar Usuario? </label>
                        <button class="btn btn-lg sr-button">Eliminar</button></p>
                </div>
            </form>


        </div>
    </div>
</div>