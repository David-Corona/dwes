

<div class="main">
    <div class="container">
        <div class="row">

            <h1>Mi perfil</h1>
            <hr>

            <div class="clear">
                <p>Nombre de usuario: <?= $usuario->getUsername() ?></p>
                <p>Tipo de usuario: <?= $usuario->getRole() ?></p>
                <p>Número de artículos publicados: <?= $usuario->getNumArticulos() ?></p>
            </div>
            <hr>
            <h2>Cambiar contraseña:</h2>

            <?php include __DIR__ . '/partials/show-error.part.php' ?>

            <form class="form-horizontal" action="/perfil/cambioPass" method="post">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Contraseña:</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Repetir Contraseña:</label>
                        <input class="form-control" type="password" name="re-password">
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>