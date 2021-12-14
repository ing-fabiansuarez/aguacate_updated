<?php

namespace App\Controllers\Admin\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderShopModel;
use App\Models\StockModel;
use App\Models\TypeIdentificationModel;
use App\Models\OrderShopDetailModel;
use App\Models\ShoppingInfo;
use App\Models\UserModel;

class Client extends BaseController
{
    public function __construct()
    {
        $this->mdlClient = new ClientModel();
        $this->mdlProduct = new ProductModel();
        $this->mdlCategory = new CategoryModel();
        $this->mdlStock = new StockModel();
        $this->mdlTypeI = new TypeIdentificationModel();
        $this->mdlOrderShop = new OrderShopModel();
        $this->mdlShopDetail = new OrderShopDetailModel();
        $this->mdlUser = new UserModel();
        $this->mdlShoppingInfo = new ShoppingInfo();
    }
    public function viewClient()
    {
        //Funcion que retorna vista de ingreso de N° de documento
        return view(
            'admin/orderShop/view_search_client',
        );
    }
    public function registerClient($document)
    {
        //Funcion que redirije al formulario de creacion de clientes
        //Se le enviando dos tipos de datos un documento para no tener que solicitarlo de nuevo
        //y los tipos de documentos para listarlos en el select
        return view(
            'admin/orderShop/register_client',
            [
                "document" => $document,
                "type_document" => $this->mdlTypeI->findAll()
            ]
        );
    }
    //Ivan

    /* public function listProducts()
    {
        //
        $id_category = $this->request->getGet('categoria');
        return view('admin/orderShop/buy_products_shop', [
            'products' => $this->mdlProduct->where('category_id', $id_category)->where('active_product', true)->findAll(),
            'categories' =>  $this->mdlCategory->findAll(),
            'id_category' => $id_category
        ]);
    } */
    //Ivan

    public function createClient()
    {
        /*Funcion que valida si el formulario de registro cliente esta llenado de forma correcta  y si 
        el cliente esta registrado con el mismo numero de cedula pero con diferente nombre
        */
        $document = $this->request->getPost('documento');
        $query = $this->mdlClient->where('doc_client', $document)->findAll();
        if (!($this->validate($this->rulesvalidation->getRuleGroup('newClient'))) or count($query) > 0) {
            //Regresa a la vista del formulario, si las validaciones no estan concluidas
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            //datos capturados del formulario
            $documentC = $document;
            $tipo_documento = $this->request->getPost('tipo_doc');
            $name = $this->request->getPost('nombre');
            $lastname = $this->request->getPost('apellido');
            $phone = $this->request->getPost('telefono');
            $email = $this->request->getPost('email');
            //se crea el cliente en la base de datos
            $this->mdlClient->insert([
                'id_client' => '',
                'doc_client' => $documentC,
                'typeidentification_idtypeiden' => $tipo_documento,
                'name_client' => $name,
                'lastname_client' => $lastname,
                'phone_client' => $phone,
                'email_client' => $email,
            ]);

            //Se realiza de nuevo la consulta del cliente que acabo de ser creado
            $query = $this->mdlClient->where('doc_client', $document)->findAll();
            //se hace una consulta para verificar el consecutivo y incrementarlo conforme se hace un pedido
            $queryC = $this->mdlOrderShop->select('consecutive_ordershop')
                ->orderBy('consecutive_ordershop', 'DESC')->get()->getRow();
            if (empty($queryC)) {
                $consecutive = 1;
            } else {
                //Se aumenta el consecutivo
                $consecutive = $queryC->consecutive_ordershop + 1;
            }
            //Se crea un id unico para el id de shoppinginfo
            $referencia = uniqid();
            //se agrega el shopping info con la informacion de aguacate
            $this->mdlShoppingInfo->insert([
                'id_shoppinginfo' => $referencia,
                'city_idcity' => 442,
                'address_shippinginfo' => 'Cll 4 N 3-74',
                'neighborhood_shippinginfo' => 'Centro Via Nacional',
                'name_shoppinginfo' => $query[0]['name_client'],
                'surname_shoppinginfo' => $query[0]['lastname_client'],
                'typeidentification_id' => $query[0]['typeidentification_idtypeiden'],
                'num_phone' => $query[0]['phone_client'],
                'email_shoppinginfo' => $query[0]['email_client'],
                'cedula_num_shoppinginfo' => $query[0]['doc_client']
            ]);
            //se trae todo
            $id_ordershop = uniqid();
            //Se crea la orden antes de iniciar la venta
            $this->mdlOrderShop->insert([
                'id_ordershop' => $id_ordershop,
                'consecutive_ordershop' => $consecutive,
                'client_id' => $query[0]['id_client'],
                'user_id' => $_SESSION['cedula_user'],
                'shoppinginfo_id' => $referencia,
            ]);

            return $this->VistaCompra($query, $id_ordershop);
        }
    }
    public function condicionalClient()
    {
        //Funcion que buscar el cliente, dependiendo si existe o no retorna una vista de compra o un formulario de creacion de usuario
        $document = $this->request->getGet('documento');
        //Se busca el cliente por N de documento
        $query = $this->mdlClient->where('doc_client', $document)->findAll();
        if (empty($query)) {
            //No existe ningun cliente con ese N de cedula se retorna la vista de registro
            return $this->registerClient($document);
        } else {
            //--------Ojo-------------
            //Esta seccion practimente se repite en la seccion de createClient se puede hacer una funcion 
            //para reducir el codigo

            //se hace una consulta para verificar el consecutivo y incrementarlo conforme se hace un pedido
            $queryC = $this->mdlOrderShop->select('consecutive_ordershop')
                ->orderBy('consecutive_ordershop', 'DESC')->get()->getRow();
            if (empty($queryC)) {
                $consecutive = 1;
            } else {
                //Se aumenta el consecutivo
                $consecutive = $queryC->consecutive_ordershop + 1;
            }
            $referencia = uniqid();
            $this->mdlShoppingInfo->insert([
                'id_shoppinginfo' => $referencia,
                'city_idcity' => 442,
                'address_shippinginfo' => 'Cll 4 N 3-74',
                'neighborhood_shippinginfo' => 'Centro Via Nacional',
                'name_shoppinginfo' => $query[0]['name_client'],
                'surname_shoppinginfo' => $query[0]['lastname_client'],
                'typeidentification_id' => $query[0]['typeidentification_idtypeiden'],
                'num_phone' => $query[0]['phone_client'],
                'email_shoppinginfo' => $query[0]['email_client'],
                'cedula_num_shoppinginfo' => $query[0]['doc_client']
            ]);
            $queryShoppingInfo = $this->mdlShoppingInfo->select('id_shoppinginfo')
                ->where('id_shoppinginfo', $referencia)->findAll();
            $id_ordershop = uniqid();
            $this->mdlOrderShop->insert([
                'id_ordershop' => $id_ordershop,
                'consecutive_ordershop' => $consecutive,
                'client_id' => $query[0]['id_client'],
                'user_id' => $_SESSION['cedula_user'],
                'shoppinginfo_id' => $queryShoppingInfo[0]['id_shoppinginfo'],
            ]);
            return $this->VistaCompra($query, $id_ordershop);
        }
    }
    //Ivan
    public function VistaCompra($query, $ordershop_id)
    {
        //Se busca el detalle de la orden segun el id de la orden
        $queryOrderShopDetail = $this->mdlShopDetail
            ->where('ordershop_id', $ordershop_id)->findAll();
        //Se retorna la vista de ventas con todo lo necesario
        return view('admin/orderShop/buy_products_shop', [
            'client' => $query,
            'categories' => $this->mdlCategory->findAll(),
            'products' => $this->mdlProduct->table('product')
                ->join('stock', 'product.id_product=stock.product_id')
                ->join('size', 'stock.size_id=size.id_size')
                ->where('active_product', true)
                ->where('stock.quantity_stock>', 0)
                ->where('category_id', 1)
                ->findAll(),
            'category' => 1,
            'id_ordershop' => $ordershop_id,
            'shopDetail' => $queryOrderShopDetail
        ]);
    }
    //Ivan

