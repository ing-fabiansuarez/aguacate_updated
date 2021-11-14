<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/home');
    }

    public function descontar(){
        echo "SE GUARDO EL PEDIDO";
    }
}
