<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\ProductModel;
use App\Models\TypeIdentificationModel;

class Ajax extends BaseController
{
    public function __construct()
    {
        $this->mdlProduct = new ProductModel();
        $this->mdlCity = new CityModel();
        $this->mdlTypeDoc = new TypeIdentificationModel();
    }

    public function getHtmlSizesToAddCart()
    {
        $id_product = $this->request->getPostGet('id_product');

        $product = $this->mdlProduct->find($id_product);

        return view('api/attributes_add_cart', [
            'product' => $product,
            'category' => $product->getCategory(),
            'sizes' => $product->getSizes(),
        ]);
    }

    public function getHtmlCities()
    {
        $cities = $this->mdlCity->where('department_id', $this->request->getPostGet('department'))->orderBy('name_city', 'ASC')->findAll();
        $cadena = "
        <option value=''>* Ciudad</option>
        ";
        foreach ($cities as $city) {
            $cadena = $cadena . '<option value="' . $city['idcity'] . '">' . $city['name_city'] . '</option>';
        }
        echo $cadena;
        return true;
    }

    public function getTypeDocuments()
    {
        echo json_encode($this->mdlTypeDoc->where('active_typeiden', true)->findAll());
        return;
    }
}
