<?php

namespace App\Entities;

use App\Models\CategoryModel;
use App\Models\ImageModel;
use App\Models\StockModel;
use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    private $mdlStock, $mdlImage;
    public function __construct()
    {
        $this->mdlStock = new StockModel();
        $this->mdlImage = new ImageModel();
    }
    public function getCategory()
    {
        $mdlCategory = new CategoryModel();
        return $mdlCategory->find($this->category_id);
    }
    public function getSizes()
    {
        return $this->mdlStock->db->table('stock')
            ->select('*')
            ->join('size', 'stock.size_id = size.id_size')
            ->where('stock.product_id', $this->id_product)
            ->get()
            ->getResultArray();
    }
    public function isInStock($id_size, $quantity)
    {
        $quantityStock = $this->mdlStock->where('product_id', $this->id_product)->where('size_id', $id_size)->first()['quantity_stock'];
        if ($quantityStock >= $quantity) {
            return true;
        }
        return false;
    }
    public function getImages()
    {
        return  $this->mdlImage->where('product_id',$this->id_product)->findAll();
    }
}
