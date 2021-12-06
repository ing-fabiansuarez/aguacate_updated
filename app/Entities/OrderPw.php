<?php

namespace App\Entities;

use App\Models\OrderDetailModel;
use App\Models\ProductModel;
use App\Models\ShoppingInfo;
use App\Models\SizeModel;
use CodeIgniter\Entity\Entity;

class OrderPw extends Entity
{
    private $mdlShippingInfo, $mdlDetailOrder, $mdlProduct, $mdlSize;
    protected $dates = ['created_at_orderpw', 'updated_at_orderpw'];

    public function __construct()
    {
        $this->mdlShippingInfo = new ShoppingInfo();
        $this->mdlDetailOrder = new OrderDetailModel();
        $this->mdlProduct = new ProductModel();
        $this->mdlSize = new SizeModel();
    }

    public function changeState($newState)
    {
        $this->state_order = $newState;
    }
    public function getShoppingInfo()
    {
        return $this->mdlShippingInfo->table('shopping_info')
            ->select('*')
            ->join('typeidentification', 'shopping_info.typeidentification_id = typeidentification.id_typeiden')
            ->join('city', 'city.idcity = shopping_info.city_idcity')
            ->join('department', 'department.iddepartment=city.department_id')
            ->where('shopping_info.id_shoppinginfo', $this->shoppinginfo_id)
            ->get()
            ->getFirstRow('array');
    }


    public function getPrices()
    {
        $totalPriceProducts = 0;
        $freight = 0;

        foreach ($this->getDetailProduct() as $item) {
            $totalPriceProducts += $item['price_sale'];
        }
        return [
            'TAX_VALUE' => number_format($totalPriceProducts - ($totalPriceProducts / 1.19), 2, '.', ''),
            'TAX_RETURN_BASE' => number_format(($totalPriceProducts / 1.19), 2, '.', ''),
            'TOTAL_SALE' => $totalPriceProducts,
            'FLEIGHT' => $freight,
            'TOTAL' => $totalPriceProducts + $freight,
        ];
    }

    public function getDetailProduct()
    {
        return $this->mdlDetailOrder->where('order_pw_ref', $this->ref_orderpw)->findAll();
    }

    public function getDetailProductWithProducts()
    {
        $arrayResult = array();
        foreach ($this->getDetailProduct() as $item) {
            array_push($arrayResult, [
                'detail' => $item,
                'product' => $this->mdlProduct->find($item['stock_product_id']),
                'size' => $this->mdlSize->find($item['stock_size_id'])
            ]);
        }
        return $arrayResult;
    }

}
