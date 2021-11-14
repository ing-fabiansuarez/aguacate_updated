<?php

namespace App\Models;

use App\Entities\Employee;
use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table      = 'user_has_permission';
    protected $primaryKey = 'user_id_user';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    public function hasPermission($id_permission, $cedula = null)
    {
        if ($cedula == null) {
            if (!$this->where('user_id_user', session()->cedula_employee)->where('permission_id_permission', $id_permission)->where('active_permission', 1)->first()) {
                return false;
            } else {
                return true;
            }
        } else {
            if (!$this->where('user_id_user', $cedula)->where('permission_id_permission', $id_permission)->where('active_permission', 1)->first()) {
                return false;
            } else {
                return true;
            }
        }
    }
}
