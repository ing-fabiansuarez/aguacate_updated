<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSizeModel extends Model
{
    protected $table      = 'product_has_size';
    protected $primaryKey = 'product_id_product';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'product_id_product',
        'size_id_size'
    ];
}
