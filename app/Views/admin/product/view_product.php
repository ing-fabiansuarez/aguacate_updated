<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Productos<?= $this->endSection() ?>
<?= $this->section('newproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        loadCategories();
        $("#more").click(function() {
            $("#modalcategory").modal("show");
        });
        $("#form_categories").submit(function(e) {
            textname = $("#input_name").val();
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= base_url() . route_to('create_category') ?>",
                data: {
                    nombre: textname
                },
                success: function(request) {
                    if (request == 1) {
                        loadCategories();
                        $("#modalcategory").modal("hide");
                    } else {
                        console.log(request);
                        $("#errors").addClass('alert alert-warning');
                        $("#errors").text(request);
                    }
                },
            });
        });
    });

    function loadCategories() {
        $.ajax({
            type: "get",
            url: "<?= base_url() . route_to('get_all_categories') ?>",
            dataType: 'json',
            success: function(items) {
                console.log(items);
                $("#select_categories").children().remove();
                $('#select_categories').append($('<option>', {
                    value: '',
                    text: '* Categoria'
                }));
                $.each(items, function(i, item) {
                    $('#select_categories').append($('<option>', {
                        value: item.id_category,
                        text: item.name_category
                    }));
                });
            },
        });
    }
</script>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Productos</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() . route_to('admin_page_home') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Productos</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-neutral">New</a>
                    <a href="#" class="btn btn-sm btn-neutral">Filters</a>
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
                            <h3 class="mb-0">CREAR PRODUCTO</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . route_to('create_product') ?>" method="post" enctype="multipart/form-data">
                        <?php if (session('msg')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session('msg.body') ?>
                            </div>
                        <?php endif ?>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Categoria</label>
                                        <div class="input-group my-colorpicker2">
                                            <select name="categoria" id="select_categories" class="form-control" required>
                                            </select>
                                            <!-- <div id="more" class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-plus"></i></span>
                                            </div> -->
                                            <p style="color: red;"><?= session('error_validation.categoria') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nombre del producto</label>
                                        <input name="nombre" type="text" class="form-control" value="<?= old('nombre') ?>" required>
                                        <p style="color: red;"><?= session('error_validation.nombre') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Imagen 1</label>
                                        <input accept="image/*" name="image1" type="file" class="form-control" required>
                                        <p style="color: red;"><?= session('error_validation.image1') ?><?= session('imageinput.body') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Imagen 2</label>
                                        <input accept="image/*" name="image2" type="file" class="form-control" required>
                                        <p style="color: red;"><?= session('error_validation.image2') ?><?= session('imageinput.body') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Imagen 3</label>
                                        <input accept="image/*" name="image3" type="file" class="form-control" required>
                                        <p style="color: red;"><?= session('error_validation.image3') ?><?= session('imageinput.body') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Mostrar en la Pagina</label>
                                        <div class="input-group my-colorpicker2">
                                            <select name="mostrar" class="form-control">
                                                <option value="1">SI</option>
                                                <option value="0">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Producto Nueva colecci&oacute;n</label>
                                        <div class="input-group my-colorpicker2">
                                            <select name="nueva_coleccion" class="form-control">
                                                <option value="0">NO</option>
                                                <option value="1">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Precio (Valor a vender)</label>
                                        <input name="precio" type="number" class="form-control" value="<?= old('nombre') ?>" placeholder="$">
                                        <p style="color: red;"><?= session('error_validation.precio') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Descripci&oacute;n</label>
                                        <textarea name="descripcion" rows="3" class="form-control"><?= old('descripcion') ?></textarea>
                                        <p style="color: red;"><?= session('error_validation.descripcion') ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Existencia por Tallas</h6>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">UNICA</label>
                                        <input name="unica" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.descripcion') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">XXXS</label>
                                        <input name="xxxs" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.xxxs') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">XXS</label>
                                        <input name="xxs" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.xxs') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">XS</label>
                                        <input name="xs" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.xs') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">S</label>
                                        <input name="s" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.s') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">M</label>
                                        <input name="m" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.m') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">L</label>
                                        <input name="l" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.l') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">XL</label>
                                        <input name="xl" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.xl') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">XXL</label>
                                        <input name="xxl" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.xxl') ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label">XXXL</label>
                                        <input name="xxxl" type="number" class="form-control">
                                        <p style="color: red;"><?= session('error_validation.xxxl') ?></p>
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

    <div class="modal fade" id="modalcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Categor&iacute;a
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_categories">
                    <div class="modal-body">
                        <div id="errors">

                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="input_name" name="nombre" type="text" class="form-control" placeholder="Nombre de la categoría">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Nueva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?= $this->include('admin/layout_structure/footer') ?>
</div>


<?= $this->endSection() ?>