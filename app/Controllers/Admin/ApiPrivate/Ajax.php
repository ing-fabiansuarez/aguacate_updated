<?php

namespace App\Controllers\Admin\ApiPrivate;

use App\Controllers\BaseController;
use App\Models\OrderPwModel;
use App\Models\ProductModel;
use Exception;

class Ajax extends BaseController
{
    public function __construct()
    {
        $this->mdlOrderPw = new OrderPwModel();
        $this->mdlProduct = new ProductModel();
    }

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

    public function getImagenes()
    {
        $id_product = $this->request->getPostGet('id_product');
        return view('admin/api/view_images', [
            'images' => ($this->mdlProduct->find($id_product)->getImages())
        ]);
    }

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

    public function changePriceProduct($id_product, $price)
    {
        $product = $this->mdlProduct->find($id_product);
        $product->price_product = $price;
        $this->mdlProduct->save($product);
        echo "Se cambio el precio Correctamente";
        return;
    }
}
