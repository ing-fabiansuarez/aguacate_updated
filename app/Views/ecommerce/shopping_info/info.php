<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Informaci&oacute;n del cliente<?= $this->endSection() ?>


<?= $this->section('js') ?>
<!----SCRIPT PARA CARGAR LAS CIUDADES ------>
<script>
    $(document).ready(function() {
        reloadcities();
        $("#select_department").change(function() {
            reloadcities();
        });
    });

    function reloadcities() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_get_cities') ?>",
            data: "department=" + $("#select_department").val(),
            success: function(r) {
                $("#cities_select").html(r);
            },
        });
    }
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">
                <ul class="w3_short">
                    <li><a href="<?= base_url() . route_to('home_ecommerce') ?>">Inicio</a><i>|</i></li>
                    <li>Informaci&oacute;n del envio</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>

<div class="banner-bootom-w3-agileits">
    <div class="container">
        <div class="single-pro">
            50 %
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?= base_url() . route_to('view_finalize_order') ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="color: #D290F4; font-weight: bold;">Datos de env&iacute;o</h2>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Departamento
                                        </label>
                                        <select id="select_department" class="form-control bg-input-purpel" required>
                                            <option value="">* Departamento</option>
                                            <?php foreach ($departments as $department) : ?>
                                                <option value="<?= $department['iddepartment'] ?>"><?= $department['name_department'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Ciudad
                                        </label>
                                        <select name="ciudad" id="cities_select" class="form-control bg-input-purpel" required>

                                        </select>
                                        <p style="color: red;">
                                            <?= session('error_validation.ciudad') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Direcci&oacute;n
                                        </label>
                                        <input name="direccion" t type="text" class="form-control bg-input-purpel" value="<?= old('direccion') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.direccion') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Barrio
                                        </label>
                                        <input name="barrio" type="text" class="form-control bg-input-purpel" value="<?= old('barrio') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.barrio') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h2 style="color: #D290F4; font-weight: bold;">Informaci&oacute;n personal</h2>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Nombres
                                        </label>
                                        <input name="nombres" type="text" class="form-control bg-input-purpel" value="<?= old('nombres') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.nombres') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Apellidos
                                        </label>
                                        <input name="apellidos" type="text" class="form-control bg-input-purpel" value="<?= old('apellidos') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.apellidos') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Tipo de Identificaci&oacute;n
                                        </label>
                                        <select name="tipo_identificacion" class="form-control bg-input-purpel" required>
                                            <?php foreach ($typeiden as $type) : ?>
                                                <option value="<?= $type['id_typeiden'] ?>"><?= $type['name_typeiden'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p style="color: red;">
                                            <?= session('error_validation.tipo_identificacion') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            N&uacute;mero de Identificaci&oacute;n
                                        </label>
                                        <input name="num_identificacion" type="text" class="form-control bg-input-purpel" value="<?= old('num_identificacion') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.num_identificacion') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            N&uacute;mero de Celular
                                        </label>
                                        <input name="celular" type="text" class="form-control bg-input-purpel" value="<?= old('celular') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.celular') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Email
                                        </label>
                                        <input name="email" type="text" class="form-control bg-input-purpel" value="<?= old('email') ?>" required />
                                        <p style="color: red;">
                                            <?= session('error_validation.email') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <input type="hidden" name="r" value="create">
                                    <button type="submit" class="btn-aguacate">
                                        Siguiente
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?= $this->endSection() ?>