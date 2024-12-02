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


        // dd($_SESSION);

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

        $userId = $_SESSION['user']['id'] ?? null;

        $productVariantId = $_POST['product_variant_id'];
        $productQuantity = $_POST['quantity'];
        $productId = $_POST['product_id'];

        $connect = $this->cart->getConnect();


        $countCart = 0;

        // 26

        if ($userId) {
            // 
            $cart = $this->cart->findByUserId($userId);

            if (empty($cart)) {
                $this->cart->insert([
                    'user_id'       => $userId,
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
        } else {
            ## Nếu chưa có session cart thì tạo
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $product = $this->productVariants->findById($productVariantId);

            $quantityVariant = $product['v_quatity'];

            if ($quantityVariant == 0) {
                $message = 'Sản phẩm không có sẵn';
                header('Content-type: application/json');
                echo json_encode([
                    'message' => $message,
                    'status' => false
                ]);
                ## Ngừng chạy câu lệnh bên dưới
                exit();
            }

            // format data cần lưu vào session
            $dataCart = [
                'p_name' => $product['p_name'],
                'p_price_regular' => $product['p_price_regular'],
                'p_price_sale' => $product['p_price_sale'],
                'p_sku' => $product['p_sku'],
                'p_slug' => $product['p_slug'],
                'p_thumb_image' => $product['p_thumb_image'],
                'pc_id' => $product['pc_id'],
                'pc_name' => $product['pc_name'],
                'v_price_regular' => $product['v_price_regular'],
                'v_product_color_id' => $product['v_product_color_id'],
                'v_product_id' => $product['v_product_id'],
                'v_quatity' => $product['v_quatity'],
                'ct_quantity' => $productQuantity,
            ];

            if (!isset($_SESSION['cart'][$productVariantId])) {
                $_SESSION['cart'][$productVariantId] = $dataCart;
                $count = count($_SESSION['cart']);
                $message = 'Thêm vào giỏ hàng thành công';
            } else {
                $_SESSION['cart'][$productVariantId]['c_quantity'] += $productQuantity;
                $count = count($_SESSION['cart']);
                $message = 'Thêm vào giỏ hàng thành công';
            }

            header('Content-type: application/json');
            echo json_encode([
                'message' => 'Thêm vào giỏ hàng thành công',
                'cart' => $_SESSION['cart'],
                'post' => $_POST,
                'products' => $product,
                'quantity' => $quantityVariant,
                'status' => true,
                'count' => $count
            ]);
        }
    }

    public function handleUpdateCart()
    {
        $authenticate = 26;

        $userId = $_SESSION['user']['id'] ?? null;

        $id = $_POST['cartItemId'];
        $quantity = $_POST['quantity'];
        $price = $_POST['subTotal'];
        $cartId =  $_POST['cartId'];

        $dataCart = [];

        if ($userId) {
            $this->cartItem->updateQuantityById($id, $quantity);

            $subTotal = $price * $quantity;

            $dataCart = $this->cartItem->selectInnerJoinProduct($cartId);

            $priceTotal = calculateTotalProduct($dataCart);


            header('Content-type: application/json');
            echo json_encode([
                'dataPost' => $_POST,
                'subTotal' => $subTotal,
                'priceTotal' => $priceTotal,
                // 'cartId' => $cartId
                'dataCart' => $dataCart,
                'id' =>  $id,
                'status' => true,
                'userId' => $userId
            ]);

            exit();
        } else {
            $_SESSION['cart'][$id]['ct_quantity'] = $quantity;

            $subTotal = $price * $quantity;

            $priceTotal = calculateTotalProduct($_SESSION['cart']);


            header('Content-type: application/json');
            echo json_encode([
                'dataPost' => $_POST,
                'status' => true,
                'userId' => $userId,
                'subTotal' => $subTotal,
                'priceTotal' => $priceTotal,
            ]);
        }
    }
}
