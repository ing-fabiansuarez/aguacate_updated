<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Respuesta<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">
                <ul class="w3_short">
                    <li><a href="<?= base_url() . route_to('home_ecommerce') ?>">Inicio</a><i>|</i></li>
                    <li>Pagina de Respuesta</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>


<div class="banner-bootom-w3-agileits">
    <div style="padding-top: 1.5rem;" class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2" scope="col" class="text-center">RESULTADO DE LA OPERACI&Oacute;N</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Estado:</th>
                                        <td>
                                            <?= $polTransactionState ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Fecha:</th>
                                        <td><?= $processingDate ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ref de Pedido:</th>
                                        <td><?= $referenceCode ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ref de transacci&oacute;n:</th>
                                        <td><?= $transactionId ?></td>
                                    </tr>
                                    <tr>
                                        <th>Banco:</th>
                                        <td><?= $pseBank ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><?= $buyerEmail ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" scope="col" class="text-center">En tu correo llegara la confirmacion del pago por medio de Pay U</th>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="<?= base_url() ?>" class="btn-agucate">Finalizar Transacci&oacute;n</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>