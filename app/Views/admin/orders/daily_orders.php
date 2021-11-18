<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Pedidos Diarios<?= $this->endSection() ?>
<?= $this->section('listorderdaily') ?>active<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_orders').DataTable({
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

        $(document).on("click", "#row_table", function() {
            $("#modal-body div").remove();
            rowTable = $(this);
            refOrder = rowTable.find('td:eq(0)').find("#reference").text();


            $.ajax({
                url: "<?= base_url() . route_to('ajax_get_detail_order') ?>",
                type: "POST",
                data: {
                    ref_order: refOrder,
                },
                success: function(data1) {
                    $("#content").html(data1);
                },
                error: function() {
                    toastr.error("No hay internet, no se ha podido conectar al servidor.");
                }
            });


            $("#modal_detal").modal("show");
        });

    });
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Pedidos Diarios P&aacute;gina Web</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() . route_to('admin_page_home') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista de Pedidos</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Pedidos Diarios P&aacute;gina Web dia <?= $date ?></h3>
                    <br>
                    <form action="<?= base_url() . route_to('redirect_to_view_daily_orders') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="date" type="date" class="form-control" value="<?= $date ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-round btn-primary">Cargar Pedidos</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="#" class="btn btn-round btn-primary">Actualizar Pedidos</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table id="table_orders" class="table table-hover align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Pedido</th>
                                <th scope="col">Consecutivo</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fechas</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            $contardor = 0;
                            foreach ($orders as $order) :
                                $shoppingInfo = $order->getShoppingInfo();
                                $contardor += 1;
                            ?>
                                <tr id="row_table">
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <b style="color: purple;"><?= $shoppingInfo['name_shoppinginfo'] . ' ' . $shoppingInfo['surname_shoppinginfo'] ?></b><br>
                                                <?= $shoppingInfo['cedula_num_shoppinginfo'] ?> <br>
                                                Ref: <b id="reference"><?= $order->ref_orderpw ?></b>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $order->cosecutive_order ?>
                                    </td>
                                    <td>
                                        <b>$ <?= number_format($order->getPrices()['TOTAL']) ?> COP</b>
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <?php if ($order->state_order == 'APPROVED') : ?>
                                                <i class="bg-success"></i>
                                            <?php elseif ($order->state_order == 'PENDING') : ?>
                                                <i class="bg-info"></i>
                                            <?php else : ?>
                                                <i class="bg-warning"></i>
                                            <?php endif; ?>
                                            <span class="status"><?= $order->state_order ?></span>
                                        </span>
                                    </td>
                                    <td>
                                        <b>Actuali:</b> <?= $order->updated_at_orderpw ?> <br>
                                        <b>Creado:</b> <?= $order->created_at_orderpw ?>
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


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_detal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"> <b>Fabian Enrique Suarez Carvajal</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>