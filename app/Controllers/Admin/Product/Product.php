<?php

namespace App\Controllers\Admin\Product;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ImageModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\StockModel;

class Product extends BaseController
{
    public function __construct()
    {
        $this->mdlProduct = new ProductModel();
        $this->mdlCategory = new CategoryModel();
        $this->mdlStock = new StockModel();
        $this->mdlSize = new ProductSizeModel();
        $this->mdlImage = new ImageModel();
    }
    public function index()
    {
        return view('admin/product/view_product');
    }
    public function create()
    {
        //validaciones
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newProduct')
        ))) {
            return redirect()->to(base_url() . route_to('view_main_products'))->with('error_validation', $this->validator->getErrors())->withInput();
        }

        //datos capturados del formulario
        $name = $this->request->getPost('nombre');
        $description = $this->request->getPost('descripcion');
        if ($description == '') :
            $description = null;
        endif;
        $idCategory = $this->request->getPost('categoria');
        $showPageWeb = $this->request->getPost('mostrar');
        $isNewProduct = $this->request->getPost('nueva_coleccion');
        $price = $this->request->getPost('precio');

        //capturar la existencia por talla para luego crear las tallas del producto creado
        $unic = $this->request->getPost('unica');
        $xxxs = $this->request->getPost('xxxs');
        $xxs = $this->request->getPost('xxs');
        $xs = $this->request->getPost('xs');
        $s = $this->request->getPost('s');
        $m = $this->request->getPost('m');
        $l = $this->request->getPost('l');
        $xl = $this->request->getPost('xl');
        $xxl = $this->request->getPost('xxl');
        $xxxl = $this->request->getPost('xxxl');

        //traer los objetos
        $category = $this->mdlCategory->find($idCategory);

        //generamos el id del producto
        $idProduct = uniqid();

        //guardar las imagen y el pago
        $file1 = $this->request->getFile('image1');
        $file2 = $this->request->getFile('image2');
        $file3 = $this->request->getFile('image3');

        //crea la carpeta donde se va a alojar el recibo si no existe
        $pathOriginals = 'assets/img/products/originals/';
        $pathMin = 'assets/img/products/thumb/';
        if (!file_exists($pathOriginals)) {
            mkdir($pathOriginals, 0777, true);
        }
        if (!file_exists($pathMin)) {
            mkdir($pathMin, 0777, true);
        }


        if (
            $file1->isValid() && !$file1->hasMoved() &&
            $file2->isValid() && !$file2->hasMoved() &&
            $file3->isValid() && !$file3->hasMoved()
        ) {

            $ext = '.' . $file1->getClientExtension();
            $newName = $idProduct . '-1';
            $file1->move($pathOriginals, $newName . $ext);
            $filepathOriginal1 = $pathOriginals . $newName . $ext;
            $filepathThumb1 = $pathMin . $newName . $ext;

            $image = \Config\Services::image()
                ->withFile($filepathOriginal1)
                ->save($filepathThumb1);


            $ext = '.' . $file2->getClientExtension();
            $newName = $idProduct . '-2';
            $file2->move($pathOriginals, $newName . $ext);
            $filepathOriginal2 = $pathOriginals . $newName . $ext;
            $filepathThumb2 = $pathMin . $newName . $ext;

            $image = \Config\Services::image()
                ->withFile($filepathOriginal2)
                ->save($filepathThumb2);


            $ext = '.' . $file3->getClientExtension();
            $newName = $idProduct . '-3';
            $file3->move($pathOriginals, $newName . $ext);
            $filepathOriginal3 = $pathOriginals . $newName . $ext;
            $filepathThumb3 = $pathMin . $newName . $ext;

            $image = \Config\Services::image()
                ->withFile($filepathOriginal3)
                ->save($filepathThumb3);
        } else {
            return redirect()->back()->with('error', [
                'title' => 'No pudo ser Creado con Exito!',
                'body' => "El Archivo no es valido o ha sido movido"
            ]);
        }

        //se crea el registro en la base de datso
        $this->mdlProduct->insert([
            'id_product' => $idProduct,
            'name_product' => $name,
            'active_product' => 1,
            'description_product' => $description,
            'category_id' => $idCategory,
            'showpw_product' => $showPageWeb,
            'price_product' => $price,
            'new_product' => $isNewProduct
        ]);

        //se guardan las imagenes en la base de datos
        $this->mdlImage->insert([
            'id_image' => '',
            'name_image' => $idProduct,
            'path_image' => $filepathOriginal1,
            'path_thumb_image' => $filepathThumb1,
            'product_id' => $idProduct,
        ]);
        $this->mdlImage->insert([
            'id_image' => '',
            'name_image' => $idProduct,
            'path_image' => $filepathOriginal2,
            'path_thumb_image' => $filepathThumb2,
            'product_id' => $idProduct,
        ]);
        $this->mdlImage->insert([
            'id_image' => '',
            'name_image' => $idProduct,
            'path_image' => $filepathOriginal3,
            'path_thumb_image' => $filepathThumb3,
            'product_id' => $idProduct,
        ]);

        if (!($unic == 0 || $unic == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 1, $unic);
        }
        if (!($xxxl == 0 || $xxxl == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 2, $xxxl);
        }
        if (!($xxl == 0 || $xxl == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 3, $xxl);
        }
        if (!($xl == 0 || $xl == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 4, $xl);
        }
        if (!($l == 0 || $l == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 5, $l);
        }
        if (!($m == 0 || $m == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 6, $m);
        }
        if (!($s == 0 || $s == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 7, $s);
        }
        if (!($xs == 0 || $xs == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 8, $xs);
        }
        if (!($xxs == 0 || $xxs == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 9, $xxs);
        }
        if (!($xxxs == 0 || $xxxs == '')) {
            $this->mdlProduct->generateSizeStockLockerBarcode($idProduct, 10, $xxxs);
        }

        return redirect()->to(base_url() . route_to('view_main_products'))->with('msg', [
            'body' => "El producto fue creado con exito.",
        ]);
    }

    public function listProducts()
    {
        $id_category = $this->request->getGet('categoria');
        return view('admin/product/view_list_products', [
            'products' => $this->mdlProduct->where('category_id', $id_category)->where('active_product', true)->findAll(),
            'categories' =>  $this->mdlCategory->findAll(),
            'id_category' => $id_category
        ]);
    }

    public function searchProduct()
    {
        return view('admin/product/view_search_product');
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
