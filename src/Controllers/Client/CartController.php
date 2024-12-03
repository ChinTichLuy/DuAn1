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
    }

    public function index()
    {

        $authenticate = 26;

        $userId = $_SESSION['user']['id'] ?? null;

        if ($userId) {
            $dataCart = $this->cart->findByUserId($userId);

            if (!empty($dataCart)) {
                $carts = $this->cartItem->selectInnerJoinProduct($dataCart['id']);
            } else {
                $carts = [];
            }

            // dd($carts);


            return $this->viewClient(self::PATH_VIEW, [
                'carts' => $carts,
                'cart_id' => $dataCart['id']
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
