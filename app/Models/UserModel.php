<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';

    protected $returnType     = User::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_user',
        'name_user',
        'surname_user',
        'active_user',
        'photo_user',
        'password_user',
        'phone_user',
        'created_at_user',
        'updated_at_user'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at_user';
    protected $updatedField  = 'updated_at_user';

    protected $validationRules    = [];

    protected $validationMessages = [];
}
