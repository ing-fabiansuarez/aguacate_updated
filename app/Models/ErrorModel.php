<?php

namespace App\Models;

use CodeIgniter\Model;

class ErrorModel extends Model
{
    protected $table      = 'error';
    protected $primaryKey = 'id_error';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_error',
        'product_error',
        'create',
        'update',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'create';
    protected $updatedField  = 'update';
}
