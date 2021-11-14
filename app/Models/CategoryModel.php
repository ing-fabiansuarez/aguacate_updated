<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'id_category';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_category',
        'name_category',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'create_at_category';
    protected $updatedField  = 'update_at_category';

    protected $validationRules    = [];

    protected $validationMessages = [];
}
