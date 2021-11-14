<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table      = 'stock';
    protected $primaryKey = 'product_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'product_id',
        'quantity_stock',
        'size_id',
        'locker_id',
        'barcode_id'
    ];
}
