<?php

namespace App\Controllers\Admin\ApiPrivate;

use App\Controllers\BaseController;
use App\Models\OrderPwModel;

class Ajax extends BaseController
{
    public function __construct()
    {
        $this->mdlOrderPw = new OrderPwModel();
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
}
