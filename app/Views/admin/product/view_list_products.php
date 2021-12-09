<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Listado de productos<?= $this->endSection() ?>
<?= $this->section('listproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- DATATABLE DE PRODUCTAOS -->
<script src="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
<script>
    $(document).ready(function() {
        $('#tabla1').DataTable();
    });
</script>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Listado de Productos</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() . route_to('admin_page_home') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Listado de productos</li>
                        </ol>
                    </nav>
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
                    <h3 class="mb-0">Filtrar por</h3>
                </div>
                <table name="tabla1" id="tabla1" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-body">
                    <form action="<?php base_url() . route_to('view_list_of_products') ?>" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <label class="form-control-label" for="input-username">Seleccion por categoria</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <select name="categoria" id="select_categories" class="form-select" required="">
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category['id_category'] ?>" <?php if ($category['id_category'] == $id_category) : ?> selected <?php endif; ?>><?= $category['name_category'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-round btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-11">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0" style="text-align: center;">PRODUCTOS</h3>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark" style="text-align: center;">
                            <th scope="col" class="sort" data-sort="name">Codigo</th>
                            <th scope="col" class="sort" data-sort="name">PRODUCTO</th>
                            <th scope="col" class="sort" data-sort="budget">Precio</th>
                            <th scope="col" class="sort" data-sort="status">Existencias X Talla</th>
                            <th scope="col" class="sort" data-sort="completion">Acciones</th>
                        </thead>
                        <tbody class="list">
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <th><?= $product->id_product ?></th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="#" class="avatar rounded-circle mr-3">
                                                <img src="<?= base_url($product->getImages()[0]['path_thumb_image']) ?>">
                                            </a>
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm"><?= $product->name_product ?></span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        $ <?= number_format($product->price_product) ?>
                                    </td>
                                    <td>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr style="color:white">
                                                        <th scope="col">Talla</th>
                                                        <th scope="col">Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($product->quantityStock() as $size) {
                                                    ?>
                                                        <tr style="color:white">
                                                            <td><?php echo $size['name_size'] ?></td>
                                                            <td><?php echo $size['quantity_stock'] ?></td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input active" aria-disabled="true" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if ($product->showpw_product) : ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Estado</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if ($product->new_product) : ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Nuevo</label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>