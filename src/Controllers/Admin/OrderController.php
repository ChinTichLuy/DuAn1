<?php

namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    private const PATH_VIEW = 'orders.';
    private Order $order;
    private OrderItem $orderItem;

    public function __construct()
    {
        parent::__construct();
        $this->order = new Order();
        $this->orderItem = new OrderItem();
    }

    public function index()
    {
        // $orders = $this->order->getAll('*');

        $orders = $this->order->selectAndGetCount();

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {

        $orderItems = $this->orderItem->findByOrderId($id);
        $order = $this->order->find($id);


        // dd($order);
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }

    public function handleEdit($id)
    {

        $status = $_POST['status'] ?? null;
        $this->order->updateStatusOrder($id, $status);
        toastr('success', 'Thay đổi trạng thái thành công');
        header('location: ' . routeAdmin("orders/{$id}"));
        exit();
    }
}
