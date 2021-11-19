<?php

namespace App\Models;

use App\Entities\Product;
use CodeIgniter\Model;

class ProductModel extends Model
{
    /* public function __construct()
    {
          
    }*/
    protected $table      = 'product';
    protected $primaryKey = 'id_product';

    protected $returnType     = Product::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_product',
        'name_product',
        'active_product',
        'description_product',
        'category_id',
        'showpw_product',
        'price_product',
        'new_product'
    ];

    public function getNewProductsPagWeb()
    {
        $arrayResult = array();
        $newProducts =  $this->where('active_product', true)
            ->where('showpw_product', true)
            ->where('new_product', true)
            ->orderBy('score_product', 'desc')
            ->findAll(15);
        foreach ($newProducts as $product) {
            if ($product->quantityStockAnySize() > 0) {
                array_push($arrayResult, $product);
            }
        }
        return $arrayResult;
    }

    public function getProductsByCategoryPagWeb($idCategory)
    {
        $arrayResult = array();
        $productsCategory = $this->where('active_product', true)
            ->where('showpw_product', true)
            ->where('category_id', $idCategory)
            ->orderBy('score_product', 'desc')
            ->findAll();
        foreach ($productsCategory as $product) {
            if ($product->quantityStockAnySize() > 0) {
                array_push($arrayResult, $product);
            }
        }
        return $arrayResult;
    }
    public function getProductsOutofStockByCategoryPagWeb($idCategory)
    {
        $arrayResult = array();
        $productsCategory = $this->where('active_product', true)
            ->where('showpw_product', true)
            ->where('category_id', $idCategory)
            ->orderBy('score_product', 'desc')
            ->findAll();
        foreach ($productsCategory as $product) {
            if ($product->quantityStockAnySize() <= 0) {
                array_push($arrayResult, $product);
            }
        }
        return $arrayResult;
    }

    public function generateSizeStockLockerBarcode($idProduct, $sizeId, $quantityStock)
    {
        $mdlSize = new ProductSizeModel();
        $mdlStock = new StockModel();
        $mdlBarcode = new BarcodeModel();
        $mdlSize->insert([
            'product_id_product' => $idProduct,
            'size_id_size' => $sizeId
        ]);

        $consecutivo = $mdlBarcode->orderBy('number_barcode', 'desc')->first()['number_barcode'] + 1;
        $idBarcode = $mdlBarcode->insert([
            'complete_barcode' => 'AK00' . $consecutivo,
            'pre_barcode' => 'AK',
            'number_barcode' => $consecutivo,
        ]);

        //OHO FALTA POR ARREGLA EL CBARCODE Y EL LOKER_ID
        $mdlStock->insert([
            'product_id' => $idProduct,
            'size_id' => $sizeId,
            'quantity_stock' => $quantityStock,
            'locker_id' => 1,
            'barcode_id' => $idBarcode
        ]);
    }
}
