<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Compras Boutique<?= $this->endSection() ?>
<?= $this->section('listproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
<script>
    function EnvioInformacion(Nombre, Imagenes) {
        document.getElementById("Label").innerText = Nombre;
        document.getElementById("Img").setAttribute("src", Imagenes)
    }
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Compra en Boutique</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">BUSQUEDA</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . route_to('search_category') ?>" method="POST">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="input-group my-colorpicker2">
                                                <select name="id_category" class="form-control" required>
                                                    <?php
                                                    foreach ($categories as $c) {
                                                        if ($category == $c['id_category']) {
                                                    ?>
                                                            <option value="<?= $c['id_category'] ?>" selected><?= $c['name_category'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $c['id_category'] ?>"><?= $c['name_category'] ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <input name="id_ordershop" value="<?= $id_ordershop ?>" type="hidden">
                                            <input value="<?= $client[0]['doc_client'] ?>" name="documento" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-round btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form>
                        <div class="input-group">
                            <input id="Busqueda" type="search" class="form-control rounded" placeholder="Digite el Id o Nombre del Producto" aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-outline-primary">Buscar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 0;">
        <div class="row justify-content-center" style="padding: 0;">
            <div class="col-sm-6" style="padding: 0;">
                <table class="table table-responsive table-hover" id="Tabla">
                    <thead>
                        <tr>
                            <th style="padding: 0.5rem;"></th>
                            <th style="padding: 0.5rem; white-space: pre-line;">Producto</th>
                            <th style="padding: 0.5rem;">Precio</th>
                            <th style="padding: 0.5rem;">Existencias X Talla</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $product) { ?>
                            <tr>
                                <td style="padding: 0.5rem;">
                                    <button type="button" class="avatar rounded-circle mr-3" data-bs-toggle="modal" data-bs-target="#Modal" onclick="EnvioInformacion('<?= strtoupper($product->name_product); ?>','<?= base_url($product->getImages()[0]['path_image']) ?>')">
                                        <img src="<?= base_url($product->getImages()[0]['path_thumb_image']) ?>" width="40px" height="50px">
                                    </button>
                                </td>
                                <td style="padding:0rem; white-space: pre-line;" id="PrecioXU">
                                    <?= strtoupper($product->name_product); ?>
                                </td>
                                <td style="padding:0rem;">
                                    $ <?= number_format($product->price_product) ?>
                                </td>
                                <td style="padding:0rem;">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th style="padding:0rem;">Talla</th>
                                                    <th style="padding:0rem;">Exist</th>
                                                    <th style="padding:0rem;">Canti</th>
                                                    <th style="padding:0rem;">Agg</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($product->quantityStock() as $size) {
                                                ?>
                                                    <tr style="text-align: center;">
                                                        <td style="padding:0rem;"><?php echo $size['name_size'] ?></td>
                                                        <td style="padding:0rem;"><?php echo $size['quantity_stock'] ?></td>
                                                        <form action="<?= base_url() . route_to('add') ?>" method="POST">
                                                            <td style="padding:0rem;">
                                                                <input name="id_product" value="<?= $product->id_product ?>" type="hidden">
                                                                <input name="id_size" value="<?= $size['id_size'] ?>" type="hidden">
                                                                <input name="id_ordershop" value="<?= $id_ordershop ?>" type="hidden">
                                                                <input name="doc_client" value="<?= $client[0]['doc_client'] ?>" type="hidden">
                                                                <input name="quantity" type="number" style="width: 30px;" required>
                                                            </td>
                                                            <td style="padding:0rem;">
                                                                <button class="btn btn-outline-primary btn-xs" style="padding:0rem;" type="submit">Agregar</button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                <?php
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6" style="padding: 0.3;">
                <div class="card">
                    <div class="card-header" style="padding: 0.2; text-align: center;">
                        Factura
                    </div>
                    <div class="card-body" style="padding: 0.2;">
                        <div class="row">
                            Informacion personal<br>
                            <p>N° Identificacion: <?= $client[0]['doc_client'] ?></p>
                            <p>Nombre: <?= $client[0]['name_client'] . " " . $client[0]['lastname_client'] ?></p>
                            <p>Telefono: <?= $client[0]['phone_client']; ?></p>
                            <p>Telefono: <?= $client[0]['email_client']; ?></p>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead style="padding:0.3rem; text-align:center">
                                        <tr>
                                            <th style="padding:0.3rem;"></th>
                                            <th style="padding:0.3rem;">Producto</th>
                                            <th style="padding:0.3rem;">Talla</th>
                                            <th style="padding:0.3rem;">Total</th>
                                            <th style="padding:0.3rem;">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody style="padding:0rem;">
                                    <tr>
                                        <td><?= d($shopDetail) ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

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
    <?= $this->endSection() ?>