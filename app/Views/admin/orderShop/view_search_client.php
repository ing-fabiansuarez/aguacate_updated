<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Buscar cliente<?= $this->endSection() ?>
<?= $this->section('searchproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Busqueda usuario</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">BUSQUEDA POR DOCUMENTO DE IDENTIDAD</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . route_to('verify_client') ?>" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-5" id="BotonBusqueda">
                                <input name="documento" type="text" class="form-control" placeholder="Digite el numero de documento" value="<?= old('documento') ?>" required>
                                <button type="submit" class="btn btn-round btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>