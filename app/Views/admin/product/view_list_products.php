<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Listado de productos<?= $this->endSection() ?>
<?= $this->section('listproduct') ?>active<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/toastr/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Toastr -->
<script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table_products').DataTable({
            pageLength: 10,
            ordering: false,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

    });

    $(document).on('change', '#checkbox_new_product', function() {
        rowTable = $(this).parents('tr');
        idProduct = rowTable.find('td:eq(0)').text();
        console.log(idProduct);
        if ($(this).is(':checked')) {
            action = 1;
        } else {
            action = 0;
        }
        //aqui vamos en para que se actualice 
        $.ajax({
            url: "<?= base_url('administracion/api/changenewproduct') ?>/" + idProduct + "/" + action,
            type: "POST",
            success: function(data1) {
                toastr.success(data1);
            },
            error: function() {
                toastr.error("No hay internet, no se ha podido conectar al servidor u ocurrio un error.");
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        });
    });


    $(document).on('change', '#checkbox_show_pw', function() {
        rowTable = $(this).parents('tr');
        idProduct = rowTable.find('td:eq(0)').text();
        console.log(idProduct);
        if ($(this).is(':checked')) {
            action = 1;
        } else {
            action = 0;
        }
        //aqui vamos en para que se actualice 
        $.ajax({
            url: "<?= base_url('administracion/api/changeshowproduct') ?>/" + idProduct + "/" + action,
            type: "POST",
            success: function(data1) {
                toastr.success(data1);
            },
            error: function() {
                toastr.error("No hay internet, no se ha podido conectar al servidor u ocurrio un error.");
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        });
    });


    $(document).on("click", "#image_product", function() {
        $("#modal_images").modal("show");
        $("#modal-body div").remove();
        rowTable = $(this).parents('tr');
        idProduct = rowTable.find('td:eq(0)').text();

        $.ajax({
            url: "<?= base_url() . route_to('ajax_get_images_product') ?>",
            type: "POST",
            data: {
                id_product: idProduct,
            },
            success: function(data1) {
                $("#content_modal").html(data1);
                $("#title_modal_imagen").text(idProduct);
            },
            error: function() {
                toastr.error("No hay internet, no se ha podido conectar al servidor u ocurrio un error.");
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        });

    });
</script>

<!-- SCRIPT PARA EL INPUT DE PRECIO EN LA TABLA -->
<script>
    let timeout

    $(document).on("keydown", "#comment", function() {
        clearTimeout(timeout)
        timeout = setTimeout(() => {
            rowTable = $(this).parents('tr');
            idProduct = rowTable.find('td:eq(0)').text();
            action = rowTable.find('td:eq(1)').find(':input').val();
            $.ajax({
                url: "<?= base_url('administracion/api/changepriceproduct') ?>/" + idProduct + "/" + action,
                type: "POST",
                success: function(data1) {
                    toastr.success(data1);
                },
                error: function() {
                    toastr.error("No hay internet, no se ha podido conectar al servidor u ocurrio un error.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });
            clearTimeout(timeout)
        }, 1000);
    });
</script>

<!-- SCRIPT PARA EL INPUT DE STOCK -->
<script>
    let timeola
    $(document).on("keydown", "#input_stock", function() {
        clearTimeout(timeola)
        timeola = setTimeout(() => {

            rowTable = $(this).parents('tr');
            idProduct = rowTable.find('td:eq(0)').text();
            talla = $(this).parents('li').find('#id_size').text();
            cantidad = $(this).parents('li').find('#input_stock').val();

            $.ajax({
                url: "<?= base_url() . route_to('ajax_change_stock_product') ?>",
                type: "POST",
                data: {
                    ref_producto: idProduct,
                    talla: talla,
                    cantidad: cantidad,
                },
                dataType: "json",
                success: function(data1) {
                    if (data1['status'] == "error") {
                        toastr.error(data1['msg']);
                    } else if (data1['status'] == "ok") {
                        toastr.success(data1['msg']);
                    }
                },
                error: function() {
                    toastr.error("No hay internet, no se ha podido conectar al servidor u ocurrio un error.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });
            clearTimeout(timeola)
        }, 1000);
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Filtrar por</h3>
                </div>
                <div class="card-body">
                    <form action="<?php base_url() . route_to('view_list_of_products') ?>" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <label class="form-control-label" for="input-username">Seleccion por categoria</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="categoria" id="select_categories" class="form-select" required="">
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category['id_category'] ?>" <?php if ($category['id_category'] == $id_category) : ?> selected <?php endif; ?>><?= $category['name_category'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-round btn-primary">Buscar</button>
                                    </div>
                                    <div class="col-md-5">
                                        <?php if (session('msg.class')) : ?>
                                            <div class="alert <?= session('msg.class') ?>">
                                                <strong><?= session('msg.title') ?></strong> <?= session('msg.body') ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="table_products" class="table table-hover align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">PRODUCTO</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Existencias X Talla</th>
                                            <th scope="col">Ver Pag Web</th>
                                            <th scope="col">Nuevo</th>
                                            <th scope="col">Desactivar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php foreach ($products as $product) : ?>
                                            <tr>
                                                <td id="codigo"><?= $product->id_product ?></td>
                                                <th>
                                                    <div class="media align-items-center">
                                                        <a id="image_product" class="avatar rounded-circle mr-3">
                                                            <img src="<?= base_url($product->getImages()[0]['path_thumb_image']) ?>">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm"><?= $product->name_product ?></span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>
                                                    $ <input type="number" id="comment" value="<?= $product->price_product ?>">
                                                </td>
                                                <td>
                                                    <ul class="list-group">
                                                        <?php foreach ($product->quantityStock() as $size) { ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <b id="name_size"><?= $size['name_size'] ?></b>
                                                                <b hidden id="id_size"><?= $size['id_size'] ?></b>
                                                                <span class="badge badge-primary badge-pill"><input id="input_stock" style="max-width: 40px; border: none; background: transparent;" type="text" value="<?= $size['quantity_stock'] ?>"></span>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input id="checkbox_show_pw" class="form-check-input active" aria-disabled="true" type="checkbox" role="switch" <?php if ($product->showpw_product) : ?> checked <?php endif; ?>>
                                                        <label class="form-check-label">Ver</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input id="checkbox_new_product" class="form-check-input active" aria-disabled="true" type="checkbox" role="switch" <?php if ($product->new_product) : ?> checked <?php endif; ?>>
                                                        <label class="form-check-label">Nuevo</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="<?= base_url() . route_to('disable_product') ?>" method="post">
                                                        <input type="hidden" name="id_product" value="<?= $product->id_product ?>">
                                                        <button id="btn_delete_employee" type="submit" class="btn btn-app bg-delete">
                                                            <i style="color: red;" class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal_imagen">Imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="content_modal">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>