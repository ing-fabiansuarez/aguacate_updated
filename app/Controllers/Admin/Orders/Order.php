<?php

namespace App\Controllers\Admin\Orders;

use App\Controllers\BaseController;
use App\Models\OrderPwModel;
use CodeIgniter\CLI\Console;

class Order extends BaseController
{
    public function __construct()
    {
        $this->mdlOrderPw = new OrderPwModel();
    }
    public function dailyOrders($date)
    {
        $orders = $this->mdlOrderPw->where("created_at_orderpw between '$date 00:00:00'
        and '$date 23:59:59'")->orderBy('cosecutive_order', 'asc')->findAll();
        return view('admin/orders/daily_orders', [
            'orders' => $orders,
            'date' => $date
        ]);
    }

    public function redirectToDaylyOrders()
    {
        return redirect()->to(base_url() . route_to('view_daily_orders', $this->request->getPostGet('date')));
    }
    public function searchDocument()
    {
        //Funcion que realiza busqueda por documento y devuelve un array de objetos
        $document = $this->request->getGet('documento');
        return view(
            'admin/orders/view_search_orders',
            [
                'orders' => $this->mdlOrderPw->table('order_pw')
                    ->join('shopping_info', 'shopping_info.id_shoppinginfo = order_pw.shoppinginfo_id')
                    ->join('city', 'city.idcity = shopping_info.city_idcity')
                    ->join('department', 'department.iddepartment=city.department_id')
                    ->join('servientrega', 'servientrega.city_id_destination=city.idcity')
                    ->join('typejourney', 'servientrega.typejourney_id=idtypejourney')
                    ->where('shopping_info.cedula_num_shoppinginfo', $document)
                    ->findAll()
            ]
        );
    }
}
