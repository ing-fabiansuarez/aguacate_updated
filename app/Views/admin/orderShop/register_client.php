<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Registro<?= $this->endSection() ?>
<?= $this->section('newproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Cliente</h6>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">REGISTRO NUEVO CLIENTE</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . route_to('') ?>" method="post">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Numero de documento</label>
                                        <input name="nombre" type="text" class="form-control" value="<?= $document ?>" required>
                                        <p style="color: red;"><?= session('error_validation.nombre') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nombre del cliente</label>
                                        <input name="nombre" type="text" class="form-control" value="<?= "d" ?>" required>
                                        <p style="color: red;"><?= session('error_validation.nombre') ?></p>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-round btn-primary">Guardar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('admin/layout_structure/footer') ?>
</div>


<?= $this->endSection() ?>