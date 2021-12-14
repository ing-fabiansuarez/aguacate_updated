<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table      = 'client';
    protected $primaryKey = 'id_client';

    protected $returnType     = 'array'; //Verificar
    protected $useSoftDeletes = false;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_client',
        'doc_client',
        'typeidentification_idtypeiden',
        'name_client',
        'lastname_client',
        'phone_client',
        'email_client'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_client';
    protected $updatedField  = 'updated_client';
    
}
