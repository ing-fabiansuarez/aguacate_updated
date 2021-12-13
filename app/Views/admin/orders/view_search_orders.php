<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Buscar Pedidos<?= $this->endSection() ?>
<?= $this->section('searchproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Busqueda de pedidos</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() . route_to('admin_page_home') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Buscar pedidos</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="card" style="text-align:center;">
        <div class="card-header">
            Busqueda por N° identificacion
        </div>
        <div class="card-body">
            <div class="row">

                <form action="<?php base_url() . route_to('view_search_orders') ?>" method="get" id="FormularioCentrado">
                    <div class="col-lg-6 col-7">
                        <input type="number" class="form-control" placeholder="Ingrese el numero de identificacion" id="documento" name="documento">
                        <button class="btn btn-round btn-primary" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="container">
                <?php
                foreach ($orders as $order) :
                    $shoppingInfo = $order->getShoppingInfo();
                    $orderDetail = $order->getDetailProductWithProducts();
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">
                                    Estado Pedido:&nbsp;
                                    <span class="badge badge-dot mr-4" style="color:black">
                                        <?php if ($order->state_order == 'APPROVED') : ?>
                                            <i class="bg-success"></i>
                                        <?php elseif ($order->state_order == 'PENDING') : ?>
                                            <i class="bg-info"></i>
                                        <?php else : ?>
                                            <i class="bg-warning"></i>
                                        <?php endif; ?>
                                        <span class="status"><?= $order->state_order ?></span>
                                    </span>
                                    <br>
                                    Consecutivo: <?= $order->cosecutive_order ?><br>
                                    Referencia: <?= $order->ref_orderpw ?><br>
                                    Solicitado: <?= $order->created_at_orderpw ?><br>
                                    Actualizado: <?= $order->updated_at_orderpw ?><br>
                                </a>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card">
                                                <h4 class="card-header">
                                                    <b>Nombre: </b><?= $shoppingInfo['name_shoppinginfo'] . ' ' . $shoppingInfo['surname_shoppinginfo'] ?><br>
                                                    <b>Cedula: </b><?= $shoppingInfo['cedula_num_shoppinginfo'] ?><br>
                                                    <b>Telefono: </b><?= $shoppingInfo['num_phone'] ?>
                                                </h4>
                                                <div class="card-body" style="text-align:left;">
                                                    <label>
                                                        <b>Ubicacion: </b><?= $order->name_city ?> - <?= $order->name_department ?><br>
                                                        <b>Barrio: </b><?= $order->neighborhood_shippinginfo ?><br>
                                                        <b>Direccion: </b><?= $order->address_shippinginfo ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="table-responsive" style="background-color:#D290F4;">
                                                <table class="table">
                                                    <thead>
                                                        <tr style="color:black">
                                                            <th></th>
                                                            <th>Ref</th>
                                                            <th>Producto</th>
                                                            <th>Talla</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="background-color:white;">
                                                        <?php
                                                        foreach ($orderDetail as $orderD){
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <button type="button"  data-bs-toggle="modal" data-bs-target="#Modal" onclick="EnvioInformacion('<?= $orderD['product']->name_product; ?>','<?= base_url($orderD['product']->getImages()[0]['path_image']) ?>')" style="">
                                                                        <img src="<?= base_url($orderD['product']->getImages()[0]['path_thumb_image']) ?>" width="40px" height="50px">
                                                                    </button>
                                                                    <!-- Modal -->
                                                                </td>
                                                                <td><?= $orderD['detail']['order_pw_ref']; ?> </td>
                                                                <td><?= $orderD['product']->name_product; ?></td>
                                                                <td><?= $orderD['size']['name_size']; ?></td>
                                                                <td><?= $orderD['detail']['stock_size_id']; ?></td>
                                                                <td><?= $orderD['detail']['price_sale']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b>Flete</b></td>
                                                            <td>$ <?= $order->price_typejourney ?> COP</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b>TOTAL</b></td>
                                                            <td>$ <?= number_format($order->getPrices()['TOTAL']) ?> COP</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="text-align:center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Label"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="Img" width="50%" height="60%">
                </div>
            </div>
        </div>
    </div>
    <script>
        function EnvioInformacion(Nombre, Imagenes) {
            document.getElementById("Label").innerText = Nombre;
            document.getElementById("Img").setAttribute("src", Imagenes)
        }
    </script>

    <?= $this->include('admin/layout_structure/footer') ?>
</div>
<?= $this->endSection() ?>