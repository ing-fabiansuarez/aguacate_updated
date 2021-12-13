<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Client;

class ClientModel extends Model
{
    protected $table      = 'client';
    protected $primaryKey = 'id_client';

    protected $returnType     = Client::class;//Verificar
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_client',
        'name_client',
        'lastname_client',
        'phone_client',
        'email_client'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_client';
    protected $updatedField  = 'updated_client';
}