<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderShopDetailModel extends Model
{
    protected $table      = 'ordershop_detail';
    protected $primaryKey = 'id_ordershop';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_shopdetail',
        'price_shopdetail',
        'obs_shopdetail',
        'stock_productid',
        'stock_sizeid',
        'ordershop_id'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_shopdetail';
    protected $updatedField  = 'updated_shopdetail';
}