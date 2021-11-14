<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table      = 'order_detail';
    protected $primaryKey = 'id_orderdetail';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_orderdetail',
        'order_pw_ref',
        'stock_product_id',
        'stock_size_id',
        'price_sale',
        'obs_detail'
    ];
}
