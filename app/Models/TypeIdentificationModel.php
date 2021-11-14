<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeIdentificationModel extends Model
{
    protected $table      = 'typeidentification';
    protected $primaryKey = 'id_typeiden';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];
}
