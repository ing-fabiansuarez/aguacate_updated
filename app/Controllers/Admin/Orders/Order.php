<?php

namespace App\Controllers\Admin\Orders;

use App\Controllers\BaseController;
use App\Models\OrderPwModel;

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
}