    public function searchProductsCategory()
    {
        //Funcion de busqueda por categorias
        //Ojo se puede simplificar usando una funcion 
        //Se utiliza los mismos campos y tablas que en VistaCompra()
        $id_ordershop = $this->request->getPost('id_ordershop');
        $id_category = $this->request->getPost('id_category');
        $document = $this->request->getPost('documento');
        $query = $this->mdlClient->where('doc_client', $document)->findAll();
        $queryOrderShopDetail = $this->mdlShopDetail->where('ordershop_id', $id_ordershop)->findAll();
        return view('admin/orderShop/buy_products_shop', [
            'client' => $query,
            'categories' => $this->mdlCategory->findAll(),
            'products' => $this->mdlProduct->table('product')
                ->join('stock', 'product.id_product=stock.product_id')
                ->where('active_product', true)
                ->where('stock.quantity_stock>', 0)
                ->where('category_id', $id_category)
                ->findAll(),
            'category' => $id_category,
            'id_ordershop' => $id_ordershop,
            'shopDetail' => $queryOrderShopDetail
        ]);
    }
    //ivan 
    public function addProduct()
    {
        //Funcion simplificada que retorna los datos de los productos agregados
        //aqui se hace la insercion del detailProduct
        $i = 0;
        $quantity = $_POST['quantity'];
        $id_product = $_POST['id_product'];
        $id_size = $_POST['id_size'];
        $id_ordershop = $_POST['id_ordershop'];
        $doc_client = $_POST['doc_client'];
        $query = $this->mdlClient->where('doc_client', $doc_client)->findAll();
        while ($i < $quantity) {
            $queryProduct = $this->mdlProduct->where('id_product', $id_product)->findAll();
            $this->mdlShopDetail->insert([
                'id_shopdetail' => uniqid(),
                'price_shopdetail' => $queryProduct[0]->price_product,
                'obs_shopdetail' => '',
                'stock_productid' => $id_product,
                'stock_sizeid' => $id_size,
                'ordershop_id' => $id_ordershop
            ]);
            $i += 1;
        }
        return $this->VistaCompra($query, $id_ordershop);
    }



    //fabian
    public function disable()
    {
        $id_product = $this->request->getPost('id_product');
        d($id_product);
        $product = $this->mdlProduct->find($id_product);
        $product->disable();
        $this->mdlProduct->save($product);
        return redirect()->back()->with('msg', [
            'title' => 'Deshabilitado!',
            'class' => 'alert-success',
            'body' => 'Se deshabilito correctamente el producto ' . $id_product . '<a target="_blank" href="' . base_url() . route_to('view_single_product') . '?id=' . $id_product . '"> Ver Producto</a>'
        ]);
    }
}
