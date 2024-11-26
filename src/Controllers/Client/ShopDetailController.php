<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductTag;
use App\Models\ProductVariants;

class ShopDetailController extends Controller
{
    private const PATH_VIEW = 'shop-detail';
    private Product $product;
    private ProductGallery $productGallery;

    private ProductTag $productTag;

    private ProductVariants $productVariants;

    private Cart $cart;
    private CartItem $cartItem;

    public function __construct()
    {
        $this->product = new Product();
        $this->productGallery = new ProductGallery();
        $this->productTag = new ProductTag();
        $this->productVariants = new ProductVariants();
        $this->cart = new Cart();
        $this->cartItem = new CartItem();
    }

    public function index($slug)
    {

        $product = $this->product->findBySlug($slug);

        if ($product) {
            $productGalleries = $this->productGallery->findByProductId($product['p_id']);
            $productTags = $this->productTag->findByProductId($product['p_id']);
            $productVariants = $this->productVariants->findByProductId($product['p_id']);
        }


        // dd($product);

        return $this->viewClient(self::PATH_VIEW, [
            'product' => $product,
            'productGalleries' => $productGalleries,
            'productTags' => $productTags,
            'productVariants' => $productVariants,
        ]);
    }


    public function findProductVariantByColorId($productId, $colorId)
    {
        header('Content-type: application/json');
        echo json_encode([
            'product_variant_id' => $this->productVariants->findByColorId($productId, $colorId)
        ]);
    }

    public function handleAddToCart()
    {
        // co nguoi dung

        $authenticate = true;

        $productVariantId = $_POST['product_variant_id'];
        $productQuantity = $_POST['quantity'];

        $connect = $this->cart->getConnect();


        $countCart = 0;

        // 26

        if ($authenticate) {
            // 
            $cart = $this->cart->findByUserId(26);

            if (empty($cart)) {
                $this->cart->insert([
                    'user_id'       => 26,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
            }

            $cartId = $cart['id'] ?? $connect->lastInsertId();
            $checkCartItem = $this->cartItem->findByCartIdAndProductId($cartId, $productVariantId);

            if (empty($checkCartItem)) {
                $this->cartItem->insert([
                    'cart_id' => $cartId,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $productQuantity,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
            } else {
                $newQuantity = $checkCartItem['quantity'] + $productQuantity;
                $this->cartItem->updateQuantityByCartIdAndProductVariantId($cartId, $productVariantId, $newQuantity);
            }

            $countCart = $this->cartItem->getCount($cartId);

            header('Content-type: application/json');
            echo json_encode([
                'message' => 'Thêm vào giỏ hàng thành công',
                'count' => $countCart,
                'status' => true,
                // check data
                'quantity' => $_POST['quantity'],
                'cart_id' => $cartId,
                'variant_id' => $_POST['product_variant_id']
            ]);

            #####
            // if ($cart) {
            //     //

            //     // nếu người dùng đã có cart thì thêm items or thêm quantity

            //     // Tìm kiếm theo product_variant_id và cart_id rồi mới update




            //     // $this->cartItem->update($,[
            //     //     'cart_id'               => 9,
            //     //     'product_variant_id'    => $_POST['product_variant_id'],
            //     //     'quantity'               => $_POST['quantity'],
            //     //     'created_at'            => date('Y-m-d H:i:s'),
            //     //     'updated_at'            => date('Y-m-d H:i:s'),
            //     // ]);



            //     header('Content-type: application/json');
            //     echo json_encode([
            //         'message' => 'Tăng số lượng cart item'
            //     ]);
            // } else {

            //     // Nếu chưa tồn tại trong bảng cart thì insert

            //     $cartId = $this->cart->insertGetId([
            //         'user_id'           => 26,
            //         'created_at'        => date('Y-m-d H:i:s'),
            //         'updated_at'        => date('Y-m-d H:i:s'),
            //     ]);

            //     $this->cartItem->insert([
            //         'cart_id'               => $cartId,
            //         'product_variant_id'    => $_POST['product_variant_id'],
            //         'quantity'               => $_POST['quantity'],
            //         'created_at'            => date('Y-m-d H:i:s'),
            //         'updated_at'            => date('Y-m-d H:i:s'),
            //     ]);


            //     header('Content-type: application/json');
            //     echo json_encode([
            //         'message' => 'Thêm thành công vào giỏ hàng',
            //         'data' => $_POST
            //     ]);
            // }
            #####




            // $cart = $this->cart->insertGetId([
            //     'user_id'           => 26,
            //     'created_at'        => date('Y-m-d H:i:s'),
            //     'updated_at'        => date('Y-m-d H:i:s'),
            // ]);

            // // Nếu mà product_variant_id đã tồn tại trong bảng cart_items thì mình chỉ cộng += quantity
            // $this->cartItem->insert([
            //     'cart_id'               => $cart,
            //     'product_variant_id'    => $_POST['product_variant_id'],
            //     'quantity'               => $_POST['quantity'],
            //     'created_at'            => date('Y-m-d H:i:s'),
            //     'updated_at'            => date('Y-m-d H:i:s'),
            // ]);



            // header('Content-type: application/json');
            // echo json_encode([
            //     'message' => 'Thêm vào giỏ hàng thành công',
            //     'status' => true,
            //     'quantity' => $_POST['quantity'],
            //     'count' => 1
            // ]);






        }


        // header('Content-type: application/json');
        // echo json_encode([
        //     'dataPost' => $_POST
        // ]);
    }
}
