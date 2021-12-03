<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('ecommerce/home');
    }

    public function link()
    {
        return view('others/link');

        
    }
}
