
<div class="row">

    <?php foreach ($productos as $producto): ?>

        <div class="col-md-3 shop_box"><a href="/productos/<?= $producto->getId()?>">
                <img src=<?= $producto->getUrlImagen()?> class="img-responsive" alt="<?= $producto->getTitulo()?>" />
                <div class="shop_desc">
                    <h3><a href="#"><?= $producto->getTitulo()?></a></h3>
                    <p> <?= $producto->getSubtitulo()?> </p>
                    <span class="actual"><?= $producto->getPrecio()?>€</span><br>
                    <ul class="buttons">
                        <li class="cart"><a href="#">Añadir a Cesta</a></li>
                        <li class="shop_btn"><a href="/productos/<?= $producto->getId()?>">Ver Detalles</a></li>
                        <div class="clear"> </div>
                    </ul>
                </div>
            </a></div>

    <?php endforeach; ?>

</div>
