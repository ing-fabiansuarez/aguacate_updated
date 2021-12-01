<?php

namespace App\Entities;

use App\Models\CityModel;
use App\Models\ErrorModel;
use App\Models\OrderDetailModel;
use App\Models\OrderPwModel;
use App\Models\ProductModel;
use App\Models\ShoppingInfo;
use App\Models\StockModel;

class ShoppingCartClass
{
    public $reference;
    public $description;
    public $sessionShoppingCart;
    public $sessionShoppingInfo;

    public function __construct($sessionShoppingCart, $sessionShoppingInfo)
    {
        $this->reference = $sessionShoppingInfo['reference'];
        $this->sessionShoppingCart = $sessionShoppingCart;
        $this->sessionShoppingInfo = $sessionShoppingInfo;
        $this->description = "Productos AguacateByKathe";

        //declarara lo modelos
        $this->mdlProduct = new ProductModel();
        $this->mdlCity = new CityModel();
        $this->mdlOrder = new OrderPwModel();
        $this->mdlShoppingInfo = new ShoppingInfo();
        $this->mdlOrderDetail = new OrderDetailModel();
        $this->mdlStock = new StockModel();
        $this->mdlError = new ErrorModel();
    }

    public function getPrices()
    {
        $totalPriceProducts = 0;
        $freight = $this->sessionShoppingInfo['freight'];
        //se miran todos los productos que estan cargados en el carrito de compras
        foreach ($this->sessionShoppingCart as $item) {
            $product = $this->mdlProduct->find($item['id_product']);
            $totalPriceProducts += ($product->price_product * $item['quantity']);
        }
        return [
            'TAX_VALUE' => number_format($totalPriceProducts - ($totalPriceProducts / 1.19), 2, '.', ''),
            'TAX_RETURN_BASE' => number_format(($totalPriceProducts / 1.19), 2, '.', ''),
            'TOTAL_SALE' => $totalPriceProducts,
            'FLEIGHT' => $freight,
            'TOTAL' => $totalPriceProducts + $freight,
        ];
    }
    public function getNameCompleteCustomer()
    {
        return  $this->sessionShoppingInfo['name'] . ' ' . $this->sessionShoppingInfo['surname'];
    }
    public function getCityAndDepartment()
    {
        return $this->mdlCity->getcity($this->sessionShoppingInfo['city']);
    }

    public function save($state, $payuref)
    {
        $consecutive = count($this->mdlOrder->findAll()) + 1;
        $this->mdlShoppingInfo->insert([
            'id_shoppinginfo'  => $this->reference,
            'city_idcity' => $this->sessionShoppingInfo['city'],
            'address_shippinginfo' => $this->sessionShoppingInfo['address'],
            'neighborhood_shippinginfo' => $this->sessionShoppingInfo['neighborhood'],
            'name_shoppinginfo' => $this->sessionShoppingInfo['name'],
            'surname_shoppinginfo' => $this->sessionShoppingInfo['surname'],
            'typeidentification_id' => $this->sessionShoppingInfo['typeInden'],
            'cedula_num_shoppinginfo' => $this->sessionShoppingInfo['numIdent'],
            'num_phone' => $this->sessionShoppingInfo['phoneNumb'],
            'email_shoppinginfo' => $this->sessionShoppingInfo['email'],
        ]);
        $this->mdlOrder->insert([
            'ref_orderpw' => $this->reference,
            'state_order' => $state,
            'cosecutive_order' => $consecutive,
            'shoppinginfo_id' => $this->reference,
            'ref_payu' => $payuref
        ]);

        foreach ($this->sessionShoppingCart as $ref) {
            $product = $this->mdlProduct->find($ref['id_product']);

            for ($i = 0; $i < $ref['quantity']; $i++) {
                $quantity = 0;
                $this->mdlOrderDetail->insert([
                    'id_orderdetail' => '',
                    'order_pw_ref' => $this->reference,
                    'stock_product_id' => $product->id_product,
                    'stock_size_id' => $ref['id_size'],
                    'price_sale' => $product->price_product,
                    'obs_detail' => ''
                ]);

                //aqui se descuenta la prenda del inventario
                $quantity = $this->mdlStock->where('product_id', $product->id_product)->where('size_id', $ref['id_size'])->first()['quantity_stock'] - 1;

                $this->mdlStock->set('quantity_stock', $quantity)
                    ->where('product_id', $product->id_product)
                    ->where('size_id', $ref['id_size'])
                    ->update();

                if ($quantity <= 0) {
                    $this->mdlError->insert([
                        'id_error' => '',
                        'product_error' => $this->reference,
                    ]);
                }
            }
        }
        unset($_SESSION['shoppingcart']);
        return;
    }
}
