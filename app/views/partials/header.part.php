<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-left">
                    <div class="logo">
                        <a href="/"><img src="../images/logopadel.png" alt=""/></a>
                    </div>
                    <div class="menu">
                        <a class="toggleMenu" href="#"><img src="../images/nav.png" alt="" /></a>
                        <ul class="nav" id="nav">
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('index') ? 'current' : '' ?>" >
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('index') ? '#' : '/' ?>">Inicio</a>
                            </li>
                            <?php if (is_null($app['user'])) : ?>
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('login') ? 'current' : '' ?>">
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('login') ? '#' : '/login' ?>">Login</a>
                            </li>
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('registro') ? 'current' : '' ?>">
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('registro') ? '#' : '/registro' ?>">Registro</a>
                            </li>
                            <?php else: ?>
                            <!--<li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('productos') ? 'current' : '' ?>" >
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('productos') ? '/productos' : '/productos' ?>">Productos</a>
                            </li>-->
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('articulos') ? 'current' : '' ?>" >
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('articulos') ? '/articulos' : '/articulos' ?>">Artículos</a>
                            </li>
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('perfil') ? 'current' : '' ?>" >
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('perfil') ? '/perfil' : '/perfil' ?>">Perfil</a>
                            </li>
                                <?php if ($app['user']->getRole() === "ROLE_ADMIN") : ?>
                                    <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('usuarios') ? 'current' : '' ?>" >
                                        <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('usuarios') ? '/usuarios' : '/usuarios' ?>">Usuarios</a>
                                    </li>
                                <?php endif; ?>
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('logout') ? 'current' : '' ?>">
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('logout') ? '#' : '/logout' ?>">Logout (<?= $app['user']->getUsername() ?>)</a>
                            </li>
                            <?php endif; ?>
                            <li class="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('contact') ? 'current' : '' ?>">
                                <a href="<?= cursophp7dc\app\utils\Utils::opcionMenuActiva('contact') ? '#' : '/contact' ?>">Contacto</a>
                            </li>

                            <div class="clear"></div>
                        </ul>
                        <script type="text/javascript" src="../js/responsive-nav.js"></script>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="header_right">
                    <!-- start search-->
                    <div class="search-box">
                        <div id="sb-search" class="sb-search">
                            <form>
                                <input class="sb-search-input" placeholder="Buscar..." type="search" name="search" id="search">
                                <input class="sb-search-submit" type="submit" value="">
                                <span class="sb-icon-search"> </span>
                            </form>
                        </div>
                    </div>
                    <!----search-scripts---->
                    <script src="../js/classie.js"></script>
                    <script src="../js/uisearch.js"></script>
                    <script>
                        new UISearch( document.getElementById( 'sb-search' ) );
                    </script>
                    <ul class="icon1 sub-icon1 profile_img">
                        <li><a class="active-icon c1" href="#"> </a>
                            <ul class="sub-icon1 list">
                                <div class="product_control_buttons">
                                    <a href="#"><img src="../images/edit.png" alt=""/></a>
                                    <a href="#"><img src="../images/close_edit.png" alt=""/></a>
                                </div>
                                <div class="clear"></div>
                                <li class="list_img"><img src="../images/palapadel.png" alt="Imagen Producto"/></li>
                                <li class="list_desc"><h4><a href="#">Producto Pádel</a></h4><span class="actual">1 x
                          90.00€</span></li>
                                <div class="login_buttons">
                                    <div class="check_button"><a href="/checkout">Check out</a></div>
                                    <div class="login_button"><a href="/login">Login</a></div>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </ul>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
