<?php

namespace App\Models;

use App\Entities\OrderPw;
use CodeIgniter\Model;

class OrderPwModel extends Model
{
    protected $table      = 'order_pw';
    protected $primaryKey = 'ref_orderpw';

    protected $returnType     = OrderPw::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'ref_orderpw',
        'created_at_orderpw',
        'updated_at_orderpw',
        'state_order',
        'cosecutive_order',
        'shoppinginfo_id',
        'ref_payu'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at_orderpw';
    protected $updatedField  = 'updated_at_orderpw';
}
