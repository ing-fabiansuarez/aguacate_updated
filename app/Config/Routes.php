<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//route link
$routes->get('link', 'Home::link', ['as' => 'link_contact']);

//RUTAS DEL ECOMMERCE
$routes->group('/', ['namespace' => 'App\Controllers\Ecommerce'], function ($routes) {
    $routes->get('', 'Section::home', ['as' => 'home_ecommerce']);
    $routes->get('nuevo', 'Section::new', ['as' => 'section_new_ecommerce']);
    $routes->get('categoria/(:segment)', 'Section::viewCategory/$1', ['as' => 'view_categories_section']);
    $routes->get('producto', 'Section::viewSingleProduct', ['as' => 'view_single_product']);
    $routes->add('carrito', 'Shoppingcart::index', ['as' => 'shoppingcart']);
    $routes->post('carrito/delete', 'Shoppingcart::deleteItemCart', ['as' => 'delete_item_cart']);

    //routes shopping information
    $routes->get('datoscliente', 'ShoppingInfo::index', ['as' => 'view_customer_data']);
    $routes->add('finalizar', 'ShoppingInfo::finalize', ['as' => 'view_finalize_order']);

    //routes funcionales
    $routes->add('d', 'Shoppingcart::destroy', ['as' => 'destroy_session_shopping']);
    $routes->add('s', 'Shoppingcart::show', ['as' => 'show_session_shopping']);


    //ROUTES PAYU
    $routes->post('tarjetadecredito', 'Payments::creditCard', ['as' => 'creditcard_payment']);
    $routes->post('pagos-pse', 'Payments::pse', ['as' => 'pse_payment']);
    $routes->add('bancosdisponibles', 'Payments::getBanksAvailable', ['as' => 'banks_availables_payment']);
    $routes->get('pagina-de-respuesta', 'Section::pageRequestPayment', ['as' => 'view_request_page_payment']);
    $routes->get('pagina-de-respuesta-t-c', 'Section::pageRequestPaymentCredit', ['as' => 'view_request_page_credit_card_payment']);
    $routes->add('update-orders-pendings', 'Payments::updateStateOrder', ['as' => 'update_state_order']);
});

//RUTAS PARA AJAX Y API

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('getsizestocart', 'Ajax::getHtmlSizesToAddCart', ['as' => 'ajax_get_html_sizes_to_cart']);
    $routes->post('cities', 'Ajax::getHtmlCities', ['as' => 'ajax_get_cities']);
    $routes->post('types-identification', 'Ajax::getTypeDocuments', ['as' => 'ajax_get_type_identification']);
});


//RUTAS PARA EL SISTEMA DE ADMINISTRACION
$routes->group('administracion', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    $routes->get('', 'Home::index', ['as' => 'admin_page_home']);
    $routes->get('descontar', 'Home::descontar', ['as' => 'descontar']);

    //PRODUCTOS
    $routes->group('productos', ['namespace' => 'App\Controllers\Admin\Product', 'filter' => 'auth'], function ($routes) {
        $routes->get('crear', 'Product::index', ['as' => 'view_main_products']);
        $routes->post('crear', 'Product::create', ['as' => 'create_product']);
        $routes->get('listado', 'Product::listProducts', ['as' => 'view_list_of_products']);
        $routes->get('buscar', 'Product::searchProduct', ['as' => 'view_search_products']);
    });

    //ORDERS
    $routes->group('pedidos', ['namespace' => 'App\Controllers\Admin\Orders', 'filter' => 'auth'], function ($routes) {
        $routes->get('diarios/(:segment)', 'Order::dailyOrders/$1', ['as' => 'view_daily_orders']);
        $routes->post('redirect', 'Order::redirectToDaylyOrders', ['as' => 'redirect_to_view_daily_orders']);
        $routes->get('busqueda', 'Order::searchDocument', ['as' => 'view_search_orders']);
    });

    //categorias
    $routes->group('categoria', ['namespace' => 'App\Controllers\Admin\Category', 'filter' => 'auth'], function ($routes) {
        $routes->add('crear', 'Category::create', ['as' => 'create_category']);
        $routes->add('get', 'Category::getCategories', ['as' => 'get_all_categories']);
    });

    //REPORTES
    $routes->group('reportes', ['namespace' => 'App\Controllers\Admin\ReportsGenerate', 'filter' => 'auth'], function ($routes) {
        $routes->post('rotulo', 'Rotulo::index', ['as' => 'generate_rotulo']);
    });

    $routes->group('api', ['namespace' => 'App\Controllers\Admin\ApiPrivate', 'filter' => 'auth'], function ($routes) {
        $routes->add('getdetail', 'Ajax::getHtmlDetailOrder', ['as' => 'ajax_get_detail_order']);
    });

    //Routes Ivan

    //Clientes
    $routes->group('cliente', ['namespace' => 'App\Controllers\Admin\Client', 'filter' => 'auth'], function ($routes) {
        $routes->get('crear', 'Client::viewClient', ['as' => 'view_search_client']);
        $routes->get('comprar', 'Client::searchClient', ['as' => 'buy_products_shop']);
        $routes->post('registro', 'Client::registerClient', ['as' => 'register_client']);
    });
});

//routes of auth para administracion
$routes->group('auth', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('login', 'Auth::login', ['as' => 'login_admin']);
    $routes->post('check', 'Auth::signin', ['as' => 'check_login_admin']);
    $routes->add('logout', 'Auth::logout', ['as' => 'logout_admin']);
});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
