<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table      = 'image';
    protected $primaryKey = 'id_image';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_image',
        'name_image',
        'path_image',
        'path_thumb_image',
        'product_id',
    ];
}
