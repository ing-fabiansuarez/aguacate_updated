<?php

namespace App\Entities;

use App\Models\JobtitleModel;
use App\Models\PermissionModel;
use CodeIgniter\Entity\Entity;

class OrderPw extends Entity
{
    protected $dates = ['created_at_user', 'updated_at_user'];
}
