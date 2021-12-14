<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-primary-soft" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="<?= base_url() ?>/assets/img/corporative/logonegro.png" class="navbar-brand-img"><br>
                <img src="<?= base_url() ?>/assets/img/corporative/aguacate.png" class="navbar-brand-img">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Estad&iacute;sticas</span>
                        </a>
                    </li>
                </ul>

                <hr class="my-3">

                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">PRODUCTOS</span>
                </h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('newproduct') ?>" href="<?= base_url() . route_to('view_main_products') ?>">
                            <i class="ni ni-pin-3 text-primary"></i>
                            <span class="nav-link-text">Nuevo Producto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('listproduct') ?>" href="<?= base_url() . route_to('view_list_of_products') ?>?categoria=1">
                            <i class="ni ni-pin-3 text-primary"></i>
                            <span class="nav-link-text">Listado de Productos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('searchproduct') ?>" href="<?= base_url() . route_to('view_search_products') ?>">
                            <i class="ni ni-pin-3 text-primary"></i>
                            <span class="nav-link-text">Buscar Producto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('listorderdaily') ?>" href="<?= base_url() . route_to('view_daily_orders', date("Y-m-d")) ?>">
                            <i class="ni ni-bullet-list-67 text-default"></i>
                            <span class="nav-link-text">Pedidos Diarios</span>
                        </a>
                    </li>
                </ul>

                <hr class="my-3">

                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">PEDIDOS</span>
                </h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $this->renderSection('searchpedidos') ?>" href="<?= base_url() . route_to('view_search_orders') ?>">
                            <i class="ni ni-pin-3 text-primary"></i>
                            <span class="nav-link-text">Buscar pedidos</span>
                        </a>
                    </li>
                </ul>



                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Tienda fisica</span>
                </h6>
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . route_to('view_search_client') ?>">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Ventas tienda fisica</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>