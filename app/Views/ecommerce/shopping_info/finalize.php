<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Revisar<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link href="<?= base_url() ?>/assets/plugins/cardjs-master/card-js.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url() ?>/assets/plugins/cardjs-master/card-js.min.js"></script>

<script>
    $(document).ready(function() {
        $("#btn_credit_card").click(function() {
            $("#modal_credit_card").modal('show');
        });

        function changeActionFormCreditCard(val) {
            $("#example-form").attr("action", val);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("#btn_modal_pse").click(function() {
            // Guardamos el select de cursos
            var selectBanks = $("#select_banks_availables");
            var selectTypeDoc = $("#select_types_identi");
            //TRAER BANCOS
            $.ajax({
                type: 'POST',
                url: "<?= base_url() . route_to('banks_availables_payment') ?>",
                dataType: "json",
                data: {},
                success: function(data) {
                    // Limpiamos el select
                    selectBanks.find('option').remove();
                    $(data).each(function(i, v) { // indice, valor
                        if (v.pseCode == '0') {
                            selectBanks.append('<option value="">' + v.description + '</option>');
                        } else {
                            selectBanks.append('<option value="' + v.pseCode + '">' + v.description + '</option>');
                        }
                    })
                }
            });
            //TRAER TIP DOCU
            $.ajax({
                type: 'POST',
                url: "<?= base_url() . route_to('ajax_get_type_identification') ?>",
                dataType: "json",
                data: {},
                success: function(data) {
                    // Limpiamos el select
                    selectTypeDoc.find('option').remove();
                    selectTypeDoc.append('<option value="">- Tipo de documento -</option>');
                    $(data).each(function(i, v) { // indice, valor
                        selectTypeDoc.append('<option value="' + v.abre_typeinden + '">' + v.name_typeiden + '</option>');
                    })
                },
                error: function() {
                    alert('No se pudo conectar con el servidor');
                }
            });
            $("#modal_pse").modal('show');
        });
    });
</script>


<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">
                <ul class="w3_short">
                    <li><a href="<?= base_url() . route_to('home_ecommerce') ?>">Inicio</a><i>|</i></li>
                    <li>Revisa tu pedido</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>

<div class="banner-bootom-w3-agileits">
    <div class="container">
        <div class="single-pro">
            75 %
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <div class="list-group-item btn-aguacate">
                                Tus Datos de envio
                            </div>
                            <div class="list-group-item table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td><b>Ciudad</b></td>
                                            <td><?= $cityAndDepartment ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Direcci&oacute;n</b></td>
                                            <td><?= $addressHome ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Nombre</b></td>
                                            <td><?= $nameComplete ?></td>
                                        </tr>
                                        <tr>
                                            <td><b><?= $abrev ?></b></td>
                                            <td><?= $numIndentification ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone</b></td>
                                            <td><?= $numPhone ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td><?= $email ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="list-group">
                            <div class="list-group-item btn-aguacate">
                                Tu Pedido
                            </div>
                            <div class="list-group-item table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>

                                            <th scope="col">Product</th>
                                            <th scope="col"></th>
                                            <th scope="col">Precio Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalShoppingCart = 0;
                                        foreach ($items as $item) :
                                            $total = $item['quantity'] * $item['product']->price_product;
                                            $totalShoppingCart += $total;
                                        ?>
                                            <tr>
                                                <td>
                                                    <img style="width: 100px;" src="<?= $item['product']->getImages()[0]['path_thumb_image'] ?>" alt="" class="img-thumbnail">
                                                </td>
                                                <td>
                                                    <b>Talla: </b><?= $item['name_size'] ?><br>
                                                    <b>Cantidad: </b><?= $item['quantity'] ?><br>
                                                    <b>Prec Uni:</b> $ <?= number_format($item['product']->price_product) ?>
                                                </td>
                                                <td><b>$ <?= number_format($total) ?></b></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Flete</th>
                                            <th>$ <?= number_format($freight) ?></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>TOTAL</th>
                                            <th>$ <?= number_format($totalShoppingCart + $freight) ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="list-group">
                            <div class="list-group-item btn-aguacate">
                                Pagar por
                            </div>
                            <div class="list-group-item table-responsive">
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action active">
                                        Tarjeta Debito
                                    </div>
                                    <button id="btn_modal_pse" style="width: 100%; text-align: left;" class="list-group-item list-group-item-action">
                                        <img style="width: 70px;" src="<?= base_url('assets/img/payments/logo_pse.webp') ?>"> - PSE
                                    </button>
                                </div>
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action active">
                                        Tarjeta Credito
                                    </div>
                                    <button style="width: 100%; text-align: left;" id="btn_credit_card" class="list-group-item list-group-item-action">
                                        <img style="width: 60px;" src="<?= base_url('assets/img/payments/logo_credit_card.png') ?>"> - Pagar Por Tarjeta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_pse" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pago por pse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?= base_url() . route_to('pse_payment') ?>" method="post">
                                <div class="form-group">
                                    <select name="type_person" class="form-control" required>
                                        <option value="">- Tipo de persona -</option>
                                        <option value="N">PERSONA NATURAL</option>
                                        <option value="J">PERSONA JURIDICA</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <select name="type_document" id="select_types_identi" class="form-control" required>
                                                <option value="">- Tipo documento -</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input name="number_document" type="number" class="form-control" placeholder="Número..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="bank" id="select_banks_availables" class="form-control" required>
                                        <option value="">* Bancos</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-aguacate">PAGAR</button>
                                <p>Luego de oprimir en pagar espera un momento mientro se ejecuta la transacción y te redireccionemos a la pagina de respuesta.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div id="modal_credit_card" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informaci&oacute;n de la tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?= base_url() . route_to('creditcard_payment') ?>" method="post">
                                <div class="form-group">
                                    <select name="method_payment" class="form-control" required>
                                        <option value="">* Tipo de tarjeta</option>
                                        <?php foreach ($credit_cards as $card) : ?>
                                            <option value="<?= $card['paymentmethod_payu_cardcredit'] ?>"><?= $card['name_cardcredit'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="card-js">
                                    <input class="card-number my-custom-class" name="card-number" required>
                                    <input class="expiry-month" name="expiry-month" required>
                                    <input class="expiry-year" name="expiry-year" required>
                                    <input class="cvc" name="cvc" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <select name="num-cuotas" class="form-control" required>
                                        <option value="">* N&uacute;mero de Cuotas</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                    </select>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-aguacate">PAGAR</button>
                                <p>Luego de oprimir en pagar espera un momento mientro se ejecuta la transacción y te redireccionemos a la pagina de respuesta.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>