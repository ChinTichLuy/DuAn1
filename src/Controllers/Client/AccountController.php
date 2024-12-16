<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class AccountController extends Controller
{
    private const PATH_VIEW = 'account.';
    private User $user;
    private Order $order;
    private OrderItem $orderItem;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->order = new Order();
        $this->orderItem = new OrderItem();

        middleware_isAuth();
        middleware_private_for_admin();
    }

    public function index()
    {
        return $this->viewClient(self::PATH_VIEW . __FUNCTION__);
    }

    public function orders()
    {
        $userId = $_SESSION['user']['id'] ?? null;

        // dd($userId);

        $orders = $this->order->findByUserId($userId);


        // dd($orders);

        return $this->viewClient(self::PATH_VIEW . __FUNCTION__, [
            'orders' => $orders
        ]);
    }

    public function orderDetail($id)
    {
        $order = $this->order->find($id);
        $orderItems = $this->orderItem->findByOrderId($id);

        // dd($order);

        return $this->viewClient(self::PATH_VIEW . 'order-detail', [
            'orderItems' => $orderItems,
            'order' => $order
        ]);
    }
}
