<?php

namespace App\Controllers\Admin\ApiPrivate;

use App\Controllers\BaseController;
use App\Models\OrderPwModel;
use App\Models\ProductModel;
use App\Models\StockModel;
use Exception;

class Ajax extends BaseController
{
    public function __construct()
    {
        $this->mdlOrderPw = new OrderPwModel();
        $this->mdlProduct = new ProductModel();
        $this->mdlStock = new StockModel();
    }
    //fabian
    public function getHtmlDetailOrder()
    {
        $ref_order = $this->request->getPostGet('ref_order');
        $orderpw = $this->mdlOrderPw->find($ref_order);

        return view('api/detail_orderpw', [
            'orderpw' => $orderpw,
            'shoppinginfo' => $orderpw->getShoppingInfo(),
            'detailorderwhitproduct' => $orderpw->getDetailProductWithProducts()
        ]);
    }
    //fabian
    public function getImagenes()
    {
        $id_product = $this->request->getPostGet('id_product');
        return view('admin/api/view_images', [
            'images' => ($this->mdlProduct->find($id_product)->getImages())
        ]);
    }
    //fabian
    public function changeNewProduct($id_product, $action)
    {
        $product = $this->mdlProduct->find($id_product);
        switch ($action) {
            case 1:
                $product->new_product = true;
                $this->mdlProduct->save($product);
                echo "Guardado Los cambios Correctamente";
                return;
                break;
            case 0:
                $product->new_product = false;
                $this->mdlProduct->save($product);
                echo "Guardado Los cambios Correctamente";
                return;
                break;
        }
    }
    //fabian
    public function changeShowProduct($id_product, $action)
    {
        $product = $this->mdlProduct->find($id_product);
        switch ($action) {
            case 1:
                $product->showpw_product = true;
                $this->mdlProduct->save($product);
                echo "Guardado Correctamente";
                return;
                break;
            case 0:
                $product->showpw_product = false;
                $this->mdlProduct->save($product);
                echo "Guardado Correctamente";
                return;
                break;
        }
    }
    //fabian
    public function changePriceProduct($id_product, $price)
    {
        $product = $this->mdlProduct->find($id_product);
        $product->price_product = $price;
        $this->mdlProduct->save($product);
        echo "Se cambio el precio Correctamente";
        return;
    }
    //fabian
    public function changeStock()
    {
        //validar si tiene permisos para cambiar el stock

        //validar si los datos son correctos
        //validaciones
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('changeStock')
        ))) {
            $cadena = '';
            foreach ($this->validator->getErrors() as $error) {
                $cadena .= $error . '<br>';
            }
            echo json_encode([
                'status' => 'error',
                'msg' => $cadena
            ]);
            return;
        }
        $id_product = $this->request->getPostGet('ref_producto');
        $id_size = $this->request->getPostGet('talla');
        $quantity = $this->request->getPostGet('cantidad');

        $this->mdlStock
            ->where('product_id', $id_product)
            ->where('size_id', $id_size)
            ->set('quantity_stock', $quantity)
            ->update();

        echo json_encode([
            'status' => 'ok',
            'msg' => 'Guardado correctamente la cantidad del stock en el producto <br><b>Producto: </b>' . $id_product . '<br><b>Cantidad: </b>' . $quantity
        ]);
    }
}
