<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Nuevo<?= $this->endSection() ?>
<?= $this->section('nav_new') ?>menu__item--current<?= $this->endSection() ?>



<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/ecommerce/flexslider1.css" type="text/css" media="screen" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- FlexSlider -->
<script src="<?= base_url() ?>/assets/js/ecommerce/jquery.flexslider.js"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    });
</script>
<!-- //FlexSlider-->
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">
                <ul class="w3_short">
                    <li><a href="<?= base_url() . route_to('home_ecommerce') ?>">Inicio</a><i>|</i></li>
                    <li>Nuevas colecciones</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>


<div class="banner-bootom-w3-agileits">
    <div class="container">
        <div class="single-pro">
            <?php foreach ($products as $product) :
                $images = $product->getImages();
            ?>
                <div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <a href="<?= base_url() . route_to('view_single_product') ?>?id=<?= $product->id_product ?>">
                            <div style="border: 0px;" class="flexslider">
                                <ul class="slides">
                                    <?php foreach ($product->getImages() as $image) : ?>
                                        <li>
                                            <img style="padding: 29px 20px 11px;" src="<?= base_url($image['path_thumb_image']) ?>" alt="">
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <br>
                        </a>
                        <div class="men-thumb-item">
                            <br>
                            <span class="product-new-top">Nuevo</span>
                        </div>
                        <div class="item-info-product ">
                            <h4><a href="single.html"><?= $product->name_category ?></a></h4>
                            <div class="info-product-price">
                                <span class="item_price">$ <?= number_format($product->price_product) ?></span>
                                <!-- <del>$69.71</del> -->
                            </div>
                            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                                <fieldset>
                                    <input type="hidden" id="id_product" name="id_product" value="<?= $product->id_product ?>">
                                    <input id="input_add" type="submit" value="Agregar al Carrito" class="button">
                                </fieldset>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>