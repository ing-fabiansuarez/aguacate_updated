<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\OrderShop;
class OrderShopModel extends Model
{
    protected $table      = 'order_shop';
    protected $primaryKey = 'id_ordershop';

    protected $returnType     =OrderShop::class;//Verificar
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_ordershop',
        'consecutive_ordershop',
        'client_id',//ID? LLaves foraneas
        'user_id',
        'shoppinginfo_id'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_ordershop';
    protected $updatedField  = 'updated_ordershop';
}