<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderPw extends Entity
{
    protected $dates = ['created_at_user', 'updated_at_user'];

    public function changeState($newState)
    {
        $this->state_order = $newState;
    }
}
