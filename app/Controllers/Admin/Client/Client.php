<?php

namespace App\Controllers\Admin\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class Client extends BaseController
{
    public function __construct()
    {
        $this->mdlClient = new ClientModel();
    }
    public function viewClient()
    {
        return view(
            'admin/orderShop/view_search_client',
        );
    }
    public function registerClient($document)
    {
        return view(
            'admin/orderShop/register_client',["document"=>$document]
        );
    }
    public function searchClient()
    {
        //Funcion que buscar el cliente, dependiendo si existe o no retorna una vista de compra o un formulario de creacion de usuario
        if (empty($this->mdlClient->table('client')->select("*")->where('id_client', $this->request->getGet('documento'))->findAll())) {
            return $this->registerClient($this->request->getGet('documento'));
        } else {
            return view(
                'admin/orderShop/buy_products_shop'
            );
        }
    }
}
