<!DOCTYPE html>
<html lang="es">

<head>
    <title><?= $this->renderSection('title') ?> - AguacateByKathe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Creo en mi, Me lo merezco" />
    <!-- subir al inicio cuando se recarga la pantalla <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script> -->
    <!--//tags -->
    <link href="<?= base_url() ?>/assets/css/ecommerce/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= base_url() ?>/assets/css/ecommerce/style3.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= base_url() ?>/assets/css/ecommerce/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/ecommerce/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/toastr/toastr.min.css">

    <?= $this->renderSection('css') ?>
    <!-- //for bootstrap working -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <?= $this->include('ecommerce/layout_structure/navbar') ?>
    <?= $this->renderSection('content') ?>

    <!-- footer -->
    <?= $this->include('ecommerce/layout_structure/footer') ?>
    <!-- //footer -->


    <!-- shopping Cart -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carrito de Compras</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn-aguacate">Ir a pagar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- //shopping Cart -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar al carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">
                    <form action="<?=base_url().route_to('shoppingcart')?>" method="post">
                        <div id="content_modal">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>


    <!-- js -->
    <script type="text/javascript" src="<?= base_url() ?>/assets/js/ecommerce/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <script src="<?= base_url() ?>/assets/js/ecommerce/modernizr.custom.js"></script>
    <!-- Custom-JavaScript-File-Links -->
    <!-- cart-js -->
    <!-- <script src="<?= base_url() ?>/assets/js/ecommerce/minicart.min.js"></script>
    <script>
        // Mini Cart
        paypal.minicart.render({
            action: '#'
        });

        if (~window.location.search.indexOf('reset=true')) {
            paypal.minicart.reset();
        }
    </script> -->

    <!-- //cart-js -->
    <!-- script for responsive tabs -->
    <script src="<?= base_url() ?>/assets/js/ecommerce/easy-responsive-tabs.js"></script>
    <script>
        $(document).ready(function() {
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion           
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
            $('#verticalTab').easyResponsiveTabs({
                type: 'vertical',
                width: 'auto',
                fit: true
            });
        });
    </script>
    <!-- //script for responsive tabs -->
    <!-- stats -->
    <script src="<?= base_url() ?>/assets/js/ecommerce/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/ecommerce/jquery.countup.js"></script>
    <script>
        $('.counter').countUp();
    </script>
    <!-- //stats -->
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?= base_url() ?>/assets/js/ecommerce/move-top.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/js/ecommerce/jquery.easing.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- here stars scrolling icon -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            	var defaults = {
            	containerID: 'toTop', // fading element id
            	containerHoverID: 'toTopHover', // fading element hover id
            	scrollSpeed: 1200,
            	easingType: 'linear' 
            	};
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!-- //here ends scrolling icon -->


    <!-- for bootstrap working -->
    <script type="text/javascript" src="<?= base_url() ?>/assets/js/ecommerce/bootstrap.js"></script>

    <!-- SHOPPING CART -->
    <script>
        $(document).ready(function() {

            $(document).on("click", "#input_add", function() {
                $("#content_modal div").remove();
                //en esta variable capturaria el padre del boton que es el  div con la clase footer
                var fieldset = $(this).closest('fieldset');
                idProduct = fieldset.find('#id_product').val();

                $.ajax({
                    url: "<?= base_url() . route_to('ajax_get_html_sizes_to_cart') ?>",
                    type: "POST",
                    data: {
                        id_product: idProduct,
                    },
                    success: function(data1) {
                        $("#content_modal").html(data1);
                    },
                    error: function() {
                        toastr.error("No hay internet, no se ha podido conectar al servidor.");
                    }
                });

                $("#addModal").modal("show");

            });

            $("#add_product_to_cart").submit(function(event) {
                event.preventDefault();
                idProduct = $("#input_id_product").val();
                idSize = $("#input_id_size").val();
                console.log(idProduct);
                console.log(idSize);
            });

        });
    </script>
    <!-- //SHOPING CART -->

    <!-- Toastr -->
    <script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
    <?= $this->renderSection('js') ?>

</body>

</html>