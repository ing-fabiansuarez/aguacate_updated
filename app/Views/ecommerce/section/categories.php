<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?><?= $category['name_category'] ?><?= $this->endSection() ?>
<?= $this->section($category['prefijo_category']) ?>menu__item--current<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">
                <ul class="w3_short">
                    <li><a href="<?= base_url() . route_to('home_ecommerce') ?>">Inicio</a><i>|</i></li>
                    <li><?= $category['name_category'] ?></li>
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
                        <div class="men-thumb-item">
                            <img src="<?php if (count($images) >= 2) : echo base_url($images[0]['path_thumb_image']);
                                        endif ?>" alt="" class="pro-image-front">
                            <img src="<?php if (count($images) >= 2) : echo base_url($images[1]['path_thumb_image']);
                                        endif ?>" alt="" class="pro-image-back">
                            <div class="men-cart-pro">
                                <div class="inner-men-cart-pro">
                                    <a href="<?= base_url() . route_to('view_single_product') ?>?id=<?= $product->id_product ?>" class="link-product-add-cart">Ver Producto</a>
                                </div>
                            </div>
                            <?php if ($product->new_product) : ?>
                                <span class="product-new-top">Nuevo</span>
                            <?php endif; ?>
                        </div>
                        <div class="item-info-product ">
                            <h4><a href="#"><?= $category['name_category'] ?></a></h4>
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