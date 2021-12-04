<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Producto<?= $this->endSection() ?>

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
            animation: "slide",
            controlNav: "thumbnails"
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
                    <li>Producto</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>


<div class="banner-bootom-w3-agileits">
    <div style="padding-top: 3rem;" class="container">
        <div class="col-md-1"></div>
        <div class="col-md-4 single-right-left ">
            <div class="grid images_3_of_2">
                <div class="flexslider">

                    <ul class="slides">
                        <?php foreach ($images as $image) : ?>
                            <li data-thumb="<?= base_url($image['path_thumb_image']) ?>">
                                <div class="thumb-image"> <img src="<?= base_url($image['path_image']) ?>" data-imagezoom="true" class="img-responsive"> </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 single-right-left ">
            <h3><?= $category['name_category'] ?></h3>
            <br>
            <h2>
                <span class="item_price">$ <?= number_format($product->price_product) ?></span> <!-- <del>- $900</del> -->
            </h2>
            <br>
            <!-- <div class="rating1">
                <span class="starRating">
                    <input id="rating5" type="radio" name="rating" value="5">
                    <label for="rating5">5</label>
                    <input id="rating4" type="radio" name="rating" value="4">
                    <label for="rating4">4</label>
                    <input id="rating3" type="radio" name="rating" value="3" checked="">
                    <label for="rating3">3</label>
                    <input id="rating2" type="radio" name="rating" value="2">
                    <label for="rating2">2</label>
                    <input id="rating1" type="radio" name="rating" value="1">
                    <label for="rating1">1</label>
                </span>
            </div> -->
            <form action="<?= base_url() . route_to('shoppingcart') ?>" method="post">
                <div class="occasional">
                    <h5>TALLAS DISPONIBLES :</h5>
                    <fieldset>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <?php
                            foreach ($sizes as $size) :
                            ?>
                                <label class="btn btn-secondary <?php if ($size['quantity_stock'] <= 0) {
                                                                    echo 'disabled';
                                                                } ?>">
                                    <input type="radio" name="id_size" id="option1" value="<?= $size['id_size'] ?>" required> <?= $size['name_size'] ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>
                </div>
                <?php if (session('stock')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?=session('stock')?>
                    </div>
                <?php endif; ?>
                <div style="width: 100%;" class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                    <input type="hidden" name="r" value="addproduct">
                    <input type="hidden" name="id_product" value="<?= $product->id_product ?>">
                    <input type="submit" value="Agregar al Carrito" class="button">
                </div>
            </form>
            <ul class="social-nav model-3d-0 footer-social w3_agile_social single_page_w3ls">
                <li class="share"> </li>
                <li>
                    <a target="_blank" href="https://www.instagram.com/aguacatebykathe/" class="instagram">
                        <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://www.facebook.com/meillykatherinne" class="facebook">
                        <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=573228853850" class="instagram">
                        <div class="front"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<?= $this->endSection() ?>