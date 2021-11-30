
<div id="compras">
    <div class="container">
        <div class="col">
            <br>
            <h1>Compras realizadas</h1>
            <hr>

            <div class="clear">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Fecha Compra</th>
                        <th scope="col">Id Usuario</th>
                        <th scope="col">Nombre Usuario</th>
                        <th scope="col">Id Producto</th>
                        <th scope="col">Título Producto</th>
                        <th scope="col">Precio Producto</th>
                        <th scope="col">Imagen Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (($compras ?? []) as $compra) : ?>
                        <tr>
                            <td><?= $compra->getFecha() ?></td>
                            <td><?= $compra->getIdUsuario() ?></td>
                            <td><?= $compraRepository->getUsuario($compra)->getUserName() ?></td>
                            <td><?= $compra->getIdProducto() ?></td>
                            <td><?= $compraRepository->getProducto($compra)->getTitulo() ?></td>
                            <td><?= $compraRepository->getProducto($compra)->getPrecio() ?>€</td>
                            <td>
                                <img src="/<?= $compraRepository->getProducto($compra)->getUrlImagenMini() ?>"
                                     alt="/<?= $compraRepository->getProducto($compra)->getNombreImagen() ?>"
                                     title="<?= $compraRepository->getProducto($compra)->getTitulo() ?>"
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
