<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-left">
                    <div class="logo">
                        <a href="index.php"><img src="../images/logo.png" alt=""/></a>
                    </div>
                    <div class="menu">
                        <a class="toggleMenu" href="#"><img src="../images/nav.png" alt="" /></a>
                        <ul class="nav" id="nav">
                            <li class="<?= opcionMenuActiva('index') ? 'current' : '' ?>" >
                                <a href="<?= opcionMenuActiva('index') ? '#' : 'index.php' ?>">Home</a>
                            </li>
                            <li class="<?= opcionMenuActivaEnArray(['shop', 'single']) ? 'current' : '' ?>" >
                                <a href="<?= opcionMenuActiva('shop') ? '#' : 'shop.php' ?>">Shop</a>
                            </li>
                            <li class="<?= opcionMenuActiva('team') ? 'current' : '' ?>" >
                                <a href="<?= opcionMenuActiva('team') ? '#' : 'team.php' ?>">Team</a>
                            </li>
                            <li class="<?= opcionMenuActiva('contact') ? 'current' : '' ?>">
                                <a href="<?= opcionMenuActiva('contact') ? '#' : 'contact.php' ?>">Contact</a>
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
                                <input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
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
                                <li class="list_img"><img src="../images/1.jpg" alt=""/></li>
                                <li class="list_desc"><h4><a href="#">velit esse molestie</a></h4><span class="actual">1 x
                          $12.00</span></li>
                                <div class="login_buttons">
                                    <div class="check_button"><a href="checkout.php">Check out</a></div>
                                    <div class="login_button"><a href="login.php">Login</a></div>
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
