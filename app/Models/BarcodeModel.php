<?php

namespace App\Models;

use CodeIgniter\Model;

class BarcodeModel extends Model
{
    protected $table      = 'barcode';
    protected $primaryKey = 'idbarcode';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'idbarcode',
        'complete_barcode',
        'pre_barcode',
        'number_barcode',
    ];
}
