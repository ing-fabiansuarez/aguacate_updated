<div class="modal-header">
    <h5 class="modal-title" id="modal-title">
        <b>CLIENTE: <?= $shoppinginfo['name_shoppinginfo'] . ' ' . $shoppinginfo['surname_shoppinginfo'] ?></b><br>
        Identificaci&oacute;n: <?= $shoppinginfo['cedula_num_shoppinginfo'] ?><br>
        Ref: <?= $orderpw->ref_orderpw ?><br>
        <span class="badge badge-dot mr-4">
            <?php if ($orderpw->state_order == 'APPROVED') : ?>
                <i class="bg-success"></i>
            <?php elseif ($orderpw->state_order == 'PENDING') : ?>
                <i class="bg-info"></i>
            <?php else : ?>
                <i class="bg-warning"></i>
            <?php endif; ?>
            <span style="font-size: 40px;" class="status"><?= $orderpw->state_order ?></span>
        </span>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div id="modal-body" class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Informaci&oacute;n Cliente</h3>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush table-sm">
                            <tbody>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        Nombre:
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['name_shoppinginfo'] . ' ' . $shoppinginfo['surname_shoppinginfo'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        <?= $shoppinginfo['abre_typeinden'] ?>
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['cedula_num_shoppinginfo'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        Telefono
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['num_phone'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        E-mail
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['email_shoppinginfo'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        Ciudad
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['name_city'] . ' - ' . $shoppinginfo['name_department'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        Barrio
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['neighborhood_shippinginfo'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: purple;" scope="row">
                                        Direcci&oacute;n
                                    </th>
                                    <td>
                                        <?= $shoppinginfo['address_shippinginfo'] ?>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th style="color: purple;" scope="row">
                                        Transportadora
                                    </th>
                                    <td>
                                        NULL
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Productos</h3>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Talla</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detailorderwhitproduct as $detail) : ?>
                                    <tr>
                                        <th scope="row">
                                            <img style="width: 100px;" src="<?= base_url($detail['product']->getImages()[0]['path_thumb_image']) ?>" alt="" class="img-thumbnail">
                                        </th>
                                        <td>
                                            $ <?= number_format($detail['detail']['price_sale']) ?> COP
                                        </td>
                                        <td>
                                            <?= $detail['size']['name_size'] ?>
                                        </td>
                                        <td>
                                            <a target="_blank" href="<?= base_url() . route_to('view_single_product') . '?id=' . $detail['detail']['stock_product_id'] ?>" class="btn btn-round btn-primary">Ver</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <?php if ($orderpw->state_order == 'APPROVED') : ?>
        <form target="_blank" action="<?= base_url() . route_to('generate_rotulo') ?>" method="post">
            <input type="hidden" name="ref_orderpw" value="<?= $orderpw->ref_orderpw ?>">
            <button type="submit" class="btn btn-primary">Imprimir Rotulo</button>
        </form>
    <?php endif; ?>
</div>