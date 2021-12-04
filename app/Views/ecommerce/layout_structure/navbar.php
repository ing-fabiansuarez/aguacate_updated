<div class="header" id="home">
    <div class="container">
        <ul>
            <!-- <li> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Sign In </a></li>
				<li> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sign Up </a></li> -->
            <li><i class="fa fa-whatsapp" aria-hidden="true"></i><a href="https://api.whatsapp.com/send?phone=573228853850">WhatsApp : 3228853850</a></li>
            <!--  <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:administracion@kathecreativa.com">Email: @kathecreativa.com</a></li> -->
        </ul>
    </div>
</div>

<div class="header-bot">
    <div class="header-bot_inner_wthreeinfo_header_mid">
        <div class="col-md-4 text-center header-middle">
            <a href="<?= base_url() ?>">
                <img style="max-width: 100px;min-width: 100px;" src="<?= base_url() ?>/assets/img/corporative/logoa.png">
            </a>
        </div>
        <!-- header-bot -->
        <div class="col-md-4 logo_agile">
            <h1 class="text-center">
                <a href="<?= base_url() ?>">
                    <img style="width: 60%;" src="<?= base_url() ?>/assets/img/corporative/creo_en_mi_me_lo_merezco.png">
                </a>
            </h1>
        </div>
        <!-- header-bot -->
        <div class="col-md-4 agileits-social top_content">
            <ul class="social-nav model-3d-0 footer-social w3_agile_social">
                <li>
                    <a href="https://www.instagram.com/aguacatebykathe/" class="instagram">
                        <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/meillykatherinne" class="facebook">
                        <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                    </a>
                </li>
                <li>
                    <a href="https://api.whatsapp.com/send?phone=573228853850" class="instagram">
                        <div class="front"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="ban-top">
    <div class="container">
        <div class="top_nav_left">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav menu__list">
                            <li class="menu__item <?= $this->renderSection('nav_home') ?>"><a class="menu__link" href="<?= base_url() ?>">Inicio <span class="sr-only">(current)</span></a></li>
                            <!--  <li class="menu__item <?= $this->renderSection('nav_new') ?>"><a class="menu__link" href="<?= base_url() . route_to('section_new_ecommerce') ?>">Nuevo</a></li> -->
                            <li class="menu__item <?= $this->renderSection('vlargos') ?><?= $this->renderSection('vcortos') ?>">
                                <a class="menu__link" href="#" class="dropdown-toggle" data-toggle="dropdown">Vestidos <b class="caret"></b></a>
                                <ul class="dropdown-menu agile_short_dropdown">
                                    <li><a href="<?= base_url() . route_to('view_categories_section', 'vlargos') ?>">Vestidos Largos</a></li>
                                    <li><a href="<?= base_url() . route_to('view_categories_section', 'vcortos') ?>">Vestidos Cortos</a></li>
                                </ul>
                            </li>
                            <li class="menu__item <?= $this->renderSection('sets') ?>"><a class="menu__link" href="<?= base_url() . route_to('view_categories_section', 'sets') ?>">Sets</a></li>
                            <li class="menu__item <?= $this->renderSection('enterizos') ?>"><a class="menu__link" href="<?= base_url() . route_to('view_categories_section', 'enterizos') ?>">Enterizos</a></li>
                            <li class="menu__item <?= $this->renderSection('blusas') ?>"><a class="menu__link" href="<?= base_url() . route_to('view_categories_section', 'blusas') ?>">Blusas</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Button trigger modal -->

        <!-- <div class="top_nav_right">
            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                <button id="button_cart" type="button" class="w3view-cart" data-toggle="modal" data-target="#exampleModal">
                    <i style="font-size: 2.3rem;" class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                </button>
            </div>
        </div> -->

        <div class="top_nav_right">
            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                <form action="<?= base_url() . route_to('shoppingcart') ?>" method="get">
                    <button type="submit" class="w3view-cart">
                        <img style="max-height: 2.5rem;" src="<?= base_url() ?>/assets/img/icons/cart.png" alt="" class="img-fluid">
                    </button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>