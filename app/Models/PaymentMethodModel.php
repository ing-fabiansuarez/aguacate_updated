<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table      = 'payment_method';
    protected $primaryKey = 'id_cardcredit';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];
}
