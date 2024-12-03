<?php
namespace App\Controllers\Client;
use App\Commons\Controller;
use App\Models\Cart;
use App\Models\CartItem;
class CartController extends Controller{
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
        if($authenticate == 26){
            $dataCart = $this->cart->findByUserId($authenticate);
            if(!empty($dataCart)){
                // Nếu người dùng chưa có giỏ hàng
                $carts = $this->cartItem->selectInnerJoinProduct($dataCart['id']);
            }else{
                $carts = [];
            }
        }else{
            // Không có người dùng
        }
        // dd($carts);
        return $this->viewClient(self::PATH_VIEW, [
            'carts' => $carts,
            'cart_id' => $dataCart['id']
        ]);
    }
}