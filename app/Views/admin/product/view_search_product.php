<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Buscar Producto<?= $this->endSection() ?>
<?= $this->section('searchproduct') ?>active<?= $this->endSection() ?>
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
                            <li class="breadcrumb-item active" aria-current="page">Buscar Productos</li>
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
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">CODIGO DE BARRAS</span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input class="form-control" placeholder="Codigo de Barras" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?= $this->include('admin/layout_structure/footer') ?>
</div>


<?= $this->endSection() ?>