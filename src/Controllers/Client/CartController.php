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
        $this->cart = new Cart();
        $this->cartItem = new CartItem();
        middleware_private_for_admin();
    }

    public function index()
    {

        // dd($_SESSION);

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

            // dd($carts);


            return $this->viewClient(self::PATH_VIEW, [
                'carts' => $carts,
                'cart_id' => $cartId
            ]);
        } else {
            $carts = $_SESSION['cart'] ?? [];

            // dd($carts);

            return $this->viewClient(self::PATH_VIEW, [
                'carts' => $carts
            ]);
        }
    }
}
