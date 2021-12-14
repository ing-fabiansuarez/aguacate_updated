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
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">REGISTRO NUEVO CLIENTE</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . route_to('client_register') ?>" method="post">
                        <div class="pl-lg-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Numero de documento</label>
                                        <input name="documento" type="text" class="form-control" value="<?= $document ?>" required>
                                        <p style="color: red;"><?= session('errors.documento') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Tipo de documento</label>
                                        <div class="input-group my-colorpicker2">
                                            <select name="tipo_doc" class="form-control" required>
                                                <?php $i = 0;
                                                foreach ($type_document as $type) {
                                                ?>
                                                    <option value="<?= $type['id_typeiden'] ?>" ><?= $type['name_typeiden'] ?></option>
                                                <?php $i += 1;
                                                } ?>
                                            </select>
                                            <p style="color: red;"><?= session('errors.tipo_doc') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Nombre</label>
                                        <input name="nombre" type="text" class="form-control" value="<?= old('nombre') ?>" required>
                                        <p style="color: red;"><?= session('errors.nombre') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Apellido</label>
                                        <input name="apellido" type="text" class="form-control" value="<?= old('apellido') ?>" required>
                                        <p style="color: red;"><?= session('errors.apellido') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Telefono</label>
                                        <input name="telefono" type="text" class="form-control" value="<?= old('telefono') ?>" required>
                                        <p style="color: red;"><?= session('errors.telefono') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input name="email" type="text" class="form-control" value="<?= old('email') ?>" placeholder="Campo no requerido">
                                        <p style="color: red;"><?= session('errors.email') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-round btn-primary">Guardar informacion</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('admin/layout_structure/footer') ?>
</div>
<?= $this->endSection() ?>