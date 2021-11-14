<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Carrito de Compras<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">
                <ul class="w3_short">
                    <li><a href="<?= base_url() . route_to('home_ecommerce') ?>">Inicio</a><i>|</i></li>
                    <li>Carrito de compras</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>

<div class="banner-bootom-w3-agileits">
    <div class="container">
        <div class="single-pro">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Tu carrito de compras est&aacute; vac&iacute;o</h1><br>
                </div>
            </div>

            <div class="row text-right">
                <a href="<?= base_url() . route_to('section_new_ecommerce') ?>" class="btn btn-aguacate">Ver lo nuevo</a>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>