<?php

namespace App\Models;

use CodeIgniter\Model;

class ServientregaModel extends Model
{
    protected $table      = 'servientrega';
    protected $primaryKey = 'idjourney';

    /* 
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    */

    protected $allowedFields = ['name', 'email'];
    /*
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    */

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function getjourneyandprice($cityorigin,$citydestination){
        return $this->db->table('servientrega s')
            ->select('*')
            ->join('typejourney t', 's.typejourney_idtypejourney = t.idtypejourney')
            ->where('s.city_idcity_origin', $cityorigin)
            ->where('s.city_idcity_destination', $citydestination)
            ->get()->getResultArray();
    }
    
}
