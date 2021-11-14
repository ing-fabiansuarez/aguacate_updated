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
            25 %
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col" style="width: 200px;">Producto</th>
                            <th scope="col">Talla</th>
                            <th scope="col">Catidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalShoppingCart = 0;
                        foreach ($items as $item) :
                            $total = $item['quantity'] * $item['product']->price_product;
                            $totalShoppingCart += $total;
                        ?>
                            <tr>
                                <td>
                                    <form action="<?= base_url() . route_to('delete_item_cart') ?>" method="post">
                                        <input type="hidden" name="id_size" value="<?= $item['id_size'] ?>">
                                        <input type="hidden" name="id_product" value="<?= $item['product']->id_product ?>">
                                        <button type="submit" class="agile-icon">
                                            <i style="color: red; font-size: 1.5rem;" class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <img style="width: 100px;" src="<?= $item['product']->getImages()[0]['path_thumb_image'] ?>" alt="" class="img-thumbnail">
                                </td>
                                <td><?= $item['name_size'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>$ <?= number_format($item['product']->price_product) ?></td>
                                <td><b>$ <?= number_format($total) ?></b></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL EN PRODUCTOS</th>
                            <th>$ <?= number_format($totalShoppingCart) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row text-right">
                <a style="background: grey;" href="<?= base_url() . route_to('section_new_ecommerce') ?>" class="btn btn-aguacate">Seguir Comprando</a>

                <a href="<?= base_url() . route_to('view_customer_data') ?>" class="btn btn-aguacate">Finalizar compra</a>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>