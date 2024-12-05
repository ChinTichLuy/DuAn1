<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    private const PATH_VIEW = 'cart';
    private Cart $cart;
    private CartItem $cartItem;
    public function __construct()
    {
        middleware_private_for_admin();
        $this->cart = new Cart();
        $this->cartItem = new CartItem();
    }
    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;

        if ($userId) {
            $dataCart = $this->cart->findByUserId($userId);
            if (!empty($dataCart)) {
                $carts = $this->cartItem->selectInnerJoinProduct($dataCart['id']);
                $cartId = $dataCart['id'];
            } else {
                $carts = [];
                $cartId = null;
            }

            return $this->viewClient(self::PATH_VIEW, [
                'carts' => $carts,
                'cart_id' => $cartId
            ]);
        } else {
            // Không có người dùng
            $carts = $_SESSION['cart'] ?? [];
            return $this->viewClient(self::PATH_VIEW, [
                'carts' => $carts,
            ]);
        }
    }
}
