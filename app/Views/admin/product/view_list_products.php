<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Listado de productos<?= $this->endSection() ?>
<?= $this->section('listproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>


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
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0">Productos</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">PRODUCTO</th>
                                <th scope="col" class="sort" data-sort="budget">Nombre</th>
                                <th scope="col" class="sort" data-sort="status">Existencias</th>

                                <th scope="col" class="sort" data-sort="completion">Completion</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="#" class="avatar rounded-circle mr-3">
                                                <img src="<?=base_url($product->getImages()[0]['path_thumb_image'])?>">
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
                                        <span class="badge badge-dot mr-4">
                                            20 UNIDADES
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="completion mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
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




    <?= $this->include('admin/layout_structure/footer') ?>
</div>


<?= $this->endSection() ?>