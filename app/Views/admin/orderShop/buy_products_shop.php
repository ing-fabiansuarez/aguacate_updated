<?= $this->extend('admin/layout_structure/main_view') ?>
<?= $this->section('title') ?>Listado de productos<?= $this->endSection() ?>
<?= $this->section('listproduct') ?>active<?= $this->endSection() ?>
<?= $this->section('js') ?>


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
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Filtrar por</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() . route_to('view_list_of_products') ?>" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <label class="form-control-label" for="input-username">Seleccion por categoria</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <select name="categoria" id="select_categories" class="form-select" required="">
                                            <option value="1" selected>VESTIDOS CORTOS</option>
                                            <option value="2">VESTIDOS LARGOS</option>
                                            <option value="3">SETS</option>
                                            <option value="4">BLUSAS</option>
                                            <option value="5">ENTERIZOS</option>
                                            <option value="6">JEANS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-round btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-11">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0" style="text-align: center;">PRODUCTOS</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark" style="text-align: center;">
                            <th scope="col" class="sort" data-sort="name">PRODUCTO</th>
                            <th scope="col" class="sort" data-sort="budget">Precio</th>
                            <th scope="col" class="sort" data-sort="status">Existencias</th>
                            <th scope="col" class="sort" data-sort="status">Existencias X Talla</th>
                            <th scope="col" class="sort" data-sort="completion">Acciones</th>
                        </thead>
                        <tbody class="list">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>