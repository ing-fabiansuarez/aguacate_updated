<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderShopModel extends Model
{
    protected $table      = 'order_shop';
    protected $primaryKey = 'id_ordershop';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_ordershop',
        'consecutive_ordershop',
        'client_id',
        'user_id',
        'shoppinginfo_id'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_ordershop';
    protected $updatedField  = 'updated_ordershop';
}