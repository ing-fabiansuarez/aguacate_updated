<?= $this->extend('ecommerce/layout_structure/main_view') ?>
<?= $this->section('title') ?>Home<?= $this->endSection() ?>
<?= $this->section('nav_home') ?>menu__item--current<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <!-- <li data-target="#myCarousel" data-slide-to="2" class=""></li>
			<li data-target="#myCarousel" data-slide-to="3" class=""></li>
			<li data-target="#myCarousel" data-slide-to="4" class=""></li> -->
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <!-- <h3>Ropa Nueva <span>Todos los fines de semana</span></h3>
                    <p>Nuevas Colecciones</p>
                    <a class="hvr-outline-out button2" href="<?= base_url() . route_to('section_new_ecommerce') ?>">Lo quiero todo </a> -->
                </div>
            </div>
        </div>
       <!--  <div class="item item2">
            <div class="container">
                <div class="carousel-caption">
                    <h3>Ropa Nueva <span>Todos los fines de semana</span></h3>
                    <p>Nuevas Colecciones</p>
                    <a class="hvr-outline-out button2" href="<?= base_url() . route_to('section_new_ecommerce') ?>">Comprar ahora </a>
                </div>
            </div>
        </div> -->
        <!-- <div class="item item3">
				<div class="container">
					<div class="carousel-caption">
						<h3>The Biggest <span>Sale</span></h3>
						<p>Special for today</p>
						<a class="hvr-outline-out button2" href="mens.html">Shop Now </a>
					</div>
				</div>
			</div>
			<div class="item item4">
				<div class="container">
					<div class="carousel-caption">
						<h3>Summer <span>Collection</span></h3>
						<p>New Arrivals On Sale</p>
						<a class="hvr-outline-out button2" href="mens.html">Shop Now </a>
					</div>
				</div>
			</div>
			<div class="item item5">
				<div class="container">
					<div class="carousel-caption">
						<h3>The Biggest <span>Sale</span></h3>
						<p>Special for today</p>
						<a class="hvr-outline-out button2" href="mens.html">Shop Now </a>
					</div>
				</div>
			</div> -->
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!-- The Modal -->
</div>

<div class="banner-bootom-w3-agileits">
    <div class="container">
        <h3 style="padding-top: 2rem;" class="wthree_text_info"><span>Cada prenda es &uacute;nica</span> como t&uacute;</h3>

        <div class="col-md-5 bb-grids bb-middle-agileits-w3layouts">
            <a href="<?= base_url() . route_to('view_categories_section', 'vcortos') ?>">
                <div class="bb-middle-agileits-w3layouts grid">
                    <figure class="effect-roxy">
                        <img src="assets/img/ecommerce/home/category1-1.jpeg" alt=" " class="img-responsive" />
                        <figcaption>
                            <h3><span>V</span>estidos Cortos </h3>
                            <br><br>
                            <div class="btn-categories">
                                <a class="hvr-outline-out button2" href="<?= base_url() . route_to('view_categories_section', 'vcortos') ?>">Los amo </a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </a>
            <a href="<?= base_url() . route_to('view_categories_section', 'vlargos') ?>">
                <div class="bb-middle-agileits-w3layouts forth grid">
                    <figure class="effect-roxy">
                        <img src="assets/img/ecommerce/home/category4.jpg" alt=" " class="img-responsive">
                        <figcaption>
                            <h3><span>V</span>estidos Largos </h3>
                            <br><br>
                            <div class="btn-categories">
                                <a class="hvr-outline-out button2" href="<?= base_url() . route_to('view_categories_section', 'vlargos') ?>">Los adoro </a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-7 bb-grids bb-middle-agileits-w3layouts">
            <a href="mens.html">
                <div class="bb-middle-agileits-w3layouts grid">
                    <figure class="effect-roxy">
                        <img src="assets/img/ecommerce/home/category2.jpg" alt=" " class="img-responsive" />
                        <figcaption>
                            <h3><span>S</span>ets </h3>
                            <br><br>
                            <div class="btn-categories">
                                <a class="hvr-outline-out button2" href="<?= base_url() . route_to('view_categories_section', 'sets') ?>">Los quiero </a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </a>
            <a href="mens.html">
                <div class="bb-middle-agileits-w3layouts forth grid">
                    <figure class="effect-roxy">
                        <img src="assets/img/ecommerce/home/category3.jpg" alt=" " class="img-responsive">
                        <figcaption>
                            <h3><span>E</span>nterizos </h3>
                            <br><br>
                            <div class="btn-categories">
                                <a class="hvr-outline-out button2" href="<?= base_url() . route_to('view_categories_section', 'enterizos') ?>">Las necesito </a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </a>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>