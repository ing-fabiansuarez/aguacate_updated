<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoppingInfo extends Model
{
    protected $table      = 'shopping_info';
    protected $primaryKey = 'id_shoppinginfo';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_shoppinginfo',
        'city_idcity',
        'address_shippinginfo',
        'neighborhood_shippinginfo',
        'name_shoppinginfo',
        'surname_shoppinginfo',
        'typeidentification_id',
        'num_phone',
        'email_shoppinginfo'
    ];
}
