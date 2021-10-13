
<div class="row">


    <?php foreach ($GLOBALS['imagenes'] as $imagen): ?>

        <div class="col-md-3 shop_box"><a href="single.php">
                <img src=<?= $imagen->getUrlImagen()?> class="img-responsive" alt="<?= $imagen->getTitulo()?>" />
                <div class="shop_desc">
                    <h3><a href="#"><?= $imagen->getTitulo()?></a></h3>
                    <p> <?= $imagen->getSubtitulo()?> </p>
                    <span class="actual"><?= $imagen->getPrecio()?>€</span><br>
                    <ul class="buttons">
                        <li class="cart"><a href="#">Add To Cart</a></li>
                        <li class="shop_btn"><a href="#">Read More</a></li>
                        <div class="clear"> </div>
                    </ul>
                </div>
            </a></div>

    <?php endforeach; ?>

</div>
