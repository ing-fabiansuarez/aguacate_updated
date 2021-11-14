<?php

namespace App\Controllers\Ecommerce;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class Section extends BaseController
{
    public function __construct()
    {
        $this->mdlCategory = new CategoryModel();
        $this->mdlProduct = new ProductModel();
    }
    public function home()
    {
        return view('ecommerce/home');
    }
    public function new()
    {
        return view('ecommerce/section/new', [
            'products' => $this->mdlProduct->getNewProductsPagWeb()
        ]);
    }

    public function viewCategory($routeCategory)
    {
        if (!$category = $this->mdlCategory->select('*')->where('prefijo_category', $routeCategory)->first()) {
            return view('errors/html/error_404');
        }
        return view('ecommerce/section/categories', [
            'products' => $this->mdlProduct->getProductsByCategoryPagWeb($category['id_category']),
            'category' => $category,
        ]);
    }

    public function viewSingleProduct()
    {
        if (!$product = $this->mdlProduct->find($this->request->getGet('id'))) {
            return view('errors/html/error_404');
        }
        return view('ecommerce/section/single_product', [
            'product' => $product,
            'category' => $product->getCategory(),
            'sizes' => $product->getSizes(),
            'images' => $product->getImages()
        ]);
    }


    public function pageRequestPayment()
    {
        $polTransactionState = '';
        switch ($this->request->getPostGet('polTransactionState')) {
            case 4:
                $polTransactionState = 'Transacción aprobada';
                break;
            case 6:
                $polTransactionState = 'Transacción fallida';
                break;

            case 12:
                $polTransactionState = 'Transacción pendiente';
                break;
            case 14:
                $polTransactionState = 'Transacción pendiente';
                break;
        }
        return view('ecommerce/section/view_request_page', [
            'polTransactionState' => $polTransactionState,
            'referenceCode' => $this->request->getPostGet('referenceCode'),
            'transactionId' => $this->request->getPostGet('transactionId'),
            'processingDate' => $this->request->getPostGet('processingDate'),
            'buyerEmail' => $this->request->getPostGet('buyerEmail'),
            'pseBank' => $this->request->getPostGet('pseBank'),
        ]);
    }
    public function pageRequestPaymentCredit()
    {
        return view('ecommerce/section/view_request_page_c_c', [
            'state' => $this->request->getPostGet('state'),
            'msg' => $this->request->getPostGet('msg'),
        ]);
    }
}
