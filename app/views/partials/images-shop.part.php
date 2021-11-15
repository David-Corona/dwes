
<div class="row">


    <?php foreach ($GLOBALS['productos'] as $producto): ?>

        <div class="col-md-3 shop_box"><a href="single.php">
                <img src=<?= $producto->getNombreImagen()?> class="img-responsive" alt="<?= $producto->getTitulo()?>" />
                <div class="shop_desc">
                    <h3><a href="#"><?= $producto->getTitulo()?></a></h3>
                    <p> <?= $producto->getSubtitulo()?> </p>
                    <span class="actual"><?= $producto->getPrecio()?>€</span><br>
                    <ul class="buttons">
                        <li class="cart"><a href="#">Add To Cart</a></li>
                        <li class="shop_btn"><a href="#">Read More</a></li>
                        <div class="clear"> </div>
                    </ul>
                </div>
            </a></div>

    <?php endforeach; ?>

</div>
